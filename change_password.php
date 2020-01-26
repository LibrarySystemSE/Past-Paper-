<?php

session_start();
include '../includes/login_verifier.php';
if (!check_login()) {
    header("Location:../");
    exit();
}

$password0 = filter_input(INPUT_POST, "pw_old", FILTER_CALLBACK, array('options' => 'validate_strings'));
$password1 = filter_input(INPUT_POST, "pw_new1", FILTER_CALLBACK, array('options' => 'validate_strings'));
$password2 = filter_input(INPUT_POST, "pw_new2", FILTER_CALLBACK, array('options' => 'validate_pw'));

function validate_strings($value) {
    if (strlen($value) > 0) {
        return $value;
    }
    return null;
}

function validate_pw($value) {
    global $password1;
    if ($password1 == $value) {
        return $value;
    }
    return null;
}

if ($password0 == null) {
    header("Location:../settings?error=nullp0");
    exit();
} else if ($password1 == null) {
    header("Location:../settings?error=nullp1");
    exit();
} else if ($password2 == null) {
    header("Location:../settings?error=nullp2");
    exit();
} else {
    include './db_connection.php';
    $con = db();
    $result = $con->query("select * from user where id=" . $_SESSION["user_id"]);
    if ($result->num_rows == 1) {
        $result = $result->fetch_assoc();
        if (password_verify($password0, $result['password'])) {
            $con->query("update user set password='" . password_hash($password1, PASSWORD_DEFAULT) . "' where id=" . $_SESSION["user_id"]);
            header("Location:../settings?success");
        } else {
            header("Location:../settings?error=invalid");
        }
    } else {
        header("Location:../settings?error=invalid");
    }
    $con->close();
}