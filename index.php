<?php 

    /* Establishes connection to database and fetches all pizza orders */
    include('config/db_connect.php');
    $getAllPizzaOrders = 'SELECT title, toppings, id FROM pizzaOrders ORDER BY created_at';
    $result = mysqli_query($connection, $getAllPizzaOrders);
    if (!$result) {
        echo 'Error executing query: ' . mysqli_error($connection);
        exit();
    }
    $pizzas = mysqli_fetch_all($result, MYSQLI_ASSOC);
    mysqli_free_result($result);
    mysqli_close($connection);

    // print_r($pizzas);
?>

<!-- Will display all pizza orders in their own container with a link to each
order for more details -->
<!DOCTYPE html>
<html lang="en">
    <?php include('templates/header.php'); ?>
    <h4 class="center grey-text">Pizza Orders</h4>
    <div class="container">
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
    </div>
    <?php include('templates/footer.php'); ?>
</html>