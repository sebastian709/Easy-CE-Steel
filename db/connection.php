<?php
try {

    $sname = "localhost";
    $uname = "root";
    $password = "";
    $db_name = "easycesteel";
    $conn = mysqli_connect($sname, $uname, $password, $db_name);

} catch (Exception $e) {
    echo $e->getMessage();
}
?>