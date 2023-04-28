<?php
    /* Checks to see if a POST request has been made to delete a pizza,
    if it has then it passes the ID to deletePizza */
    if (isset($_POST['delete'])) {
        $delete_id = $_POST['delete_id'];
        deletePizza($delete_id);
    }

    /* Checks to see if we have passed in an arguement for ID, captures it
    from the URL and sends it to our getPizza function to retrieve from database */
    if (isset($_GET['id'])) {
        $id = $_GET['id'];
        $pizza = getPizza($id);
    }

    /* Retrieves the pizza order from the database with the given ID and returns
    it as an associative array. */
    function getPizza($id) {
        include ('config/db_connect.php');
        $id = mysqli_real_escape_string($connection, $id); // Escapes special chars in ID param to prevent SQL i attacks
        $selectPizzaQuery = "SELECT * FROM pizzaOrders WHERE id = $id";
        $result = mysqli_query($connection, $selectPizzaQuery);
        if (!$result) {
            echo 'Error executing query: ' . mysqli_error($connection);
            exit();
        }
        $pizza = mysqli_fetch_assoc($result);
        mysqli_free_result($result);
        mysqli_close($connection);
        return $pizza;
    }

    /* Deletes the pizza order with the given ID from the database, if an error
    occurs we alert the user else redirect them back to the index page. */
    function deletePizza($id) {
        include ('config/db_connect.php');
        $id = mysqli_real_escape_string($connection, $id);
        $deleteQuery = "DELETE FROM pizzaOrders WHERE id = $id";
        $result = mysqli_query($connection, $deleteQuery);
        if (!$result) {
            echo 'Error executing delete query: ' . mysqli_error($connection);
            exit();
        }
        else {
            mysqli_close($connection);
            header('Location: index.php');
        }
    }
?>

 <!-- Display pizza order that was retrieved from DB -->
<!DOCTYPE html>
<html>
    <?php include('templates/header.php'); ?>
        <div class="container center">
            <?php if ($pizza): ?>
                <h4><?php echo htmlspecialchars($pizza['title']); ?></h4>
                <p>Created by: <?php echo htmlspecialchars($pizza['email']); ?></p>
                <p>On: <?php echo date($pizza['created_at']); ?></p>
                <h5>Toppings:</h5>
                <p><?php echo htmlspecialchars($pizza['toppings']); ?></p>

                <form action="details.php" method="POST">
                    <input type="hidden" name="delete_id" value="<?php echo $pizza['id']; ?>" >
                    <input type="submit" name="delete" value="Delete" class="btn brand z-depth-0">
                </form>

            <?php else: ?>
                <h5>This is not a valid order number</h5>
            <?php endif; ?>
        </div>
    <?php include('templates/footer.php'); ?>
</html>