<?php
include "dbConn.php";
session_start();

$currentEmail = $_SESSION['mail'];

// Check if the form is submitted
if (isset($_POST['changeavatar'])) {
    if (!isset($_FILES['image']['tmp_name'])) {
        echo "<script>alert('Sorry, there was an error uploading your file...');</script>";
        echo "<script type='text/javascript'> document.location = 'profile.php'; </script>";
    } else {
        $file = $_FILES['image']['tmp_name'];
        $image = addslashes(file_get_contents($_FILES['image']['tmp_name']));
        $image_name = addslashes($_FILES['image']['name']);

        move_uploaded_file($_FILES["image"]["tmp_name"], "uploads/avatars" . $_FILES["image"]["name"]);

        $location = "uploads/avatars" . $_FILES["image"]["name"];

        // Insert file information into the database
        $query = mysqli_query($conn, "UPDATE `members` set avatar=' $image_name' where  email='$currentEmail' ");

        if ($query) {
            echo "<script>alert('Profile photo updated successfully...');</script>";
            echo "<script type='text/javascript'> document.location = 'profile.php'; </script>";
        } else {
            echo "<script>alert('Sorry, there was an error updating your picture...');</script>";
        }
        exit();
    }

}

?>