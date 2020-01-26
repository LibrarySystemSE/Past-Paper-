<?php

$cc = filter_input(INPUT_GET, "cc", FILTER_CALLBACK, array('options' => 'validate_strings'));

$returnvalue = array();

for ($this_year = idate("Y"); $this_year > 2011; $this_year--) {
    array_push($returnvalue, $this_year);
}

function validate_strings($value) {
    if (strlen($value) > 0) {
        return trim($value);
    }
    return null;
}

if ($cc != null) {
    include './db_connection.php';
    $con = db();
    $result = $con->query("select examination_year from papers where course_code='" . $cc . "'");
    if ($result->num_rows > 0) {
        $returnvalue = array();
        while ($row = $result->fetch_assoc()) {
            array_push($returnvalue, $row["examination_year"]);
        }
    }
    $con->close();
}
echo json_encode($returnvalue);
