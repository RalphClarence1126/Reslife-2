<?php
require('../../database/config.php');


session_start();


if (isset($_SESSION['valid_admin']) && !empty($_SESSION['valid_admin'])) {
	$get_username_profile = $_SESSION['username'];

	$email_regex = '/(\S+)@\S+/';
	$get_username_profile = preg_replace($email_regex, '$1', $get_username_profile);
} else {
	header('location: /index.php');
	exit;
}


if (!empty($_POST) && isset($_POST['dashboard'])) {
	header('location: /website/user/profile/admin.dashboard.php');
	exit;
}
if (!empty($_POST) && isset($_POST['announcements'])) {
	header('location: /website/user/profile/admin.announcements.php');
	exit;
}
if (!empty($_POST) && isset($_POST['profile'])) {
	header('location: /website/user/profile/admin.profile.php');
	exit;
}


$email = $_SESSION['username'];
$ad_acc_id = $mysqli->query("SELECT * FROM ad WHERE ad_email = '$email'")->fetch_object()->ad_acc_id;


if (!empty($_POST) && isset($_POST['logout'])) {
	$_SESSION = array();
	session_destroy();

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
	<title>Portal</title>

	<link rel="shortcut icon" href="/website/include/images/rtu-seal.png" type="image/x-icon">

	<link rel="stylesheet" href="/website/include/css/style.css">
</head>

<body>
	<div class="fade-in padded-left-right">
		<div class="padded-bottom">
			<div class="padded white rounded-bottom margin-bottom">
				<div class="equal-content center">

				</div>

				<div class="equal-content center">
					<a href="/index.php">
						<img src="/website/include/images/rtu-seal.png" alt="RTU Seal Logo" height="60" width="60" loading="lazy">
					</a>
				</div>
				<div class="equal-content center">

				</div>
			</div>

			<div class="padded white rounded">
				<div class="padded margin-bottom equal-container-spaced">
					<div class="equal-content-spaced">
						<div class="equal-container">
							<div class="equal-content margin-right">
								<div class="full-height center">
									<a href="/website/user/profile/admin.php">
										<img class="profile" src="<?php
																	$profile_picture = $mysqli->query("SELECT ad_profile_pic FROM ad WHERE ad_acc_id = '$ad_acc_id'")->fetch_object()->ad_profile_pic;
																	$get_profile_picture = (file_exists($profile_picture)) ? $profile_picture : $profile_picture = false;

																	$retval = ($profile_picture) ? $profile_picture : "/website/include/images/user.png";

																	echo $retval;
																	?>" alt="User Profile Picture" height="80" width="80" loading="lazy">
									</a>
								</div>
							</div>
							<div class="equal-content-spaced margin-left">
								<div class="full-height center">
									<h1>
										<?php
										$last_name = $mysqli->query("SELECT ad_lname FROM ad WHERE ad_acc_id = '$ad_acc_id'")->fetch_object()->ad_lname;
										$first_name = $mysqli->query("SELECT ad_fname FROM ad WHERE ad_acc_id = '$ad_acc_id'")->fetch_object()->ad_fname;

										$retval = ($last_name && $first_name) ? $last_name . ', ' . $first_name : ucwords($get_username_profile);

										echo $retval;
										?>
									</h1>
								</div>
							</div>
						</div>

					</div>

					<div class="equal-content-spaced">
						<div class="full-height center">
							<form action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>" method="post">
								<button type="submit" name="logout" class="red rounded" tabindex="-1">Logout</button>
							</form>
						</div>
					</div>
				</div>

				<div class="rounded padded-top-bottom gray">
					<div class="equal-container-spaced">
						<div class="equal-content padded-left-right">
							<form action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>" method="post">
								<button type="submit" name="dashboard" class="rounded full-width" tabindex="-1">Dashboard</button>
							</form>
						</div>
						<div class="equal-content padded-left-right">
							<form action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>" method="post">
								<button type="submit" name="announcements" class="rounded full-width" tabindex="-1">Announcements</button>
							</form>
						</div>
						<div class="equal-content padded-left-right">
							<form action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>" method="post">
								<button type="submit" name="profile" class="rounded full-width" tabindex="-1">Profile</button>
							</form>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
</body>

</html>
