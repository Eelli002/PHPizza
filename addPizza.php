<?php 

    // Print $_POST Object;
    function getPOST() {
        echo 'Here is our $POST object: ';
        htmlspecialchars(print_r($_POST));
        echo '<br/>';
    }

    // Validates email and returns error to validateInputs function for handling
    function emailValidation() {
        $error = '';
        if (empty($_POST['email'])) {
            $error = 'An email is required <br/>';
        } 
        else {
          $email = $_POST['email'];
          if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            $error = 'enter a valid email address <br/> ';
          }
        }
        return $error;
    }

    /* Checks to see if title consists of letters and spaces and returns error 
    to validateInputs function for handling */
    function titleValidation() {
        $error = '';
        if (empty($_POST['title'])) {
            $error = 'An title is required <br/>';
        }
        else {
            $title = $_POST['title'];
            if (!preg_match('/^[a-zA-Z\s]+$/', $title)) {
                $error = 'Title must contain only letters and spaces <br/>';
            }
        }
        return $error;
    }

    /* Checks to see if ingredients input are comma separated values and
    returns our error message to our validateInputs function for handling */
    function validateIngredients() {
        $error = '';
        if (empty($_POST['ingredients'])) {
            $error = 'At lease one ingredient is required <br/>';
        }
        else {
            $ingredients = $_POST['ingredients'];
            if (!preg_match('/^([a-zA-Z\s]+)(,\s*[a-zA-Z\s]*)*$/', $ingredients)) {
                $error = 'Please list ingredients separated by a comma <br/>';
            }
        }
        return $error;
    }

    /* Handles the errors from our validation functions, if there was an
    invalid input then we handle the response to the client else return 
    an empty string, returns errors in a dictionary to our script */
    function validateInputs() {
        $errors = [];
        $errors['email'] = emailValidation();
        $errors['title'] = titleValidation();
        $errors['ingredients'] = validateIngredients();
        return $errors;
    }



    if (isset($_POST['submit'])) {
        getPOST();
        
        // Server side input validations
        $errors = validateInputs();
    }
?>

<!DOCTYPE html>
<html lang="en">
    <?php include('templates/header.php'); ?>
    <section class="container grey-text">
        <h4 class="center">Add a Pizza</h4>
        <form class="white" action="addPizza.php " method="POST">
            <label>Your Email:</label>
            <input type="text" name="email">
            <label>Pizza Title:</label>
            <input type="text" name="title">
            <label>Ingredient (comma separated):</label>
            <input type="text" name="ingredients">
            <div class="center">
                <input type="submit" value="submit" name="submit" class="btn brand z-depth-0">
            </div>
        </form>
    </section>
    <?php include('templates/footer.php'); ?>
</html>