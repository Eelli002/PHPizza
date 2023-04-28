<?php
    $connection = mysqli_connect('phpizza-db-1', 'Elijah', 'PHPizza123!', 'PHPizza');
    if (!$connection) {
        echo 'Failed to connect to MySQL: ' . mysqli_connect_error();
        exit();
    }
?>