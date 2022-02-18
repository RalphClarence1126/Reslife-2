<?php
require('database/config.php');


session_start();
ob_start();


if (isset($_SESSION['valid_admin']) && !empty($_SESSION['valid_admin'])) {
	header('location: /website/user/profile/admin.dashboard.php');
	exit;
}
if (isset($_SESSION['valid_student']) && !empty($_SESSION['valid_student'])) {
	header('location: /website/user/profile/student.dashboard.php');
	exit;
}


$login_message = 'Login to your account';
$cookie_name = 'remember_email';

// Check if login email and password is not empty
if (isset($_POST['login']) && !empty($_POST['email']) && !empty($_POST['password'])) {

	$email = $_POST['email'];
	$password = $_POST['password'];

	$query_admin = "SELECT * FROM ad WHERE ad_email = '$email' AND ad_pass = '$password'";
	$result_admin = mysqli_query($mysqli, $query_admin);

	if ($result_admin) {
		if (mysqli_num_rows($result_admin) > 0) {
			$_SESSION['valid_admin'] = true;
			$_SESSION['timeout'] = time();
			$_SESSION['username'] = $email;

			if ($_POST['remember_login'] == 'on') {
				setcookie($cookie_name, $email, time() + (86400 * 30), '/');
			} else {
				setcookie($cookie_name, '', time() - 3600, '/');
			}

			header('location: /index.php');
			exit;
		}
	}


	$query_student = "SELECT * FROM stds WHERE stds_email = '$email' AND stds_pass = '$password'";
	$result_student = mysqli_query($mysqli, $query_student);

	if ($result_student) {
		if (mysqli_num_rows($result_student) > 0) {
			$_SESSION['valid_student'] = true;
			$_SESSION['timeout'] = time();
			$_SESSION['username'] = $email;

			if ($_POST['remember_login'] == 'on') {
				setcookie($cookie_name, $email, time() + (86400 * 30), '/');
			} else {
				setcookie($cookie_name, '', time() - 3600, '/');
			}

			header('location: /index.php');
			exit;
		}
	}

	$login_message = 'Invalid email or password';
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
	<div class="full-height center unselectable">
		<div class="equal-container fit-width rounded bordered">
			<div class="padded-left-right equal-content">
				<h2>Login</h2>

				<span class="no-wrap">
					<small>
						<p>Don't have an account? <a href="/website/register.php">Sign in</a> here</p>
					</small>
				</span>

				<form action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>" method="post" autocomplete="off">
					<fieldset>
						<legend><span class="no-wrap"><?php echo $login_message; ?></span></legend>

						<div class="margin-top-bottom">
							<input class="full-width" type="email" name="email" placeholder="email" value="<?php echo (isset($_COOKIE[$cookie_name])) ? $_COOKIE[$cookie_name] : ''; ?>" oninput="this.value = this.value.toLowerCase();" pattern="\S+@\S+" required autofocus>
						</div>
						<div class="margin-top-bottom">
							<input class="full-width" type="password" name="password" placeholder="password" required>
						</div>

						<div class="equal-container margin-top-bottom">
							<div class="equal-content padded-left-right center">
								<span class="no-wrap center">
									<input type="checkbox" name="remember_login" id="remember_login" checked>
									<label for="remember_login">Remember me</label>
								</span>
							</div>
							<div class="equal-content padded-left-right center">
								<a href="/website/user/recover.php"><span class="no-wrap">Forgot Password?</span></a>
							</div>
						</div>

						<button type="submit" name="login" class="full-width margin-top-bottom">Login</button>
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


<?php
ob_end_flush();
?>
