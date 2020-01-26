<?php

session_start();
include '../includes/user_type_verifier.php';
if (!check_user_type("LIBRARIAN")) {
    header("Location:../");
    exit();
}


$dothis = filter_input(INPUT_POST, "dothis");
$tothis = filter_input(INPUT_POST, "tothis");

if ($dothis === "verify") {
    include './db_connection.php';
    $con = db();
    $con->query("UPDATE user SET `status`='VERIFIED' WHERE id='" . $tothis . "'");
    $con->close();
    header("Location:../usersm?fld=id&val=" . $tothis);
}else if($dothis === "disable"){
    include './db_connection.php';
    $con = db();
    $con->query("UPDATE user SET `status`='DISABLED' WHERE id='" . $tothis . "'");
    $con->close();
    header("Location:../usersm?fld=id&val=" . $tothis);
}else if($dothis === "enable"){
    include './db_connection.php';
    $con = db();
    $con->query("UPDATE user SET `status`='VERIFIED' WHERE id='" . $tothis . "'");
    $con->close();
    header("Location:../usersm?fld=id&val=" . $tothis);
    
}