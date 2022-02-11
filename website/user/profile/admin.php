<?php
session_start();

// To prevent invalid tampering with an account
if (isset($_SESSION['valid_admin']) && !empty($_SESSION['valid_admin'])) {
	$get_username_profile = $_SESSION['username'];

	$email_regex = '/(\S+)@\S+/';
	$get_username_profile = preg_replace($email_regex, '$1', $get_username_profile);
} else {

	// Redirect to default page
	header('location: /index.php');
	exit;
}

// Check if user wants to check profile
if (!empty($_POST) && isset($_POST['profile'])) {

	// Redirect to profile
	header('location: /website/user/profile/student.php');
	exit;
}

// Check if user wants to logout of the account
if (!empty($_POST) && isset($_POST['logout'])) {

	// Redirect to logout
	// header('location: /website/user/logout.php');
	// exit;

	// Unset session variables
	$_SESSION = array();

	session_destroy();

	// Redirect to main page
	header('location: /index.php');
	exit;
}
?>


<!DOCTYPE html>
<html lang="en">

<head>
	<meta charset="UTF-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>Profile | <?php echo ucfirst($get_username_profile); ?></title>

	<link rel="shortcut icon" href="/website/include/images/rtu-seal.png" type="image/x-icon">

	<link rel="stylesheet" href="/website/include/css/style.css">
</head>

<body>
	<div class="fade-in padded-left-right">
		<div class="padded white rounded-bottom">
			<div class="equal-container-spaced">
				<div class="equal-content center">
					<form action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>" method="post" enctype="multipart/form-data" autocomplete="off">
						<button type="submit" name="profile" class="rounded">
							<?php echo ucfirst($get_username_profile); ?>
						</button>
					</form>
				</div>

				<div class="equal-content center">
					<a href="/index.php">
						<img src="/website/include/images/rtu-seal.png" alt="RTU Seal Logo" height="60" width="60" loading="lazy">
					</a>
				</div>

				<div class="equal-content center">
					<form action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>" method="post">
						<button type="submit" name="logout" class="red rounded" tabindex="-1">Logout</button>
					</form>
				</div>
			</div>
		</div>
	</div>
</body>

</html>
