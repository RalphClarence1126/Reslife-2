<?php
require('database/config.php');


session_start();
ob_start();


if (isset($_COOKIE['valid_admin']) && !empty($_COOKIE['valid_admin'])) {
	header('location: /website/user/profile/admin-dashboard.php');
	exit;
}
if (isset($_COOKIE['valid_student']) && !empty($_COOKIE['valid_student'])) {
	header('location: /website/user/profile/student-dashboard.php');
	exit;
}


$signin_message = 'Please fill the form below';


if (isset($_POST['login']) && !empty($_POST['email']) && !empty($_POST['password'])) {

	$sql = 'INSERT INTO stds (stds_email, stds_pass) VALUES (?, ?)';

	if ($stmt = $mysqli->prepare($sql)) {
		if (!$stmt) {
			$signin_message = 'Something went wrong creating your account';
		} else {
			$email = $_POST['email'];
			$password = $_POST['password'];

			$query = "SELECT * FROM stds WHERE stds_email = '$email'";
			$result_student = mysqli_query($mysqli, $query);
			if ($result_student) {
				if (mysqli_num_rows($result_student) > 0) {
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
			$result_student->free();
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

<body style="display: table; margin-left: auto; margin-right: auto;">
	<div class="center unselectable" style="height: 100% !important;">
		<div class="padded">
			<div class="equal-container fit-width rounded bordered">
				<div class="padded-left-right equal-content">
					<h2>Sign In</h2>
					<span class="no-wrap">
						<small>
							<p>Already have an account? <a href="/website/login.php">Login</a> here</p>
						</small>
					</span>
					<form action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>" method="post" autocomplete="off">
						<fieldset>
							<legend><span class="no-wrap"><?php echo $signin_message; ?></span></legend>
							<div class="margin-top-bottom">
								<input class="full-width" type="email" name="email" placeholder="email" oninput="this.value = this.value.toLowerCase();" pattern="\S+@\S+\.com" required autofocus>
							</div>
							<div class="margin-top-bottom">
								<input class="full-width" type="password" name="password" placeholder="password" minlength="8" required>
							</div>
							<div class="equal-container-spaced margin-top">
								<div class="equal-content-spaced half-width">
									<div class="center">
										<button type="submit" name="login" class="full-width margin-top-bottom">Login</button>
									</div>
								</div>
								<div class="equal-content-spaced">
									<div class="center">
										<button type="reset" class="red margin-top-bottom">Reset</button>
									</div>
								</div>
							</div>
						</fieldset>
					</form>
				</div>
				<div class="padded equal-content">
					<div class="full-height center">
						<a class="center" href="/index.php"><img src="/website/include/images/rtu-seal.png" alt="RTU Seal Logo" height="150" width="150" loading="lazy"></a>
					</div>
				</div>
			</div>
		</div>
	</div>
</body>

</html>


<?php
ob_end_flush();
?>
