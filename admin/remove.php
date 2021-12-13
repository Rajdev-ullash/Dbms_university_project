<?php
include('../html/connection.php');

    $drId = $_GET['id'];
    
    

    $query = "DELETE From DOCTOR where dr_id='$drId'";
    if (mysqli_query($con, $query)) {
        echo "Successfully deleted";
        header('./delete.php');
    } else {
        echo "failed to delete error!" . mysqli_error($con);
    }


?>