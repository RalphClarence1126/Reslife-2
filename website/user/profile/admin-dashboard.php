<?php
require('../../database/config.php');


session_start();
ob_start();


if (isset($_COOKIE['valid_admin']) && !empty($_COOKIE['valid_admin'])) {
	$get_username_profile = $_COOKIE['username'];

	// $email_regex = '/(\S+)@\S+/';
	// $get_username_profile = preg_replace($email_regex, '$1', $get_username_profile);
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


if (!empty($_POST) && isset($_POST['show_admissions'])) {
	$_SESSION['show_admissions'] = 1;
	$_SESSION['show_enrollments'] = 0;

	header('location: /website/user/profile/admin-dashboard.php');
	exit;
}
if (!empty($_POST) && isset($_POST['hide_admissions'])) {
	$_SESSION['show_admissions'] = 0;
	$_SESSION['show_enrollments'] = 0;

	header('location: /website/user/profile/admin-dashboard.php');
	exit;
}

if (!empty($_POST) && isset($_POST['show_enrollments'])) {
	$_SESSION['show_admissions'] = 0;
	$_SESSION['show_enrollments'] = 1;

	header('location: /website/user/profile/admin-dashboard.php');
	exit;
}
if (!empty($_POST) && isset($_POST['hide_enrollments'])) {
	$_SESSION['show_admissions'] = 0;
	$_SESSION['show_enrollments'] = 0;

	header('location: /website/user/profile/admin-dashboard.php');
	exit;
}


$email = $_COOKIE['username'];
$ad_acc_id = $mysqli->query("SELECT * FROM ad WHERE ad_email = '$email'")->fetch_object()->ad_acc_id;


if (!empty($_POST) && isset($_POST['logout'])) {
	$_SESSION = array();
	session_destroy();

	setcookie('valid_admin', '', time() - 3600, '/');
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

	<link rel="stylesheet" href="<?php
									$account_theme = $mysqli->query("SELECT ad_account_theme FROM ad WHERE ad_acc_id = '$ad_acc_id'")->fetch_object()->ad_account_theme;

									if ($account_theme == 'DARK') {
										echo '/website/include/css/style-dark.css';
									} elseif ($account_theme == 'RTU') {
										echo '/website/include/css/style-rtu.css';
									} else {
										echo '/website/include/css/style.css';
									}
									?>">
</head>

<body id="body">
	<div class="main-container">
		<div class="main-container-fixed" id="navBar">
			<div class="equal-container-spaced border-bottom unselectable">
				<div class="equal-content-spaced padded fit-width">
					<div class="equal-container fit-width full-height center">
						<div class="equal-content center margin-right">
							<a class="center" href="/index.php"><img src="/website/include/images/rtu-seal.png" alt="RTU Seal Logo" height="50" width="50" loading="lazy"></a>
						</div>
						<div class="equal-content center margin-left">
							<h4>Dashboard</h4>
						</div>
					</div>
				</div>
				<div class="equal-content-spaced padded fit-width">
					<div class="equal-container fit-width full-height center">
						<div class="equal-content center margin-right">
							<div>
								<h6>
									<span class="no-wrap">
										<?php
										$last_name = $mysqli->query("SELECT ad_lname FROM ad WHERE ad_acc_id = '$ad_acc_id'")->fetch_object()->ad_lname;
										$first_name = $mysqli->query("SELECT ad_fname FROM ad WHERE ad_acc_id = '$ad_acc_id'")->fetch_object()->ad_fname;

										echo ($last_name && $first_name) ? $last_name . ', ' . $first_name : strtoupper($get_username_profile);
										?>
									</span>
								</h6>
								<form action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>" method="post">
									<button type="submit" name="logout" class="red full-width" tabindex="-1">Logout</button>
								</form>
							</div>
						</div>
						<div class="equal-content center margin-left">
							<a class="center" href="/website/user/profile/admin-profile.php">
								<img class="profile" src="<?php
															$profile_picture = $mysqli->query("SELECT ad_profile_pic FROM ad WHERE ad_acc_id = '$ad_acc_id'")->fetch_object()->ad_profile_pic;
															$get_profile_picture = (file_exists($profile_picture)) ? $profile_picture : $profile_picture = false;

															echo ($profile_picture) ? $profile_picture : "/website/include/images/user.png";
															?>" alt="User Profile Picture" height="50" width="50" loading="lazy">
							</a>
						</div>
					</div>
				</div>
			</div>
		</div>
		<div class="main-container-remaining">
			<div class="equal-container-spaced full-height">
				<div class="equal-content-spaced margin-right border-bottom" id="menuBar" style="min-width: 200px;">
					<div class="padded-top-bottom border-bottom">
						<div class="padded-left-right margin-top-bottom">
							<form action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>" method="post">
								<button type="submit" name="dashboard" class="gray full-width active" tabindex="-1">Dashboard</button>
							</form>
						</div>
						<div class="padded-left-right margin-top-bottom">
							<form action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>" method="post">
								<button type="submit" name="announcements" class="gray full-width" tabindex="-1">Announcements</button>
							</form>
						</div>
					</div>
					<div class="padded-top-bottom border-bottom">
						<div class="padded-left-right margin-top-bottom">
							<form action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>" method="post">
								<button type="submit" name="form-builder" class="gray full-width" tabindex="-1">Form Builder</button>
							</form>
						</div>
					</div>
					<div class="padded-top-bottom">
						<div class="padded-left-right margin-top-bottom">
							<form action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>" method="post">
								<button type="submit" name="profile" class="gray full-width" tabindex="-1">Profile</button>
							</form>
						</div>
					</div>
				</div>
				<div class="equal-content-spaced margin-left full-width scrollable" id="mainBody">
					<div class="equal-container">
						<div class="equal-content margin-right">
							<div class="padded-top-bottom border-bottom unselectable">
								<div class="padded-left-right">
									<h2>Admissions</h2>
								</div>
							</div>
							<div class="padded-top-bottom">
								<div class="margin-top-bottom">
									<div class="padded-left-right">
										<?php
										($mysqli->query("SELECT g_frm_admn_bool FROM g_frm_admn WHERE g_frm_admn_id = 1")->fetch_object()->g_frm_admn_bool) ? include('admin/admn_disable.php') : include('admin/admn_enable.php');
										?>
									</div>
								</div>
								<div class="margin-top-bottom">
									<div class="padded-left-right">
										<form action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>" method="post">
											<?php
											if (!$_SESSION['show_admissions']) {
												echo "<button type='submit' name='show_admissions' class='full-width' tabindex='-1'>Show Student Admissions</button>";
											} else {
												echo "<button type='submit' name='hide_admissions' class='red full-width' tabindex='-1'>Hide Student Admissions</button>";
											}
											?>
										</form>
									</div>
								</div>
							</div>
						</div>
						<div class="equal-content margin-left">
							<div class="padded-top-bottom border-bottom unselectable">
								<div class="padded-left-right">
									<h2>Enrollments</h2>
								</div>
							</div>
							<div class="padded-top-bottom">
								<div class="margin-top-bottom">
									<div class="padded-left-right">
										<?php
										($mysqli->query("SELECT g_frm_enrll_bool FROM g_frm_enrll WHERE g_frm_enrll_id = 1")->fetch_object()->g_frm_enrll_bool) ? include('admin/enrll_disable.php') : include('admin/enrll_enable.php');
										?>
									</div>
								</div>
								<div class="margin-top-bottom">
									<div class="padded-left-right">
										<form action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>" method="post">
											<?php
											if (!$_SESSION['show_enrollments']) {
												echo "<button type='submit' name='show_enrollments' class='full-width' tabindex='-1'>Show Student Enrollments</button>";
											} else {
												echo "<button type='submit' name='hide_enrollments' class='red full-width' tabindex='-1'>Hide Student Enrollments</button>";
											}
											?>
										</form>
									</div>
								</div>
							</div>
						</div>
					</div>
					<?php
					($_SESSION['show_admissions']) ? include('admin/admn_submissions.php')  : '';

					($_SESSION['show_enrollments']) ? include('admin/enrll_submissions.php') : '';
					?>
				</div>
			</div>
		</div>
	</div>
</body>

<script src="../../include/js/setMainBodyHeight.js"></script>

</html>


<?php
ob_end_flush();
?>
