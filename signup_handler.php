<?php

session_start();
include './db_connection.php';


$name = filter_input(INPUT_POST, "name", FILTER_CALLBACK, array('options' => 'validate_strings'));
$nic = filter_input(INPUT_POST, "nic", FILTER_CALLBACK, array('options' => 'validate_strings'));
$username = filter_input(INPUT_POST, "username", FILTER_CALLBACK, array('options' => 'validate_strings'));
$password1 = filter_input(INPUT_POST, "password1");
$password2 = filter_input(INPUT_POST, "password2", FILTER_CALLBACK, array('options' => 'validate_pw'));
$account = filter_input(INPUT_POST, "account", FILTER_CALLBACK, array('options' => 'validate_acc'));

function validate_strings($value) {
    $value = trim($value);
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

function validate_acc($value) {
    $value = validate_strings($value);
    if ($value == "STUDENT" || $value == "ACDSTAFF" || $value == "LIBRARIAN") {
        return $value;
    }
    return null;
}

if ($name == null || $password1 == null || $password2 == null || $account == null || $nic == null || $username == null) {
    header("Location:../signup.php?error=invalid");
} else {

    $con = db();

    $result = $con->query("select count(id) as c from user where nic='" . $con->real_escape_string($nic) . "'");

    if ($result->fetch_assoc()['c'] != '0') {
        $con->close();
        header("Location:../signup.php?error=exist");
        exit();
    } else {

        $result = $con->query("select count(username) as c from user where username='" . $con->real_escape_string($username) . "'");

        if ($result->fetch_assoc()['c'] != '0') {
            $con->close();
            header("Location:../signup.php?error=taken");
            exit();
        } else {
            $con->query("INSERT INTO user (name, username, nic, `password`, `status`, user_type, sign_up_date) VALUES ( '" . $con->real_escape_string($name) . "', '" . $con->real_escape_string($username) . "', '" . $con->real_escape_string($nic) . "', '" . password_hash($password1, PASSWORD_DEFAULT) . "', 'NEW', '" . $account . "', '" . date("Y-m-d") . "')");

            $con->close();
            header("Location:../signup.php?success");
            exit();
        }
    }
}



