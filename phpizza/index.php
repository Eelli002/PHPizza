<?php 
    session_start();
    include('config/db_connect.php');

    /* Currently if the user is logged in we will display all pizza orders
    but will implement the functionaly to only display user's orders soon */
    if (isset($_SESSION['loggedin']) && $_SESSION['loggedin']) {
        $getAllPizzaOrders = 'SELECT title, toppings, id FROM pizzaOrders ORDER BY created_at';
        $result = mysqli_query($connection, $getAllPizzaOrders);
        if (!$result) {
            echo 'Error executing query: ' . mysqli_error($connection);
            exit();
        }
        $pizzas = mysqli_fetch_all($result, MYSQLI_ASSOC);
        mysqli_free_result($result);
    }
    mysqli_close($connection);
?>

<!DOCTYPE html>
<html lang="en">
    <?php include('templates/header.php'); ?>
    <div class="container">
        <?php if (isset($_SESSION['loggedin']) && $_SESSION['loggedin']): ?>
            <h4 class="center grey-text">Your Pizza Orders</h4>
            <div class="row">
            <?php 
                foreach($pizzas as $pizza) { ?>
                    <div class="col s6 md3">
                        <div class="card z-depth-0">
                            <div class="card-content center">
                                <h5><?php echo htmlspecialchars($pizza['title']); ?></h5>
                                <ul>
                                    <h6>Toppings</h6>
                                    <?php
                                        // Here we cycle through our CSV toppings and out each
                                        $toppings = explode(',', $pizza['toppings']);
                                        foreach($toppings as $topping) { ?> 
                                            <li><?php echo htmlspecialchars($topping); ?></li> <?php
                                        } 
                                    ?>
                                </ul>
                            </div>
                            <div class="card-action right-align">
                                <a href="details.php?id=<?php echo $pizza['id']; ?>" class="brand-text">More Info</a>
                            </div>
                        </div>
                    </div><?php
                }
            ?>
        </div>
        <?php else: ?>
            <h4 class="center grey-text">Pizza Specials</h4>
            <p class="center">Check out our latest pizza specials and login or register to order.</p>
            <div class="row">
                <div class="col s12 m6 offset-m3">
                    <div class="card">
                        <div class="card-content">
                            <span class="card-title center">Welcome to PHPizza!</span>
                            <p class="center">Please log in or register to continue.</p>
                            <div class="row center">
                                <div class="col s12 m6">
                                    <a href="auth/login.php" class="btn orange waves-effect waves-light">Log in</a>
                                </div>
                                <div class="col s12 m6">
                                    <a href="auth/register/controller.php" class="btn blue-grey waves-effect waves-light">Register</a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        <?php endif; ?>

        
    </div>
    <?php include('templates/footer.php'); ?>
</html>