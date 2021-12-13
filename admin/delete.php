<?php
include('../html/connection.php');

    $userId = $_GET['uid'];
    
    

    $query = "DELETE From sign where user_id='$userId'";
    if (mysqli_query($con, $query)) {
        echo "Successfully deleted";
        header('./delete.php');
    } else {
        echo "failed to delete error!" . mysqli_error($con);
    }


?>