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
    <div class="row m-3">
        <div class="text-center bg-primary text-white">
            <h1> Appoinment LIST</h1>
        </div>
        <br />
        <form action="appoinmentlist.php" method="post" enctype="multipart/form-data">
            <input type="submit" value="Show All Appoinment" name="show">
        </form>
        <?php
        include('../html/connection.php');
        if (isset($_POST['show'])) {

            $sql = "select ap_id,name,email,dob,department,drName,mobile from appoinments";
            $r = mysqli_query($con, $sql);
            echo "<table id='info' class='table table-dark'>";
            echo "<tr>
                        <th scope='col'>Appoinment ID</th>
                        <th scope='col'>Name</th>
                        <th scope='col'>Email</th>
                        <th scope='col'>Birth date</th>
                        <th scope='col'>Department</th>
                        <th scope='col'>Dr. Name</th>
                        <th scope='col'>Mobile</th>
                    </tr>
               ";
            while ($row = mysqli_fetch_array($r)) {
                $ap_id = $row['ap_id'];
                $name = $row['name'];
                $email = $row['email'];
                $dob = $row['dob'];
                $department = $row['department'];
                $drName = $row['drName'];
                $mobile = $row['mobile'];

                echo "<tbody><tr>
                        <td>$ap_id</td><td>$name</td><td>$email</td><td>$dob</td><td>$department</td><td>$drName</td><td>$mobile</td>
                     </tr></tbody>";
            }
            echo "</table>";
        }
        ?>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>
</body>

</html>