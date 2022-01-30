<?php
session_start();

// Check if user is already logged in
if (isset($_SESSION['valid']) && !empty($_SESSION['valid'])) {

	// Redirect to profile page
	// header('location: /website/user/profile/student.php');
	header('location: /index.php');
	exit;
}

$signin_message = 'Please fill the form below';
$cookie_name = 'remember_username';

// Check if login username and password is not empty
if (isset($_POST['login']) && !empty($_POST['username']) && !empty($_POST['password'])) {

	// Validate login username and password
	if ($_POST['username'] == 'user') {
		$signin_message = 'Username already taken';
	} else {
		$_SESSION['valid'] = true;
		$_SESSION['timeout'] = time();
		$_SESSION['username'] = $_POST['username'];

		// Check if user wants to remember login
		if ($_POST['remember_login'] == 'on') {
			setcookie($cookie_name, $_SESSION['username'], time() + (86400 * 30), '/');
		} else {
			setcookie($cookie_name, '', time() - 3600, '/');
		}

		$signin_message = 'Logged in';

		// Redirect to profile page
		// header('location: /website/user/profile/student.php');
		header('location: /index.php');
		exit;
	}
}
?>


<!DOCTYPE html>
<html lang="en">

<head>
	<meta charset="UTF-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>Sign In</title>

	<link rel="shortcut icon" href="/website/include/images/rtu-seal.png" type="image/x-icon">

	<link rel="stylesheet" href="/website/include/css/style.css">
</head>

<body>
	<div class="full-height center">
		<div class="equal-container fit-width fade-in">
			<div class="padded white equal-content rounded-left">
				<h1>
					Sign In
				</h1>
				<small>
					<p>
						Already have an account? <a href="/website/login.php">Login</a> here
					</p>
				</small>
				<form action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>" method="post" autocomplete="off">
					<fieldset class="padded-top-bottom margin-none">
						<legend>
							<span>
								<?php echo $signin_message; ?>
							</span>
						</legend>

						<input class="full-width" type="text" name="username" placeholder="username" value="<?php echo (isset($_COOKIE[$cookie_name])) ? $_COOKIE[$cookie_name] : ''; ?>" pattern="\S+" oninput="this.value = this.value.toLowerCase();" required autofocus>
						<br>
						<br>
						<input class="full-width" type="password" name="password" placeholder="password" pattern="\S{4,}" required>

						<div class="equal-container-spaced margin-top">
							<div class="equal-content-spaced half-width">
								<button type="submit" name="login" class="rounded full-width">
									<span class="no-wrap">
										Sign In
									</span>
								</button>
							</div>
							<div class="equal-content-spaced">
								<button type="reset" class="red rounded full-width">Reset</button>
							</div>
						</div>
					</fieldset>
				</form>
			</div>
			<div class="padded light-gray equal-content rounded-right">
				<div class="full-height center">
					<img src="/website/include/images/rtu-seal.png" alt="RTU Seal Logo" height="200" width="200" loading="lazy">
				</div>
			</div>
		</div>
	</div>
</body>

</html>