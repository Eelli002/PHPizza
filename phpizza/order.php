<?php 
    // Upon initial page load we will have blank inputs thus no errors
    session_start();
    $email = '';
    $title = '';
    $toppings = '';
    $errors = ['email'=>'', 'title'=>'', 'toppings'=>''];


    /* Validates user inputs and if there are no errors then we save the
    order to the database and redirect back to the homepage, else we 
    will stay on page and keep state on valid inputs */
    if (isset($_POST['submit'])) {
        // getPOST();
        $errors = validateInputs($email, $title, $toppings);
        if (!array_filter($errors)) {
            include('config/db_connect.php');
            $email = mysqli_real_escape_string($connection, $email);
            $title = mysqli_real_escape_string($connection, $title);
            $toppings = mysqli_real_escape_string($connection, $toppings);
            $orderPizzaQuery = "INSERT INTO pizzaOrders(email, title, toppings) VALUES ('$email', '$title', '$toppings')";
            if (mysqli_query($connection, $orderPizzaQuery)) {
                header('Location: index.php');
            } 
            else {
                echo 'query error ' . mysqli_error($connection);
            }
        }
    }

    /* Handles the errors from our validation functions, if there was an
    invalid input then we update our error dictionary */
    function validateInputs(&$email, &$title, &$toppings) {
        $errors['email'] = emailValidation($email);
        $errors['title'] = titleValidation($title);
        $errors['toppings'] = validateToppings($toppings);
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

    /* Sets title and checks to see if it consists of letters and spaces
    and returns error to validateInputs function */
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

    /* Checks to see if toppings input are comma separated values and
    returns our error message to our validateInputs function */
    function validateToppings(&$toppings) {
        $error = '';
        if (empty($_POST['toppings'])) {
            $error = 'At lease one topping is required';
        }
        else {
            $toppings = $_POST['toppings'];
            if (!preg_match('/^([a-zA-Z\s]+)(,\s*[a-zA-Z\s]*)*$/', $toppings)) {
                $error = 'Please list toppings separated by a comma';
                $toppings = '';
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

            <label>Toppings (comma separated):</label>
            <input type="text" name="toppings" value="<?php echo $toppings; ?>">
            <div class="red-text"><?php echo htmlspecialchars($errors['toppings']);?></div>

            <div class="center">
                <input type="submit" value="submit" name="submit" class="btn brand z-depth-0">
            </div>
        </form>
    </section>
    <?php include('templates/footer.php'); ?>
</html>