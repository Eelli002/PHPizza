<?php
function formSubmitted() {
    return isset($_POST['submit']);
}

function getFormData() {
    $formData = [
        'firstName' => isset($_POST['firstName']) ? trim($_POST['firstName']) : '',
        'lastName' => isset($_POST['lastName']) ? trim($_POST['lastName']) : '',
        'email' => isset($_POST['email']) ? trim($_POST['email']) : '',
        'password' => isset($_POST['password']) ? $_POST['password'] : '',
        'passwordConfirmation' => isset($_POST['passwordConfirmation']) ? $_POST['passwordConfirmation'] : '',
    ];
    return $formData;
}

function validateFormData($formData) {
    $errors = [
        'firstName' => firstNameValidation($formData['firstName']),
        'lastName' => lastNameValidation($formData['lastName']),
        'email' => emailValidation($formData['email']),
        'password' => passwordValidation($formData['password']),
        'passwordConfirmation' => passwordConfirmationValidation($formData['password'], $formData['passwordConfirmation']),
    ];
    return $errors;
}

function firstNameValidation(&$firstName) {
    $nameRegex = '/^[a-zA-Z\s-]{1,50}$/';
    if (empty($firstName)) {
        $error = 'Enter your first name';
    }
    else if (!preg_match($nameRegex, $firstName)) {
        $firstName = '';
        $error = 'Name must consist of alphabetical letters';
    } 
    else {
        $error = '';
    }
    return $error;
}

function lastNameValidation(&$lastName) {
    $nameRegex = '/^[a-zA-Z\s-]{1,50}$/';
    if (empty($lastName)) {
        $error = 'Enter your last name';
    }
    else if (!preg_match($nameRegex, $lastName)) {
        $lastName = '';
        $error = 'Name must consist of alphabetical letters';
    } 
    else {
        $error = '';
    }
    return $error;
}

function emailValidation(&$email) {
    if (empty($email)) {
        $error = 'An email is required';
    }
    else if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $email = '';
        $error = 'enter a valid email address';
    }
    else {
        $error = '';
    }
    return $error;
}

function passwordValidation(&$password) {
    $passwordRegex = '/^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)(?=.*[@$!%*?&])[A-Za-z\d@$!%*?&]{8,}$/';
    if (empty($password)) {
        $error = 'A password is required';
    }
    else if (!preg_match($passwordRegex, $password)) {
        $password = '';
        $error = 'Password must contain minimum eight characters, at least one uppercase letter, one lowercase letter, one number, and one special character';
    }
    else {
        $error = '';
    }
    return $error;
}

function passwordConfirmationValidation(&$password, &$passwordConfirmation) {
    if (empty($passwordConfirmation)) {
        $error = 'Please confirm your password';
    }
    else if ($passwordConfirmation !== $password) {
        $passwordConfirmation = '';
        $error = 'Passwords must match';
    }
    else {
        $error = '';
    }
    return $error;
}

function emailNotInUse($email, $connection) {
    $stmt = $connection->prepare("SELECT id FROM users WHERE email = ?");
    $stmt->bind_param("s", $email);
    $stmt->execute();
    $stmt->store_result();
    $userExists = $stmt->num_rows > 0;
    $errorMessage = '';
    if ($userExists) {
        $errorMessage = "The email is already associated with an account. <a href='/phpizza/auth/login.php'>Click here to log in.</a>";
    }
    $stmt->close();
    return $errorMessage;
}

function createNewUser($formData, $connection) {
    $query = "INSERT INTO users (firstName, lastName, email, password) VALUES (?,?,?,?)";
    $stmt = $connection->prepare($query);
    $hashedPassword = password_hash($formData['password'], PASSWORD_DEFAULT);
    $stmt->bind_param("ssss", $formData['firstName'], $formData['lastName'], $formData['email'], $hashedPassword);
    $stmt->execute();
    $stmt->close();
    $connection->close();
}

function loginUser($email) {
    $_SESSION['loggedin'] = true;
    $_SESSION['user'] = $email;
    header("Location: /PHPizza/index.php");
    exit;
}
?>