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


$login_message = 'Login to your account';
$cookie_name = 'remember_login';


if (isset($_POST['login']) && !empty($_POST['email']) && !empty($_POST['password'])) {
	$email = $_POST['email'];
	$password = $_POST['password'];

	$query_admin = "SELECT * FROM ad WHERE ad_email = '$email' AND ad_pass = '$password'";
	$query_admin_result = mysqli_query($mysqli, $query_admin);
	if ($query_admin_result) {
		if (mysqli_num_rows($query_admin_result) > 0) {
			// $_SESSION['valid_admin'] = true;
			// $_SESSION['timeout'] = time();
			// $_SESSION['username'] = $email;
			setcookie('login_admin', true, time() + (86400 * 30), '/');
			setcookie('username', $email, time() + (86400 * 30), '/');

			($_POST['remember_login'] == 'on') ? setcookie($cookie_name, $email, time() + (86400 * 30), '/') : setcookie($cookie_name, '', time() - 3600, '/');

			$query_admin_result->free();

			header('location: /index.php');
			exit;
		}
	}
	$query_admin_result->free();


	$query_student = "SELECT * FROM stds WHERE stds_email = '$email' AND stds_pass = '$password'";
	$query_student_result = mysqli_query($mysqli, $query_student);
	if ($query_student_result) {
		if (mysqli_num_rows($query_student_result) > 0) {
			// $_SESSION['valid_student'] = true;
			// $_SESSION['timeout'] = time();
			// $_SESSION['username'] = $email;
			setcookie('login_student', true, time() + (86400 * 30), '/');
			setcookie('username', $email, time() + (86400 * 30), '/');

			($_POST['remember_login'] == 'on') ? setcookie($cookie_name, $email, time() + (86400 * 30), '/') : setcookie($cookie_name, '', time() - 3600, '/');

			$query_student_result->free();

			header('location: /index.php');
			exit;
		}
	}
	$query_student_result->free();


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
	<div class="center full-view-height">
		<div class="rounded padded fit-width equal-container bordered">
			<div class="margin-right padded equal-content">
				<h2>Login</h2>
				<p>
					<small>
						<span class="no-wrap">
							Don't have an account? <a href="/website/register.php">Sign in</a> here
						</span>
					</small>
				</p>
				<form action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>" method="post" autocomplete="off">
					<fieldset>
						<legend>
							<span class="no-wrap">
								<?php echo $login_message; ?>
							</span>
						</legend>
						<div class="margin-top-bottom">
							<input class="full-width" type="email" name="email" placeholder="email" oninput="this.value = this.value.toLowerCase();" pattern="\S+@\S+" value="<?php echo (isset($_COOKIE[$cookie_name])) ? $_COOKIE[$cookie_name] : ''; ?>" required autofocus>
						</div>
						<div class="margin-top-bottom">
							<input class="full-width" type="password" name="password" placeholder="password" required>
						</div>
						<div class="margin-top-bottom equal-container">
							<div class="margin-right equal-content center">
								<span class="no-wrap center">
									<input type="checkbox" name="remember_login" id="remember_login" checked>
									<label for="remember_login">Remember login</label>
								</span>
							</div>
							<div class="margin-left equal-content center">
								<span class="no-wrap center">
									<a href="/website/user/recover.php">Forgot Password?</a>
								</span>
							</div>
						</div>
						<button class="blue full-width" type="submit" name="login">Login</button>
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
