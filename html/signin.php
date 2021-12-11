<?php
	session_start();
?>

<!DOCTYPE html>
<html>

<head>
	<title>SignUp and Login</title>
	<link rel="stylesheet" type="text/css" href="sign.css">
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
</head>

<body>

	<div class="container" id="container">
		<div class="form-container sign-up-container">

			<form action="signin.php" method="post" enctype="multipart/form-data">
				<h1>Create Account</h1>

				<input type="text" name="name" id="name" placeholder="Name">
				<input type="email" name="email" id="email" placeholder="Email">
				<input type="text" name="mobile" id="mobile" placeholder="Phone No">
				<input type="password" name="pass" id="pass" placeholder="Password">
				<input type="date" id="dob" name="dob">
				<input type="file" id="image" name="pic">
				<button type="submit" name="submit" value="Submit">SignUp</button>
			</form>
		</div>
		<div class="form-container sign-in-container">
			<form action="signin.php" method="post" enctype="multipart/form-data">
				<h1>Sign In</h1>
				<input type="text" name="id" id="uid" placeholder="User Id">
				<input type="password" name="pass" id="pass" placeholder="Password">
				<!-- <input type="radio" name="gender" value="male"> Male
    <input type="radio" name="gender" value="female"> Female
	<label for="birthday">Birthday:</label> -->
				<a href="#">Forgot Your Password</a>

				<button type="submit" name="login" value="login">Sign In</button>
			</form>
		</div>
		<div class="overlay-container">
			<div class="overlay">
				<div class="overlay-panel overlay-left">
					<h1>Welcome Back!</h1>
					<p>To keep connected with us please login with your personal info</p>
					<button class="ghost" id="signIn">Sign In</button>
				</div>
				<div class="overlay-panel overlay-right">
					<h1>Hello, Friend!</h1>
					<p>Enter your details and start journey with us</p>
					<button class="ghost" id="signUp">Sign Up</button>
				</div>
			</div>
		</div>
	</div>

	<script type="text/javascript">
		const signUpButton = document.getElementById('signUp');
		const signInButton = document.getElementById('signIn');
		const container = document.getElementById('container');

		signUpButton.addEventListener('click', () => {
			container.classList.add("right-panel-active");
		});
		signInButton.addEventListener('click', () => {
			container.classList.remove("right-panel-active");
		});
	</script>


</body>

</html>

<?php
include('./connection.php');
if (isset($_POST['submit'])) {

	//to recive value from input field
	$name = $_POST['name'];
	$email = $_POST['email'];
	$mobile = $_POST['mobile'];
	$pass = $_POST['pass'];
	$dob = $_POST['dob'];

	//user_id generator
	$num = rand(10, 100);
	$user_id = "u-" . $num;

	//image upload code is required
	$ext = explode('.', $_FILES['pic']['name']);
	$c = count($ext);
	$ext = $ext[$c - 1];
	$date = date('D:M:Y');
	$time = date('h:i:s');
	$image_name = md5($date . $time . $user_id);
	$image = $image_name . "." . $ext;

	$query = "insert into sign values('$user_id','$name','$email','$mobile','$pass','$dob','$image')";
	if (mysqli_query($con, $query)) {
		echo "Successfully inserted";
		if ($image != null) {
			move_uploaded_file($_FILES['pic']['tmp_name'], "uploadimage/$image");
		}
	} else {
		echo "error!" . mysqli_error($con);
	}
}

if (isset($_POST['login'])) {
	$id = $_POST['id'];
	$pass = $_POST['pass'];

	$sql = "select user_id, pass from admin where user_id='$id' and pass='$pass'";
	$sql1 = "select user_id, pass from sign where user_id='$id' and pass='$pass'";

	$r = mysqli_query($con, $sql);
	$r1 = mysqli_query($con, $sql1);

	if (mysqli_num_rows($r) > 0) {
		$_SESSION['user_id'] = $id;
		$_SESSION['admin_login_status'] = "logged in";
		header('Location:../admin/home.php');
	} else if (mysqli_num_rows($r1) > 0) {
		$_SESSION['user_id'] = $id;
		$_SESSION['customer_login_status'] = "logged in";
		header("Location:index.php");
	} else {
		echo "<p style='color: red;'>Incorrect id or password</p>";
	}
}

?>