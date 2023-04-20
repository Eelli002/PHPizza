<?php 
    //if (isset($_GET['submit'])) {
      //   htmlspecialchars(print_r($_GET));
        // echo htmlspecialchars($_GET['email']);
        // echo htmlspecialchars($_GET['title']);
        // echo htmlspecialchars($_GET['ingredients']);
    // }

    // Print $_POST Object;
    function getPOST() {
        echo 'Here is our $POST object: ';
        htmlspecialchars(print_r($_POST));
        echo '<br/>';
    }

    // Email Validation
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

    function validateInputs() {
        $errors = [
            'email' => '',
            'title' => '',
            'ingredients' => ''
        ];
        $errors['email'] = emailValidation();
        $errors['title'] = titleValidation();
        $errors['ingredients'] = validateIngredients();
        return $errors;
    }

 # 1461 money order or cashiers check

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