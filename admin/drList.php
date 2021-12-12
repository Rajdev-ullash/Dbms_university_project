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
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.15.4/css/all.css" integrity="sha384-DyZ88mC6Up2uqS4h/KRgHuoeGwBcD4Ng9SiP4dIRy0EXTlnuz47vAwmeGwVChigm" crossorigin="anonymous">
    <link rel="stylesheet" href="drList.css">
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
                    <li class="nav-item ">
                        <a class="btn btn-primary ml-lg-3" href="?sign=out">Logout</a>
                    </li>
                </ul>
            </div> <!-- .navbar-collapse -->
        </div> <!-- .container -->
    </nav>
    <div class="row m-3">
        <div class="text-center bg-primary text-white">
            <h1> DOCTOR LIST</h1>
        </div>
        <form action="drList.php" method="post">
            <input type="submit" value="Show All Doctor" name="show">
        </form>

        <div class="container">
            <div class="row text-center">

                <?php
                include('../html/connection.php');
                if (isset($_POST['show'])) {
                    $sql = "select dr_id,name,email,mobile,address,department,image from doctor";
                    $r = mysqli_query($con, $sql);
                    echo "<table id='doctor' class='table table-dark'>";
                    echo "<tr>
                                <th scope='col'>Doctor ID</th>
                                <th scope='col'>Doctor Name</th>
                                <th scope='col'>Doctor Email</th>
                                <th scope='col'>Doctor mobile</th>
                                <th scope='col'>Doctor Address</th>
                                <th scope='col'>Doctor Department</th>
                                <th scope='col'>Doctor Image</th>
                            </tr>
                       ";
                    while ($row = mysqli_fetch_array($r)) {
                        $dr_id = $row['dr_id'];
                        $name = $row['name'];
                        $email = $row['email'];
                        $mobile = $row['mobile'];
                        $address = $row['address'];
                        $department = $row['department'];
                        $image = $row['image'];


                        echo "<tbody><tr>
                                <td>$dr_id</td><td>$name</td><td>$email</td><td>$mobile</td><td>$address</td><td>$department</td><td><img src='../html/uploadimage/'.$image.'.jpg' height='50px' width='50px' alt=$image></td>

                             </tr><?tbody>";
                    }
                    echo "</table>";


                }
            ?>
            </div>
        </div>
    </div>
    <!-- <div class="d-flex justify-content-end align-items-end mt-5 me-3">
        <button class="btn btn-primary">ALL DOCTOR LIST</button>
    </div> -->
    <hr />
    <div class="text-center bg-primary text-white">
        <h1>Update Doctor Info</h1>
    </div>
    <div class="container d-flex justify-content-center align-items-center mt-5">
        <form action="drList.php" method="post" enctype="multipart/form-data" class="row g-3">
            <div class="col-md-12">
                <label for="drId" class="form-label">Dr. ID</label>
                <select id="drId" name="drId" class="form-select">
                    <?php
                    include('../html/connection.php');
                    $sql = "select dr_id from doctor";
                    $r = mysqli_query($con, $sql);

                    while ($row = mysqli_fetch_array($r)) {
                        $dr_id = $row['dr_id'];
                        echo "<option value='$dr_id'>$dr_id</option>";
                    }

                    ?>
                </select>
            </div>
            <div class="col-md-12">
                <label for="department" class="form-label">Update Department</label>
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
    $drId = $_POST['drId'];
    $department = $_POST['department'];

    $query = "update doctor set department='$department' where dr_id='$drId'";
    if (mysqli_query($con, $query)) {
        echo "Successfully inserted";
    } else {
        echo "error!" . mysqli_error($con);
    }
}

?>