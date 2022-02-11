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
	<div class="full-height center">
		<div class="equal-container fit-width fade-in">
			<div class="padded white equal-content rounded-left">
				<h1>Sign In</h1>

				<small>
					<p>
						Already have an account? <a href="/website/login.php">Login</a> here
					</p>
				</small>

				<form action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>" method="post" autocomplete="off">
					<fieldset class="padded-top-bottom margin-none">
						<legend>
							<span class="no-wrap">
								<?php echo $signin_message; ?>
							</span>
						</legend>

						<input class="full-width" type="email" name="email" placeholder="email" oninput="this.value = this.value.toLowerCase();" pattern="\S+@\S+\.com" required autofocus>
						<br>
						<br>
						<input class="full-width" type="password" name="password" placeholder="password" minlength="8" required>

						<div class="equal-container-spaced margin-top">
							<div class="equal-content-spaced half-width">
								<div class="center">
									<button type="submit" name="login" class="rounded full-width">Login</button>
								</div>
							</div>
							<div class="equal-content-spaced">
								<div class="center">
									<button type="reset" class="red rounded">Reset</button>
								</div>
							</div>
						</div>

					</fieldset>
				</form>
			</div>
			<div class="padded light-gray equal-content rounded-right">
				<div class="full-height center">
					<a href="/index.php">
						<img src="/website/include/images/rtu-seal.png" alt="RTU Seal Logo" height="200" width="200" loading="lazy">
					</a>
				</div>
			</div>
		</div>
	</div>
</body>

</html>
