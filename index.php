<?php 

include('config/db_connect.php'); 


// 3 steps = 1-construct query 2-make the query 3-fetch the results from the query

// 1 write the query for all pizzas , 
// store the query in a variable called $sql

$sql = 'SELECT title, ingredients, id FROM pizzas';

// 2 make query & get result
$result = mysqli_query($conn, $sql);

// 3 fetch the resulting rows as an array
// store it in a variable $pizzas
$pizzas = mysqli_fetch_all($result, MYSQLI_ASSOC);

// free the $result from memory (good practise)
mysqli_free_result($result);

// close connection
mysqli_close($conn);

// explode(',', $pizzas[0]['ingredients']);











?>

<!DOCTYPE html>
<html lang="en">

    <?php include('template/header.php'); ?>
    <h4 class="center grey-text"> Pizzas! </h4>

    <div class="container">
        <div class="row">
            <?php foreach($pizzas as $pizza):?>

                <div class="col s6 md3">
                    <div class="card z-depth-0">
                        <img src="img/pizza.svg" class="pizza">
                        <div class="card-contetn center">
                            <h6><?php echo htmlspecialchars($pizza['title']); ?></h6>
                            <ul>
                                <?php foreach(explode(',', $pizzas[0]['ingredients']) as $ing): ?>
                                    <li> <?php echo htmlspecialchars($ing); ?> </li>
                                <?php endforeach; ?>
                            </ul>
                            <ul class="card-action right-align">
                                <a href="details.php?id=<?php echo $pizza['id']?>" class="brand-text">more info</a>
                            </ul>
                        </div>
                    </div>
                </div>
            <?php endforeach; ?>
            <?php if(count($pizzas) >= 2 ): ?>
                    <p>There are 2 or more pizzas. </p>
            <?php else: ?>
                    <p> There are less than 2 pizzas. </p>
            <?php endif; ?>
        </div>
    </div>

<?php include('template/footer.php'); ?>

    

</html>