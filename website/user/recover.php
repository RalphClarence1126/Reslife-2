<?php
require('../database/config.php');


session_start();
ob_start();


if (isset($_SESSION['valid_admin']) && !empty($_SESSION['valid_admin'])) {
	header('location: /website/user/profile/admin-dashboard.php');
	exit;
}
if (isset($_SESSION['valid_student']) && !empty($_SESSION['valid_student'])) {
	header('location: /website/user/profile/student-dashboard.php');
	exit;
}


$signin_message = 'Please input account email';


if (isset($_POST['login']) && !empty($_POST['email'])) {

	$email = $_POST['email'];

	$query_student = "SELECT * FROM stds WHERE stds_email = '$email'";
	$result_student = mysqli_query($mysqli, $query_student);
	if ($result_student) {
		if (mysqli_num_rows($result_student) > 0) {
			$recovery_msg = "Your account will be recovered shortly.";
			$recovery_msg = wordwrap($recover_msg, 70);
			$headers = 'From: noreply@prototype.com';

			if (mail($email, 'Account Recovery', $recover_msg, $headers)) {
				$signin_message = 'An email to reset account password has been sent to ' . $_POST['email'];
			} else {
				$signin_message = 'There was an error sending email to reset account password to ' . $_POST['email'];
			}
		} else {
			$signin_message = 'Account does not exist';
		}
	} else {
		$signin_message = 'Account does not exist';
	}
	$result_student->free();


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
	<div class="center unselectable" style="height: 100% !important;">
		<div class="padded">
			<div class="equal-container fit-width rounded bordered">
				<div class="padded-left-right equal-content">
					<h2><span class="no-wrap">Forgot Password</span></h2>
					<span class="no-wrap">
						<small>
							<p>Already have an account? <a href="/website/login.php">Login</a> here</p>
						</small>
					</span>
					<span class="no-wrap">
						<small>
							<p>Don't have an account? <a href="/website/register.php">Sign in</a> here</p>
						</small>
					</span>
					<form action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>" method="post" autocomplete="off">
						<fieldset>
							<legend><span class="no-wrap"><?php echo $signin_message; ?></span></legend>
							<div class="margin-top-bottom">
								<input class="full-width" type="email" name="email" placeholder="email" oninput="this.value = this.value.toLowerCase();" pattern="\S+@\S+\.com" required>
							</div>
							<button type="submit" name="login" class="full-width margin-top-bottom">Reset Password</button>
						</fieldset>
					</form>
				</div>
				<div class="padded equal-content">
					<div class="full-height center">
						<a href="/index.php">
							<img src="/website/include/images/rtu-seal.png" alt="RTU Seal Logo" height="150" width="150" loading="lazy">
						</a>
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
