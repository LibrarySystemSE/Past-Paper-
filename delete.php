<?php

session_start();
include '../includes/user_type_verifier.php';
if (!check_user_type("LIBRARIAN")) {
    header("Location:../");
    exit();
}

$delete_form_cc = filter_input(INPUT_POST, "delete_form_cc");
$delete_form_year = filter_input(INPUT_POST, "delete_form_year");


include './db_connection.php';

$con = db();

$result1 = $con->query("SELECT * FROM papers where course_code='" . $con->real_escape_string($delete_form_cc) . "' and examination_year='" . $con->real_escape_string($delete_form_year) . "' ");

if ($result1->num_rows == 0) {
    $con->close();
    header("Location:../papersm?delete=failed");
} else {
    $row1 = $result1->fetch_assoc();
    if (file_exists($row1["url"])) {
        chmod($row1["url"], 0755);
        unlink($row1["url"]);
    }
    $con->query("DELETE FROM papers WHERE id=".$row1["id"]);
    $con->close();
    header("Location:../papersm?delete=success");
}
