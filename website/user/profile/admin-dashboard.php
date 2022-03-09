<?php
require('../../database/config.php');


session_start();
ob_start();


if (isset($_COOKIE['login_admin']) && !empty($_COOKIE['login_admin'])) {
	$get_username_profile = $_COOKIE['username'];
} else {
	header('location: /index.php');
	exit;
}


if (!empty($_POST) && isset($_POST['dashboard'])) {
	header('location: /website/user/profile/admin-dashboard.php');
	exit;
}
if (!empty($_POST) && isset($_POST['announcements'])) {
	header('location: /website/user/profile/admin-announcements.php');
	exit;
}
if (!empty($_POST) && isset($_POST['form-builder'])) {
	header('location: /website/user/profile/admin-form-builder.php');
	exit;
}
if (!empty($_POST) && isset($_POST['profile'])) {
	header('location: /website/user/profile/admin-profile.php');
	exit;
}


$email = $_COOKIE['username'];
$ad_acc_id = $mysqli->query("SELECT * FROM ad WHERE ad_email = '$email'")->fetch_object()->ad_acc_id;


if (!empty($_POST) && isset($_POST['logout'])) {
	$_SESSION = array();
	session_destroy();

	setcookie('login_admin', '', time() - 3600, '/');
	setcookie('username', '', time() - 3600, '/');

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
	<title>Dashboard</title>

	<link rel="shortcut icon" href="/website/include/images/rtu-seal.png" type="image/x-icon">

	<link rel="stylesheet" href="/website/include/css/style.css">
	<link rel="stylesheet" href="/website/include/css/themes/<?php
																$account_theme = $mysqli->query("SELECT ad_account_theme FROM ad WHERE ad_acc_id = '$ad_acc_id'")->fetch_object()->ad_account_theme;

																echo (!$account_theme) ? 'university' : $account_theme;
																?>.css">
</head>

<body id="body">
	<div class="padded equal-container-spaced border-bottom" id="header">
		<div class="equal-content-spaced center">
			<div class="fit-width full-height">
				<a class="center" href="/index.php">
					<object class="unselectable" data="/website/include/images/rtu-logo-labelled.png" alt="RTU Logo" height="50" loading="lazy"></object>
				</a>
			</div>
		</div>
		<div class="equal-content-spaced center" id="user-profile">
			<form class="center full-height" action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>" method="post">
				<button class="center" type="submit" name="profile" tabindex="-1" title="View Profile">
					<div class="fit-width full-height equal-container">
						<div class="margin-right equal-content center">
							<div class="center full-height">
								<span class="no-wrap center">
									<h6>
										<?php
										$last_name = $mysqli->query("SELECT stds_lname FROM stds WHERE stds_acc_id = '$std_acc_id'")->fetch_object()->stds_lname;
										$first_name = $mysqli->query("SELECT stds_fname FROM stds WHERE stds_acc_id = '$std_acc_id'")->fetch_object()->stds_fname;

										echo ($last_name && $first_name) ? $last_name . ', ' . $first_name : strtoupper($get_username_profile);
										?>
									</h6>
								</span>
								<!-- <form action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>" method="post">
								<button class="red full-width" type="submit" name="logout" tabindex="-1">Logout</button>
						</form> -->
							</div>
						</div>
						<div class="equal-content center">
							<a class="center" href="/website/user/profile/admin-profile.php" title="View Profile">
								<object class="profile" data="<?php
																$profile_picture = $mysqli->query("SELECT ad_profile_pic FROM ad WHERE ad_acc_id = '$ad_acc_id'")->fetch_object()->ad_profile_pic;
																$get_profile_picture = (file_exists($profile_picture)) ? $profile_picture : $profile_picture = false;

																echo ($profile_picture) ? $profile_picture : "/website/include/images/user.png";
																?>" alt="User Profile Picture" height="35" width="35" loading="lazy"></object>
							</a>
						</div>
					</div>
				</button>
			</form>
		</div>
	</div>
	<div class="equal-container-spaced">
		<div class="margin-right equal-content-spaced" id="menu" style="min-width: 200px;">
			<div class="padded-top-bottom border-bottom">
				<div class="margin-top-bottom padded-left-right">
					<form action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>" method="post">
						<button class="full-width active" type="submit" name="dashboard" tabindex="-1">Dashboard</button>
					</form>
				</div>
				<div class="margin-top-bottom padded-left-right">
					<form action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>" method="post">
						<button class="full-width" type="submit" name="announcements" tabindex="-1">Announcements</button>
					</form>
				</div>
			</div>
			<!-- <div class="padded-top-bottom">
				<div class="margin-top-bottom padded-left-right">
					<form action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>" method="post">
						<button class="full-width" type="submit" name="form-builder" tabindex="-1">Form Builder</button>
					</form>
				</div>
			</div> -->
			<div class="padded-top-bottom">
				<div class="margin-top-bottom padded-left-right">
					<form action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>" method="post">
						<button class="full-width" type="submit" name="profile" tabindex="-1">Profile</button>
					</form>
				</div>
			</div>
		</div>
		<div class="margin-left equal-content scrollable" id="main">
			<div class="equal-container">
				<div class="margin-right equal-content">
					<div class="padded-top">
						<div class="padded-bottom border-bottom">
							<div class="padded-left-right">
								<h2>Admissions</h2>
							</div>
						</div>
						<div class="padded-top-bottom">
							<div class="margin-top-bottom padded-left-right">
								<?php
								include('admin/control_admissions.php');
								?>
							</div>
							<div class="margin-top-bottom padded-left-right">
								<?php
								include('admin/view_admissions.php');
								?>
							</div>
						</div>
					</div>
				</div>
				<div class="margin-left equal-content">
					<div class="padded-top">
						<div class="padded-bottom border-bottom">
							<div class="padded-left-right">
								<h2>Enrollments</h2>
							</div>
						</div>
						<div class="padded-top-bottom">
							<div class="margin-top-bottom padded-left-right">
								<?php
								include('admin/control_enrollments.php');
								?>
							</div>
							<div class="margin-top-bottom padded-left-right">
								<?php
								include('admin/view_enrollments.php');
								?>
							</div>
						</div>
					</div>
				</div>
			</div>

			<?php
			($_SESSION['show_admissions']) ? include('admin/submission_admissions.php') : '';

			($_SESSION['show_enrollments']) ? include('admin/submission_enrollments.php') : '';
			?>
		</div>
</body>

<script src="../../include/js/setMainBodyHeight.js"></script>
<!-- <script src="../../include/js/setMainBodyWidth.js"></script> -->

</html>


<?php
ob_end_flush();
?>
