<?php
require('database/config.php');


session_start();
ob_start();


if (isset($_COOKIE['login_admin']) && !empty($_COOKIE['login_admin'])) {
	header('location: /website/user/profile/admin-dashboard.php');
	exit;
}
if (isset($_COOKIE['login_student']) && !empty($_COOKIE['login_student'])) {
	header('location: /website/user/profile/student-dashboard.php');
	exit;
}


$signin_message = 'Create an account';


if (isset($_POST['login']) && !empty($_POST['email']) && !empty($_POST['password'])) {
	$sql = 'INSERT INTO stds (stds_email, stds_pass) VALUES (?, ?)';

	if ($stmt = $mysqli->prepare($sql)) {
		if (!$stmt) {
			$signin_message = 'Something went wrong creating your account';
		} else {
			$email = $_POST['email'];
			$password = $_POST['password'];

			$query_student = "SELECT * FROM stds WHERE stds_email = '$email'";
			$query_student_result = mysqli_query($mysqli, $query_student);
			if ($query_student_result) {
				if (mysqli_num_rows($query_student_result) > 0) {
					$signin_message = 'That account already exists';
				} else {
					$stmt->bind_param('ss', $email, $password);

					if ($stmt->execute()) {
						header('location: /index.php');
						exit;
					} else {
						$signin_message = 'Something went wrong in creating your account';
					}

					$stmt->close();
					$mysqli->close();
				}
			} else {
				$signin_message = 'Something went wrong in creating your account';
			}
			$query_student_result->free();
		}
	} else {
		$signin_message = 'Something went wrong in creating your account';
	}
}
?>


<!DOCTYPE html>
<html lang="en">

<head>
	<meta charset="UTF-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>Register</title>

	<link rel="shortcut icon" href="/website/include/images/rtu-seal.png" type="image/x-icon">

	<link rel="stylesheet" href="/website/include/css/style.css">
</head>

<body>
	<div class="center full-view-height">
		<div class="rounded padded fit-width equal-container bordered">
			<div class="margin-right padded equal-content">
				<h2>Sign In</h2>
				<p>
					<small>
						<span class="no-wrap">
							Already have an account? <a href="/website/login.php">Login</a> here
						</span>
					</small>
				</p>
				<form action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>" method="post" autocomplete="off">
					<fieldset>
						<legend>
							<span class="no-wrap">
								<?php echo $signin_message; ?>
							</span>
						</legend>
						<div class="margin-top-bottom">
							<input class="full-width" type="email" name="email" placeholder="email" oninput="this.value = this.value.toLowerCase();" pattern="\S+@\S+\.com" required autofocus>
						</div>
						<div class="margin-top-bottom">
							<input class="full-width" type="password" name="password" placeholder="password" minlength="8" required>
						</div>
						<div class="equal-container-spaced">
							<div class="half-width margin-right equal-content-spaced center">
								<button type="submit" name="login" class="blue full-width">Login</button>
							</div>
							<div class="fit-width margin-left equal-content-spaced center">
								<button type="reset" class="red">Reset</button>
							</div>
						</div>
					</fieldset>
				</form>
			</div>
			<div class="margin-left padded equal-content center">
				<a class="center" href="/index.php"><object class="unselectable" data="/website/include/images/rtu-seal.png" alt="RTU Seal Logo" height="200" width="200" loading="lazy"></object></a>
			</div>
		</div>
	</div>
</body>

</html>


<?php
ob_end_flush();
?>
