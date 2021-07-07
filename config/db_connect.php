<?php
//connect to db
$conn = mysqli_connect('localhost', 'pizza', 'jenell77', 'pizza_project');

//check the connection 
if(!$conn){
    echo 'Connection error: '. mysqli_connect_error();
}