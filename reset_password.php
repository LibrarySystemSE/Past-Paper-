<?php

session_start();
include '../includes/login_verifier.php';
if (!check_login()) {
    header("Location:../");
    exit();
}

$thisuser = filter_input(INPUT_POST, "thisuser", FILTER_DEFAULT);

include './db_connection.php';
$con = db();
$result = $con->query("select * from user where id=" . $thisuser);
if ($result->num_rows == 1) {
    $result = $result->fetch_assoc();
    $con->query("update user set password='" . password_hash("password" . date("d"), PASSWORD_DEFAULT) . "' where id=" . $result["id"]);
    header("Location:../usersm?fld=id&val=" . $thisuser);
} else {
    header("Location:../usersm?fld=id&val=" . $thisuser);
}
$con->close();
