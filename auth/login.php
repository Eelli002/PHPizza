<?php ?>

<!DOCTYPE html>
<html>
    <?php include('../templates/header.php'); ?>
    <div class="row">
    <div class="col s12 m6 offset-m3">
        <div class="card">
        <div class="card-content">
            <span class="card-title center">Log in to PHPizza</span>
            <form method="post" action="login.php">
            <div class="input-field">
                <input id="email" type="email" name="email" required>
                <label for="email">Email</label>
            </div>
            <div class="input-field">
                <input id="password" type="password" name="password" required>
                <label for="password">Password</label>
            </div>
            <div class="center">
                <button type="submit" class="btn orange waves-effect waves-light">Log in</button>
            </div>
            </form>
            <div class="center">
            <a href="register.php">Don't have an account? Register now</a>
            </div>
        </div>
        </div>
    </div>
    </div>
    <?php include('../templates/footer.php'); ?>
</html>