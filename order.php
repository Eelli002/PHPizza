<?php 
    // Upon initial page load we will have blank inputs thus no errors
    $email = '';
    $title = '';
    $ingredients = '';
    $errors = ['email'=>'', 'title'=>'', 'ingredients'=>''];

    /* If we have already sent a POST request and are redirected back,
    check for errors */


    /* Validates user inputs and if there are no errors then it redirects
    back to the homepage, else it will stay on page and keep state */
    if (isset($_POST['submit'])) {
        // getPOST();
        $errors = validateInputs($email, $title, $ingredients);
        if (!array_filter($errors)) {
            header('Location: index.php');
        }
    }

    /* Handles the errors from our validation functions, if there was an
    invalid input then we handle the response to the client else return 
    an empty string, returns errors in a dictionary to our script */
    function validateInputs(&$email, &$title, &$ingredients) {
        $errors['email'] = emailValidation($email);
        $errors['title'] = titleValidation($title);
        $errors['ingredients'] = validateIngredients($ingredients);
        return $errors;
    }

    /* Sets and validates email, returns error to validateInputs function 
    for handling */
    function emailValidation(&$email) {
        $error = '';
        if (empty($_POST['email'])) {
            $error = 'An email is required';
        } 
        else {
          $email = $_POST['email'];
          if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            $error = 'enter a valid email address';
            $email = '';
          }
        }
        return $error;
    }

    /* Sets title and checks to see if it consists of letters and spaces and
    returns error to validateInputs function for handling */
    function titleValidation(&$title) {
        $error = '';
        if (empty($_POST['title'])) {
            $error = 'An title is required';
        }
        else {
            $title = $_POST['title'];
            if (!preg_match('/^[a-zA-Z\s]+$/', $title)) {
                $error = 'Title must contain only letters and spaces';
                $title = '';
            }
        }
        return $error;
    }

    /* Checks to see if ingredients input are comma separated values and
    returns our error message to our validateInputs function for handling */
    function validateIngredients(&$ingredients) {
        $error = '';
        if (empty($_POST['ingredients'])) {
            $error = 'At lease one ingredient is required';
        }
        else {
            $ingredients = $_POST['ingredients'];
            if (!preg_match('/^([a-zA-Z\s]+)(,\s*[a-zA-Z\s]*)*$/', $ingredients)) {
                $error = 'Please list ingredients separated by a comma';
                $ingredients = '';
            }
        }
        return $error;
    }

    // Print $_POST Object;
    function getPOST() {
        echo 'Here is our $POST object: ';
        htmlspecialchars(print_r($_POST));
        echo '<br/>';
    }
?>

<!DOCTYPE html>
<html lang="en">
    <?php include('templates/header.php'); ?>
    <section class="container grey-text">
        <h4 class="center">Add a Pizza</h4>
        <form class="white" action="order.php " method="POST">

            <label>Your Email:</label>
            <input type="text" name="email" value="<?php echo $email; ?>">
            <div class="red-text"><?php echo htmlspecialchars($errors['email']);?></div>

            <label>Pizza Title:</label>
            <input type="text" name="title" value="<?php echo $title; ?>">
            <div class="red-text"><?php echo htmlspecialchars($errors['title']);?></div>

            <label>Ingredient (comma separated):</label>
            <input type="text" name="ingredients" value="<?php echo $ingredients; ?>">
            <div class="red-text"><?php echo htmlspecialchars($errors['ingredients']);?></div>

            <div class="center">
                <input type="submit" value="submit" name="submit" class="btn brand z-depth-0">
            </div>
        </form>
    </section>
    <?php include('templates/footer.php'); ?>
</html>