<?php ?>

<!DOCTYPE html>
<html>
    <?php include('../templates/header.php'); ?>
    <div class="row">
    <div class="col s12 m6 offset-m3">
        <div class="card">
        <div class="card-content">
            <span class="card-title center">Register for PHPizza</span>
            <form method="post" action="register.php">
            <div class="row">
                <div class="input-field col s12 m6">
                <input id="first_name" type="text" name="first_name" required>
                <label for="first_name">First Name</label>
                </div>
                <div class="input-field col s12 m6">
                <input id="last_name" type="text" name="last_name" required>
                <label for="last_name">Last Name</label>
                </div>
            </div>
            <div class="row">
                <div class="input-field col s12">
                <input id="email" type="email" name="email" required>
                <label for="email">Email</label>
                </div>
            </div>
            <div class="row">
                <div class="input-field col s12">
                <input id="password" type="password" name="password" required>
                <label for="password">Password</label>
                </div>
            </div>
            <div class="row">
                <div class="input-field col s12">
                <input id="password_confirmation" type="password" name="password_confirmation" required>
                <label for="password_confirmation">Confirm Password</label>
                </div>
            </div>
            <div class="row">
                <div class="col s12">
                <button type="submit" class="btn blue-grey waves-effect waves-light full-width">Register</button>
                </div>
            </div>
            </form>
        </div>
        </div>
    </div>
    </div>
    <?php include('../templates/footer.php'); ?>

</html>