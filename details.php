<?php
    include ('config/db_connect.php');
    if (isset($_GET['id'])) {
        $id = mysqli_real_escape_string($connection, $_GET['id']);
        $selectPizzaQuery = "SELECT * FROM pizzaOrders WHERE id = $id";
        $result = mysqli_query($connection, $selectPizzaQuery);
        $pizza = mysqli_fetch_assoc($result);
        mysqli_free_result($result);
        mysqli_close($connection);
    }
?>

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
            <?php else: ?>
                <h5>This is not a valid order number</h5>
            <?php endif; ?>
        </div>
    <?php include('templates/footer.php'); ?>
</html>