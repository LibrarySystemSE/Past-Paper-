<?php

session_start();
unset($_SESSION["user_type"]);
unset($_SESSION["user_id"]);
header("Location:../");
