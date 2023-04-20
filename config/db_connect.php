<?php
    $connection = mysqli_connect('localhost', 'Elijah', 'PHPizza123!', 'PHPizza');
    if (!$connection) {
        echo 'Failed to connect to MySQL: ' . mysqli_connect_error();
        exit();
    }
?>