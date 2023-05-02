<?php
    session_start();

    $firstName = '';
    $lastName = '';
    $email = '';
    $password = '';
    $passwordConfirmation = '';
    $errors = ['firstName'=>'', 'lastName'=>'', 'email'=>'', 'password'=>'', 'passwordConfirmation'=>'', 'emailInUse' => ''];

    if (formSubmitted() && inputsValid() && isNotUser($email)) {
        createNewUser($firstName, $lastName, $email, $password);
        login($email);
    }

    /* Checks if the form has been submitted by verifying if the 
    submit key is set in the $_POST array */
    function formSubmitted() {
        return isset($_POST['submit']);
    }

    /* Validates user input by calling the errorSetter() function and 
    checking if there are any non-empty error messages in the $errors 
    array */
    function inputsValid() {
        errorSetter();
        return !array_filter($GLOBALS['errors']);
    }

    /* Sets the error messages for each input field by calling the 
    corresponding validation functions */
    function errorSetter() {
        $GLOBALS['errors']['firstName'] = firstNameValidation();
        $GLOBALS['errors']['lastName'] = lastNameValidation();
        $GLOBALS['errors']['email'] = emailValidation();
        $GLOBALS['errors']['password'] = passwordValidation();
        $GLOBALS['errors']['passwordConfirmation'] = passwordConfirmationValidation();
    }

    /* Validates the first name input, checking if it's set, 
    non-empty, and contains only valid characters (letters, spaces, 
    and hyphens). Sets the global $firstName variable if valid */
    function firstNameValidation() {
        $error = '';
        if (!isset($_POST['first_name'])) {
            $error = 'Enter your first name';
        }
        else {
            $nameRegex = '/^[a-zA-Z\s-]{1,50}$/';
            if (!preg_match($nameRegex, $_POST['first_name'])) {
                $error = 'Name must consist of alphabetical letters';
            } else {
                $GLOBALS['firstName'] = $_POST['first_name'];
            }
        }
        return $error;
    }

    /* Validates the last name input, checking if it's set, non-empty, 
    and contains only valid characters (letters, spaces, and hyphens). 
    Sets the global $lastName variable if valid */
    function lastNameValidation() {
        $error = '';
        if (!isset($_POST['last_name'])) {
            $error = 'Enter your last name';
        }
        else {
            $nameRegex = '/^[a-zA-Z\s-]{1,50}$/';
            if (!preg_match($nameRegex, $_POST['last_name'])) {
                $error = 'Name must consist of alphabetical letters';
            } else {
                $GLOBALS['lastName'] = $_POST['last_name'];
            }
        }
        return $error;
    }

    /* Validates the email input, checking if it's set, non-empty, and 
    is a valid email address. Sets the global $email variable if valid. */
    function emailValidation() {
        if (empty($_POST['email'])) {
            $error = 'An email is required';
        } 
        else if (!filter_var($_POST['email'], FILTER_VALIDATE_EMAIL)) {
            $error = 'enter a valid email address';
        } 
        else {
            $GLOBALS['email'] = $_POST['email'];
            $error = '';
        }
        return $error;
    }

    /* Validates the password input, checking if it's set, non-empty, 
    and meets the required complexity. Sets the global $password 
    variable if valid */
    function passwordValidation() {
        if (empty($_POST['password'])) {
            $error = 'A password is required';
        }
        else {
            $passwordRegex = '/^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)(?=.*[@$!%*?&])[A-Za-z\d@$!%*?&]{8,}$/';
            if (!preg_match($passwordRegex, $_POST['password'])) {
                $error = 'Password must contain minimum eight characters, at least one uppercase letter, one lowercase letter, one number, and one special character';
            } else {
                $GLOBALS['password'] = $_POST['password'];
                $error = '';
            }
        }
        return $error;
    }

    /* Validates the password confirmation input, checking if it's 
    set, non-empty, and matches the original password. Sets the global 
    $passwordConfirmation variable if valid */
    function passwordConfirmationValidation() {
        if (empty($_POST['password_confirmation'])) {
            $error = 'Please confirm your password';
        }
        else if ($_POST['password_confirmation'] !== $_POST['password']) {
            $error = 'Passwords must match';
        }
        else {
            $GLOBALS['passwordConfirmation'] = $_POST['password_confirmation'];
            $error = '';
        }
        return $error;
    }
    

    /* Checks if an email is not already associated with an existing 
    user in the database by querying the database for a user with the 
    provided email */
    function isNotUser($email) {
        include('../config/db_connect.php');
        $stmt = $connection->prepare("SELECT id FROM users WHERE email = ?");
        $stmt->bind_param("s", $email);
        $stmt->execute();
        $stmt->store_result();

        $userExists = $stmt->num_rows > 0;
        if ($userExists) {
            $GLOBALS['errors']['emailInUse'] = "The email is already associated with an account. <a href='/phpizza/auth/login.php'>Click here to log in.</a>";
        }

        $stmt->close();
        $connection->close();

        return !$userExists;
    }

    /* Inserts a new user into the database with the provided first 
    name, last name, email, and hashed password */
    function createNewUser($firstName, $lastName, $email, $password) {
        include('../config/db_connect.php');
        $query = "INSERT INTO users (firstName, lastName, email, password) VALUES (?,?,?,?)";
        $stmt = $connection->prepare($query);
        $stmt->bind_param("ssss", $firstName, $lastName, $email, $hashedPassword);
        $hashedPassword = password_hash($password, PASSWORD_DEFAULT);
        $stmt->execute();

        $stmt->close();
        $connection->close();
    }

    /* Logs in the user by setting session variables and redirecting 
    them to the index.php page */
    function login($email) {
        $_SESSION['loggedin'] = true;
        $_SESSION['user'] = $email;
        header("Location: /PHPizza/index.php");
        exit;
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
                <label>First Name</label>
                <input type="text" name="first_name" value="<?php $formData['firstName'] ?>" required>
                <div class="red-text"><?php echo htmlspecialchars($errors['firstName']);?></div>
                </div>
                <div class="input-field col s12 m6">
                <input type="text" name="last_name" value="<?php $formData['lastName'] ?>" required>
                <label for="last_name">Last Name</label>
                <div class="red-text"><?php echo htmlspecialchars($errors['lastName']);?></div>
                </div>
            </div>
            <div class="row">
                <div class="input-field col s12">
                <input type="email" name="email" value="<?php $formData['email'] ?>" required>
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
                <input type="password" name="password_confirmation" required>
                <label for="password_confirmation">Confirm Password</label>
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

    <!-- checks if the emailInUse error in the $errors array is not 
    empty, meaning that the email address provided by the user is 
    already associated with an existing account. If the error is not 
    empty, the code displays an error message -->
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

    <?php include('../templates/footer.php'); ?>

</html>