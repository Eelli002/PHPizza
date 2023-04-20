<?php 
    // Establish connection to our MySQL server else throguh an error
    $connection = mysqli_connect('localhost', 'Elijah', 'PHPizza123!', 'PHPizza');
    if (!$connection) {
        echo 'Connection Error: ' . mysqli_connect_error();
    }

?>

<!DOCTYPE html>
<html lang="en">
    <?php include('templates/header.php'); ?>
    <?php include('templates/footer.php'); ?>
</html>