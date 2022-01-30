<?php
session_start();

// To prevent invalid tampering with an account
if (isset($_SESSION['valid']) && !empty($_SESSION['valid'])) {
	$get_username_profile = $_SESSION['username'];
} else {

	// Redirect to default page
	header('location: /index.php');
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
				<div class="equal-content center blue rounded">
					<h1>
						<?php echo ucfirst($get_username_profile); ?>
					</h1>
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

		<div class="equal-container-spaced margin-top-bottom">
			<div class="margin-right quarter-width padded-bottom">
				<div class="light-gray padded rounded margin-bottom">
					<h1>
						Student Announcements
					</h1>

					<div class="gold padded rounded-top">
						<br>
					</div>
					<div class="white padded rounded-bottom">
						<br>
					</div>
				</div>

				<div class="light-gray padded rounded">
					<h1>
						University Announcements
					</h1>

					<div class="gold padded rounded-top">
						<br>
					</div>
					<div class="white padded rounded-bottom">
						<br>
					</div>

					<br>

					<div class="gold padded rounded-top">
						<br>
					</div>
					<div class="white padded rounded-bottom">
						<br>
					</div>
				</div>
			</div>

			<div class="margin-left three-quarter-width padded-bottom">
				<div class="white padded rounded margin-bottom">
					<h1>
						Profile Details
					</h1>

					<div class="blue padded rounded-top">
						<h2>
							Student Information
						</h2>
					</div>
					<div class="light-gray padded rounded-bottom">
						<br>
					</div>
				</div>

				<div class="white padded rounded margin-bottom">
					<div class="equal-container">
						<div class="equal-content margin-right">
							<h1>
								Admission
							</h1>
							<div class="blue padded rounded-top">
								<br>
							</div>
							<div class="light-gray padded rounded-bottom">
								<br>
							</div>
						</div>

						<div class="equal-content margin-left">
							<h1>
								Enrollment
							</h1>
							<div class="blue padded rounded-top">
								<br>
							</div>
							<div class="light-gray padded rounded-bottom">
								<br>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
</body>

</html>