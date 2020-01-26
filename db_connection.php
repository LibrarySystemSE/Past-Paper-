<?php

function db() {
    $con = new mysqli("localhost", "root", "", "pastpapers", "3306");
    $con->set_charset("utf8");
    return $con;
}
