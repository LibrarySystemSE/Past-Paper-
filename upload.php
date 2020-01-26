<?php

session_start();
include '../includes/user_type_verifier.php';
if (!check_user_type("LIBRARIAN")) {
    header("Location:../");
    exit();
}
if(!file_exists("../papers/")){
    mkdir("../papers/");
}

$upload_form_cc = filter_input(INPUT_POST, "upload_form_cc");
$upload_form_year = filter_input(INPUT_POST, "upload_form_year");


include './db_connection.php';

$con = db();

$result1 = $con->query("SELECT * FROM papers where course_code='" . $con->real_escape_string($upload_form_cc) . "' and examination_year='" . $con->real_escape_string($upload_form_year) . "' ");

if ($result1->num_rows == 0) {
    $a = explode('.', $_FILES['upload_file']['name']);
    $target_file = "../papers/" . $upload_form_year."_".$upload_form_cc . "." . end($a);
    move_uploaded_file($_FILES["upload_file"]["tmp_name"], $target_file);
    $con->query("INSERT INTO papers (course_code, examination_year, url, uploader, uploaded_on) VALUES ('" . $con->real_escape_string($upload_form_cc) . "', '" . $con->real_escape_string($upload_form_year) . "', '" . $con->real_escape_string($target_file) . "', " . $_SESSION["user_id"] . ", '" . date("Y-m-d") . "')");
    $con->close();
    header("Location:../papersm?upload=new");
} else {
    $row1 = $result1->fetch_assoc();
    if (file_exists($row1["url"])) {
        chmod($row1["url"], 0755);
        unlink($row1["url"]);
    }
    move_uploaded_file($_FILES["upload_file"]["tmp_name"], $row1["url"]);
    $con->query("UPDATE papers SET uploader=".$_SESSION["user_id"].", uploaded_on='". date("Y-m-d") ."' WHERE id=".$row1["id"]);
    $con->close();
    header("Location:../papersm?upload=update");
}
