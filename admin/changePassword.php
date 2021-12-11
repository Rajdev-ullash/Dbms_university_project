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
    <title>Document</title>
</head>

<body>
    <nav class="navbar navbar-expand-lg navbar-light shadow-sm">
        <div class="container">
            <a class="navbar-brand" href="home.php"><span class="text-primary">One</span>-Health</a>

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
                        <a class="nav-link" href="doctors.html">Apoinment list</a>
                    </li>
                    <!-- <li class="nav-item">
                        <a class="nav-link" href="changePassword.php">Change Password</a>
                    </li> -->
                    <!-- <li class="nav-item">
              <a class="nav-link" href="blog.html">News</a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="contact.html">Contact</a>
            </li>
            <li class="nav-item">
              <a class="btn btn-primary ml-lg-3" href="signin.php">Login / Register</a>
            </li> -->
                    <li class="nav-item ">
                        <a class="btn btn-primary ml-lg-3" href="?sign=out">Logout</a>
                    </li>
                </ul>
            </div> <!-- .navbar-collapse -->
        </div> <!-- .container -->
    </nav>
    <div class="container d-flex justify-content-center align-items-center mt-5">
        <form action="changePassword.php" method="post" enctype="multipart/form-data" class="row g-3">
            <div class="col-md-8">
                <label for="opass" class="form-label">Old Password</label>
                <input type="text" class="form-control" name="opass" id="opass">
            </div>
            <div class="col-md-8">
                <label for="npass" class="form-label">New Password</label>
                <input type="text" class="form-control" name="npass" id="npass">
            </div>
            <div class="col-md-8">
                <label for="cpass" class="form-label">Confirm Password</label>
                <input type="text" class="form-control" name="npass" id="npass">
            </div>
            <div class="col-12">
                <button type="submit" name="submit" id="submit" class="btn btn-primary">Submit</button>
            </div>
        </form>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>
</body>

</html>

<?php
include('../html/connection.php');
if (isset($_POST['submit'])) {

    //to recive value from input field
    $id = $_SESSION['user_id'];
    $opass = $_POST['opass'];
    $npass = $_POST['npass'];
    $cpass = $_POST['cpass'];
    
    if($npass == $cpass){
        $sql = "select pass from admin where pass='$opass' and dr_id='$id'";
        $r = mysqli_query($con, $sql);
        if (mysqli_num_rows($r) > 0) {
            $sql1="update admin set pass='$npass' where dr_id='$id'";
            if(mysqli_query($con, $sql1)){
                echo "passwords updated successfully";
            }
        }
        else{
            echo "old passwords doesn't match";
        }
    }else{
        echo "New passwords doesn't match with Confirm password";
    }

}

?>