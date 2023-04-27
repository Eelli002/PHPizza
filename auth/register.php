<?php 
    $firstName = '';
    $lastName = '';
    $email = '';
    $password = '';
    $passwordConfirmation = '';
    $errors = ['firstName'=>'', 'lastName'=>'', 'email'=>'', 'password'=>'', 'passwordConfirmation'=>''];

    if(isset($_POST['submit'])) {
        // $errors = validateInputs($firstName, $lastName, $email, $password, $passwordConfirmation);
        if (!array_filter($errors)) {
            // check to see if the email exists in the database
            if (!isUser($email)) {
                if (passwordsMatch($password, $passwordConfirmation)) {
                    // salt password
                    $saltedPassword = saltPassword($password);
                    // create new user in database
                    createNewUser($firstName, $lastName, $email, $saltedPassword);
                    // log the user in and redirect to index
                    $_SESSION['loggedin'] = true;
                    $_SESSION['user'] = $email;
                    header('Location: index.php');
                    exit;
                }
                $error = "Passwords do not match";
            } 
            else {
                $error = "The email is already associated with an account. <a href='/phpizza/auth/login.php'>Click here to log in.</a>";
            }
        }
    }

    function saltPassword($password) {
        $saltedPassword = '';
        return $saltedPassword;
    }


    function passwordsMatch($password, $passwordConfirmation) {
        $result = ($password == $passwordConfirmation) ? true : false;
        return $result;
    }

    function createNewUser($firstName, $lastName, $email, $password) {
        return;
    }

    function validateInputs(&$firstName, &$lastName, &$email, &$password, &$passwordConfirmation) {
        $errors['firstName'] = ''; 
        return $errors;
    }
    
    // check to see if the email exists in the database
    function isUser($email) {
        include('../config/db_connect.php');
        $stmt = $connection->prepare("SELECT id FROM users WHERE email = ?");
        $stmt->bind_param("s", $email);
        $stmt->execute();
        $stmt->store_result();

        $userExists = $stmt->num_rows > 0;

        $stmt->close();
        $connection->close();

        return $userExists;
    }
?>

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
                <button type="submit" value="submit" name="submit" class="btn blue-grey waves-effect waves-light full-width">Register</button>
                </div>
            </div>
            </form>
        </div>
        </div>
    </div>
    </div>

    <?php if (isset($error)): ?>
        <div class="row">
            <div class="col s12 m6 offset-m3">
                <div class="card red lighten-4">
                    <div class="card-content">
                        <span class="card-title center"><?php echo htmlspecialchars_decode($error); ?></span>
                    </div>
                </div>
            </div>
        </div>
    <?php endif; ?>

    <?php include('../templates/footer.php'); ?>

</html>