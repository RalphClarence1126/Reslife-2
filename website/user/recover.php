<?php
session_start();

// Check if user is already logged in
if (isset($_SESSION['valid']) && !empty($_SESSION['valid'])) {

	// Redirect to profile page
	// header('location: /website/user/profile/student.php');
	header('location: /index.php');
	exit;
}

$signin_message = 'Please input account email';

// Check if email is not empty
if (isset($_POST['login']) && !empty($_POST['email'])) {

	// Validate email
	if ($_POST['email'] == 'user@email.com') {
		$signin_message = 'An email to reset account password has been sent to ' . $_POST['email'];
	} else {
		$signin_message = 'User does not exist';
	}
}
?>


<!DOCTYPE html>
<html lang="en">

<head>
	<meta charset="UTF-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>Forgot Password</title>

	<link rel="shortcut icon" href="/website/include/images/rtu-seal.png" type="image/x-icon">

	<link rel="stylesheet" href="/website/include/css/style.css">
</head>

<body>
	<div class="full-height center">
		<div class="equal-container fit-width fade-in">
			<div class="padded white equal-content rounded-left">
				<h1>
					<span class="no-wrap">Forgot Password</span>
				</h1>

				<small>
					<p>
						Already have an account? <a href="/website/login.php">Login</a> here
					</p>
				</small>

				<small>
					<p>
						Don't have an account? <a href="/website/register.php">Sign in</a> here
					</p>
				</small>

				<form action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>" method="post" autocomplete="off">
					<fieldset class="padded-top-bottom margin-none">
						<legend>
							<?php echo $signin_message; ?>
						</legend>

						<input class="full-width" type="email" name="email" placeholder="email" oninput="this.value = this.value.toLowerCase();" pattern="\S+@\S+\.com" required>

						<button type="submit" name="login" class="rounded full-width margin-top">Reset Password</button>
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