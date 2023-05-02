<?php  ?>

<!DOCTYPE html>
<html>
    <?php include('../templates/header.php'); ?>
    <div class="row">
    <div class="col s12 m6 offset-m3">
        <div class="card">
        <div class="card-content">
            <span class="card-title center">Welcome to PHPizza!</span>
            <p class="center">Please log in or register to continue.</p>
            <div class="row center">
            <div class="col s12 m6">
                <a href="login.php" class="btn orange waves-effect waves-light">Log in</a>
            </div>
            <div class="col s12 m6">
                <a href="register/controller.php" class="btn blue-grey waves-effect waves-light">Register</a>
            </div>
            </div>
        </div>
        </div>
    </div>
    </div>
    <?php include('../templates/footer.php'); ?>
</html>

