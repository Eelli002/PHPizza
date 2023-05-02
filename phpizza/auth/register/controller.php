<?php
session_start();
include_once('model.php');
include('../../config/db_connect.php');

$formData = ['firstName'=>'', 'lastName'=>'', 'email'=>''];

$errors = ['firstName'=>'', 'lastName'=>'', 'email'=>'', 'password'=>'', 'passwordConfirmation'=>'', 'emailInUse' => ''];

if (formSubmitted()) {
    $formData = getFormData();
    $errors = validateFormData($formData);
    
    if (!array_filter($errors)) {
        $emailInUseError = emailNotInUse($formData['email'], $connection);
        if (empty($emailInUseError)) {
            createNewUser($formData, $connection);
            loginUser($formData['email']);
        } else {
            $errors['emailInUse'] = $emailInUseError;
        }
    }

}
$connection->close();
include('view.php');