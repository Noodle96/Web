<?php

    $conn = new mysqli('localhost','root','password','boilerplate');
    if($conn->connect_error){
        echo $error->$conn->connect_error;
    }

 ?>
