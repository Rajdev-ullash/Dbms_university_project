<?php
session_start();
if ($_SESSION['admin_login_status'] != "logged in" and !isset($_SESSION['user_id']))
    header('Location:../html/index.php');

//logout code

if (isset($_GET['sign']) and $_GET['sign'] == "out") {
    $_SESSION['admin_login_status'] = "logged out";
    unset($_SESSION['user_id']);
    header('Location:../html/index.php');
}
?>



<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    <!-- <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.15.4/css/all.css" integrity="sha384-DyZ88mC6Up2uqS4h/KRgHuoeGwBcD4Ng9SiP4dIRy0EXTlnuz47vAwmeGwVChigm" crossorigin="anonymous"> -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="drList.css">
    <title>Admin</title>
</head>

<body>
    <div class="row m-3">
        <div class="text-center bg-dark text-white">
            <h1> USER LIST</h1>
        </div>
        <form action="drList.php" method="post">
            <input type="submit" value="Show All User" name="show">
        </form>

        <div class="container">
            <div class="row text-center people">

                <?php
                include('../html/connection.php');
                if (isset($_POST['show'])) {
                    $sql = "select user_id,name,email,mobile,dob,image from sign";
                    $r = mysqli_query($con, $sql);

                    while ($row = mysqli_fetch_array($r)) {
                        $user_id = $row['user_id'];
                        $name = $row['name'];
                        $email = $row['email'];
                        $mobile = $row['mobile'];
                        $dob = $row['dob'];
                        $image = $row['image'];
                        echo "
                        <div class='col-md-6 col-lg-3 item'>
                    <div class='box'><img class='rounded-circle' src='../html/uploadimage/$image'>
                        <h3 class='name'>$name</h3>
                        <p class='title'>User.ID: $user_id</p>
                        <p class='text-center'>Email: $email</p>
                        <p class='text-center'>Phone: $mobile</p>
                        <p class='text-center'>Date of Birth: $dob</p>
                       
                        <div class='social'><a href='#'><i class='fa fa-facebook-official'></i></a><a href='#'<i class='fa fa-twitter'></i></a><a href='#'><i class='fa fa-instagram'></i></a></div>
                        <div class='d-flex justify-content-center align-items-center mt-3'><a href='remove.php?id=$user_id'><button type='button' class='btn btn-danger'>Remove</button></a></div>
                    </div>
                </div>
                        ";
                    }
                    echo "</table>";
                }
                ?>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>
</body>

</html>
