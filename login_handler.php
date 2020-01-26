<?php

session_start();
include './db_connection.php';

$nic = filter_input(INPUT_POST, "nic", FILTER_CALLBACK, array('options' => 'validate_strings'));
$password = filter_input(INPUT_POST, "password");

function validate_strings($value) {
    $value = trim($value);
    if (strlen($value) > 0) {
        return $value;
    }
    return null;
}

if ($password == null || $nic == null) {
    header("Location:../?error=invalid");
    exit();
} else {

    $con = db();

    $result = $con->query("select * from user where nic='" . $con->real_escape_string($nic) . "' or username='" . $con->real_escape_string($nic) . "'");

    if ($result->num_rows == 1) {

        $result = $result->fetch_assoc();

        if (password_verify($password, $result['password'])) {
            switch ($result["status"]) {
                case "NEW":
                    $con->close();
                    header("Location:../?error=new");
                    break;
                case "DISABLED":
                    $con->close();
                    header("Location:../?error=disabled");
                    break;
                default:
                    $_SESSION["user_type"] = $result["user_type"];
                    $_SESSION["user_id"] = $result["id"];
                    if ($result["user_type"] == "LIBRARIAN") {
                        header("Location:../usersm");
                    } else {
                        header("Location:../download");
                    }
                    $con->close();
                    break;
            }
        } else {
            header("Location:../?error=invalid");
            $con->close();
        }
    } else {
        header("Location:../?error=invalid");
        $con->close();
    }
}