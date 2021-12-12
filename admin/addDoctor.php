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
    <title>add doctor</title>
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
                    <li class="nav-item">
                        <a class="nav-link" href="changePassword.php">Change Password</a>
                    </li>
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
    <div class="text-center bg-primary text-white">
        <h1>ADD DOCTOR</h1>
    </div>
    <div class="container d-flex justify-content-center align-items-center mt-5">
        <form action="addDoctor.php" method="post" enctype="multipart/form-data" class="row g-3">
            <div class="col-md-6">
                <label for="name" class="form-label">Name</label>
                <input type="text" class="form-control" name="name" id="name">
            </div>
            <div class="col-md-6">
                <label for="email" class="form-label">Email</label>
                <input type="email" class="form-control" name="email" id="email">
            </div>
            <div class="col-md-6">
                <label for="mobile" class="form-label">Phone No</label>
                <input type="text" class="form-control" name="mobile" id="mobile">
            </div>
            <div class="col-md-6">
                <label for="address" class="form-label">Address</label>
                <input type="text" class="form-control" name="address" id="address" placeholder="1234 Main St">
            </div>
            <div class="col-md-6">
                <label for="image" class="form-label">Choose Image</label>
                <input type="file" class="form-control" name="pic" id="image">
            </div>
            <div class="col-md-4">
                <label for="department" class="form-label">Department</label>
                <select id="department" name="department" class="form-select">
                    <option selected>Choose...</option>
                    <option>Medicine</option>
                    <option>Surgery</option>
                </select>
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
    $name = $_POST['name'];
    $email = $_POST['email'];
    $mobile = $_POST['mobile'];
    $address = $_POST['address'];
    $department = $_POST['department'];

    //user_id generator
    $num = rand(10, 100);
    $dr_id = "d-" . $num;

    //image upload code is required
    $ext = explode('.', $_FILES['pic']['name']);
    $c = count($ext);
    $ext = $ext[$c - 1];
    $date = date('D:M:Y');
    $time = date('h:i:s');
    $image_name = md5($date . $time . $dr_id);
    $image = $image_name . "." .$ext;

    $query = "insert into doctor values('$dr_id','$name','$email','$mobile','$address','$department','$image')";
    if (mysqli_query($con, $query)) {
        echo "Successfully inserted";
        if ($image != null) {
            move_uploaded_file($_FILES['pic']['tmp_name'], "../html/uploadimage/$image");
        }
    } else {
        echo "error!" . mysqli_error($con);
    }
}

?>