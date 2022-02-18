<?php
// Require database config
require('database/config.php');

session_start();

// Check if user is already logged in
if (isset($_SESSION['valid_admin']) && !empty($_SESSION['valid_admin'])) {

	// Redirect to profile page
	header('location: /website/user/profile/admin.php');
	exit;
}

// Check if user is already logged in
if (isset($_SESSION['valid_student']) && !empty($_SESSION['valid_student'])) {

	// Redirect to profile page
	header('location: /website/user/profile/student.php');
	exit;
}

$signin_message = 'Please fill the form below';

// Check if login email and password is not empty
if (isset($_POST['login']) && !empty($_POST['email']) && !empty($_POST['password'])) {

	// Database
	$sql = 'INSERT INTO stds (stds_email, stds_pass) VALUES (?, ?)';

	if ($stmt = $mysqli->prepare($sql)) {
		if (!$stmt) {
			$signin_message = 'Something went wrong creating your account';
		} else {
			$email = $_POST['email'];
			$password = $_POST['password'];

			// Check if account  email already exists in database
			$query = "SELECT * FROM stds WHERE stds_email = '$email'";
			$result = mysqli_query($mysqli, $query);
			if ($result) {
				if (mysqli_num_rows($result) > 0) {

					// Account email already exists
					$signin_message = 'That account already exists';
				} else {

					// Account email does not exists
					$stmt->bind_param('ss', $email, $password);

					if ($stmt->execute()) {

						// Redirect to main page
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
	<div class="full-height center unselectable">
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
</body>

</html>
