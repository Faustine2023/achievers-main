<?php

    include "member/dbConn.php";


    $email=$conn->real_escape_string($_POST['email']);
    $name=$conn->real_escape_string($_POST['name']);
    

    $query="INSERT INTO subscribers(name,email)
            VALUES('{$name}','{$email}')";

    $conn->query($query);

    echo "<script>alert('Subcription successfull...');</script>";
    echo "<script type='text/javascript'> document.location = 'index.html'; </script>";


?>