<?php 
    session_start();
    if($_SESSION['admin_login_status'] != "logged in" and ! isset($_SESSION['user_id']))
    header('Location:../html/index.php');

    //logout code

    if(isset($_GET['sign']) and $_GET['sign'] == "out"){
        $_SESSION['admin_login_status'] ="logged out";
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
    <link rel="stylesheet" href="drList.css">
    <title>Document</title>
</head>

<body>
    <nav class="navbar navbar-expand-lg navbar-light shadow-sm">
      <div class="container">
        <a class="navbar-brand" href="#"><span class="text-primary">One</span>-Health</a>

        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupport" aria-controls="navbarSupport" aria-expanded="false" aria-label="Toggle navigation">
          <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse" id="navbarSupport">
          <ul class="navbar-nav ms-auto">
            <li class="nav-item active">
              <a class="nav-link" href="home.php">Home</a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="addDoctor.php">Add Doctors</a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="drList.php">Doctors List</a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="appoinmentlist.php">Apoinment list</a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="changePassword.php">Change Password</a>
            </li>
            <li class="nav-item ">
              <a class="btn btn-primary ml-lg-3" href="?sign=out">Logout</a>
            </li>
          </ul>
        </div> <!-- .navbar-collapse -->
      </div> <!-- .container -->
    </nav>
    <h1 class="text-center">admin page</h1>
    <div class="row m-3">
        <div class="text-center bg-dark text-white">
            <h1> USER LIST</h1>
        </div>
        <form action="home.php" method="post">
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
                        <div class='d-flex justify-content-center align-items-center mt-3'><a href='delete.php?uid=$user_id'><button type='button' class='btn btn-danger'>Remove</button></a></div>
                    </div>
                </div>
                        ";
                    }
                }
                ?>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>

</body>

</html>