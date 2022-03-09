<?php
require('../database/config.php');


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


$recover_message = 'Please input account email';


if (isset($_POST['login']) && !empty($_POST['email'])) {
	$email = $_POST['email'];

	$query_student = "SELECT * FROM stds WHERE stds_email = '$email'";
	$query_student_result = mysqli_query($mysqli, $query_student);
	if ($query_student_result) {
		if (mysqli_num_rows($query_student_result) > 0) {
			$recover_message = "Your account will be recovered shortly.";
			$recover_message = wordwrap($recover_msg, 70);
			$headers = 'From: noreply@prototype.com';

			if (mail($email, 'Account Recovery', $recover_msg, $headers)) {
				$recover_message = 'An email to reset account password has been sent to ' . $_POST['email'];
			} else {
				$recover_message = 'There was an error sending email to reset account password to ' . $_POST['email'];
			}
		} else {
			$recover_message = 'Account does not exist';
		}
	} else {
		$recover_message = 'Account does not exist';
	}
	$query_student_result->free();


	header('refresh: 2; url = /website/user/recover.php');
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
	<div class="center full-view-height">
		<div class="rounded padded fit-width equal-container bordered">
			<div class="margin-right padded equal-content">
				<h2>
					<span class="no-wrap">
						Forgot Password
					</span>
				</h2>
				<p>
					<small>
						<span class="no-wrap">
							Already have an account? <a href="/website/login.php">Login</a> here
						</span>
					</small>
				</p>
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
								<?php echo $recover_message; ?>
							</span>
						</legend>
						<div class="margin-top-bottom">
							<input class="full-width" type="email" name="email" placeholder="email" oninput="this.value = this.value.toLowerCase();" pattern="\S+@\S+\.com" required>
						</div>
						<button type="submit" name="login" class="red full-width">Reset Password</button>
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
