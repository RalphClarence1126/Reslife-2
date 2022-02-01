<?php
session_start();

// Check if user is already logged in
if (isset($_SESSION['valid']) && !empty($_SESSION['valid'])) {

	// Redirect to profile page
	// header('location: /website/user/profile/student.php');
	header('location: /index.php');
	exit;
}

$login_message = 'Login to your account';
$cookie_name = 'remember_email';

// Check if login email and password is not empty
if (isset($_POST['login']) && !empty($_POST['email']) && !empty($_POST['password'])) {

	// Validate login email and password
	if ($_POST['email'] == 'user@email.com' && $_POST['password'] == 'user') {
		$_SESSION['valid'] = true;
		$_SESSION['timeout'] = time();
		$_SESSION['username'] = 'User';

		// Check if user wants to remember login
		if ($_POST['remember_login'] == 'on') {
			setcookie($cookie_name, $_SESSION['email'], time() + (86400 * 30), '/');
		} else {
			setcookie($cookie_name, '', time() - 3600, '/');
		}

		$login_message = 'Logged in';

		// Redirect to profile page
		// header('location: /website/user/profile/student.php');
		header('location: /index.php');
		exit;
	} else {
		$login_message = 'Wrong email or password';
	}
}
?>


<!DOCTYPE html>
<html lang="en">

<head>
	<meta charset="UTF-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>Login</title>

	<link rel="shortcut icon" href="/website/include/images/rtu-seal.png" type="image/x-icon">

	<link rel="stylesheet" href="/website/include/css/style.css">
</head>

<body>
	<div class="full-height center">
		<div class="equal-container fit-width fade-in">
			<div class="padded white equal-content rounded-left">
				<h1>
					Login
				</h1>

				<form action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>" method="post" autocomplete="off">
					<fieldset class="padded-top-bottom margin-none">
						<legend>
							<span class="no-wrap">
								<?php echo $login_message; ?>
							</span>
						</legend>

						<input class="full-width" type="email" name="email" placeholder="email" oninput="this.value = this.value.toLowerCase();" pattern="\S+@\S+\.com" required autofocus>
						<br>
						<br>
						<input class="full-width" type="password" name="password" placeholder="password" required>

						<div class="equal-container margin-top-bottom">
							<div class="equal-content padded-left-right center">
								<span class="no-wrap center">
									<input class="margin-none" type="checkbox" name="remember_login" id="remember_login">
									<label for="remember_login">
										Remember me
									</label>
								</span>
							</div>
							<div class="equal-content padded-left-right center">
								<a href="/website/user/recover.php">
									<span class="no-wrap">
										Forgot Password?
									</span>
								</a>
							</div>
						</div>

						<button type="submit" name="login" class="rounded full-width">Login</button>
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