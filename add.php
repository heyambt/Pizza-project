<?php

include('config/db_connect.php'); 

$title = $email = $ingredients = '';
$error = array('email' => '', 'title' => '', 'ingredients' => '');

if(isset($_POST['submit'])){

// check email is valid
if(empty($_POST['email'])){
    $error['email'] = 'An Email is required <br />';
} else {
    $email = $_POST['email'];
    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $error['email'] = "Please Enter A Valid Email Address";
    }
}

// check title is entered
if(empty($_POST['title'])){
    $error['title'] ='A title is required <br />';
} else {
    $title = $_POST['title'];
			if(!preg_match('/^[a-zA-Z\s]+$/', $title)){
				$error['title'] = 'Title must be letters and spaces only';
			}
}

// check ingredients is entered
if(empty($_POST['ingredients'])){
    $error['ingredients'] = 'A title is required <br />';
} else {
    $ingredients = $_POST['ingredients'];
    if(!preg_match('/^([a-zA-Z\s]+)(,\s*[a-zA-Z\s]*)*$/', $ingredients)){
        $error['ingredients'] = 'Ingredients must be a comma separated list';
    }

    if(array_filter($error)){
         
    }else {
        $email = mysqli_real_escape_string($conn, $_POST['email']);
        $title = mysqli_real_escape_string($conn, $_POST['title']);
        $ingredients = mysqli_real_escape_string($conn, $_POST['ingredients']);

        //creat sql
        $sql = "INSERT INTO pizzas(title, email, ingredients) VALUES('$title', '$email', '$ingredients')";

        if(mysqli_query($conn, $sql)){
            // success
            header('Location: index.php');
        }else{
            //error
            echo 'query error: ' .mysqli_error($conn);
        }
        
    }

}

} 
//End of POST check

?>

<!DOCTYPE html>
<html lang="en">

<?php include('template/header.php'); ?>

<section class="container grey-text">
<h4 class="center">Add a Pizaa</h4>
<form action="add.php" class="white" method="POST">
<label>Your Email</label>
<input type="text" name="email" value="<?php echo htmlspecialchars($email) ?>">
<div class="red-text"><?php echo $error['email']; ?></div>
<label>Pizza Title</label>
<input type="text" name="title" value="<?php echo htmlspecialchars($title) ?>">
<div class="red-text"><?php echo $error['title']; ?></div>
<label>Ingredients (comma separated):</label>
<input type="text" name="ingredients" value="<?php echo htmlspecialchars($ingredients) ?>">
<div class="red-text"><?php echo $error['ingredients']; ?></div>
<div class="center">
    <input type="submit" name="submit" value="submit" class="btn brand z-index-0">
</div>
</form>
</section>

<?php include('template/footer.php'); ?>

    

</html>