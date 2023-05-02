<!DOCTYPE html>
<html>
    <?php include('../../templates/header.php'); ?>
    <div class="row">
    <div class="col s12 m6 offset-m3">
        <div class="card">
        <div class="card-content">
            <span class="card-title center">Register for PHPizza</span>
            <form method="post" action="controller.php">
            <div class="row">
                <div class="input-field col s12 m6">
                <input type="text" name="firstName" value=" <?php echo htmlspecialchars($formData['firstName']); ?>" required>
                <label for="firstName">First Name</label>
                <div class="red-text"><?php echo htmlspecialchars($errors['firstName']);?></div>
                </div>

                <div class="input-field col s12 m6">
                <input type="text" name="lastName" value="<?php echo htmlspecialchars($formData['lastName']); ?>" required>
                <label for="lastName">Last Name</label>
                <div class="red-text"><?php echo htmlspecialchars($errors['lastName']);?></div>

                </div>
            </div>
            <div class="row">
                <div class="input-field col s12">
                <input type="email" name="email" value="<?php echo htmlspecialchars($formData['email']); ?>" required>
                <label for="email">Email</label>
                <div class="red-text"><?php echo htmlspecialchars($errors['email']);?></div>
                </div>
            </div>
            <div class="row">
                <div class="input-field col s12">
                <input type="password" name="password" required>
                <label for="password">Password</label>
                <div class="red-text"><?php echo htmlspecialchars($errors['password']);?></div>
                </div>
            </div>
            <div class="row">
                <div class="input-field col s12">
                <input type="password" name="passwordConfirmation" required>
                <label for="passwordConfirmation">Confirm Password</label>
                <div class="red-text"><?php echo htmlspecialchars($errors['passwordConfirmation']);?></div>
                </div>
            </div>
            <div class="row">
                <div class="col s12">
                <button type="submit" value="submit" name="submit" class="btn blue-grey waves-effect waves-light full-width">Register</button>
                </div>
            </div>
            </form>
        </div>
        </div>
    </div>
    </div>

    <?php if (!empty($errors['emailInUse'])): ?>
        <div class="row">
            <div class="col s12 m6 offset-m3">
                <div class="card red lighten-4">
                    <div class="card-content">
                        <span class="card-title center"><?php echo htmlspecialchars_decode($errors['emailInUse']); ?></span>
                    </div>
                </div>
            </div>
        </div>
    <?php endif; ?>

    <?php include('../../templates/footer.php'); ?>

</html>