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


$email = $_COOKIE['username'];
$ad_acc_id = $mysqli->query("SELECT * FROM ad WHERE ad_email = '$email'")->fetch_object()->ad_acc_id;
$sql = '';


if (isset($_POST['save'])) {
	if ($_POST['ad_lname']) {
		$ad_last_name = $_POST['ad_lname'];
		$mysqli->query("UPDATE ad SET ad_lname = '$ad_last_name' WHERE ad_acc_id = '$ad_acc_id'");
	}
	if ($_POST['ad_fname']) {
		$ad_first_name = $_POST['ad_fname'];
		$mysqli->query("UPDATE ad SET ad_fname = '$ad_first_name' WHERE ad_acc_id = '$ad_acc_id'");
	}
	if ($_POST['ad_mname']) {
		$ad_middle_name = $_POST['ad_mname'];
		$mysqli->query("UPDATE ad SET ad_mname = '$ad_middle_name' WHERE ad_acc_id = '$ad_acc_id'");
	}
	// if ($_POST['ad_suffix']) {
	$ad_suffix = $_POST['ad_suffix'];
	$mysqli->query("UPDATE ad SET ad_suffix = '$ad_suffix' WHERE ad_acc_id = '$ad_acc_id'");
	// }


	if ($_POST['ad_email']) {
		$ad_email = $mysqli->query("SELECT ad_email FROM ad WHERE ad_acc_id = '$ad_acc_id'")->fetch_object()->ad_email;

		if ($_POST['ad_email'] != $ad_email) {
			$ad_email = $_POST['ad_email'];
			$mysqli->query("UPDATE ad SET ad_email = '$ad_email' WHERE ad_acc_id = '$ad_acc_id'");

			$_SESSION = array();
			session_destroy();

			header('location: /index.php');
			exit;
		}
	}
	if ($_POST['ad_new_pass']) {
		$ad_new_pass = $mysqli->query("SELECT ad_pass FROM ad WHERE ad_acc_id = '$ad_acc_id'")->fetch_object()->ad_pass;

		if ($_POST['ad_new_pass'] != $ad_new_pass) {
			$ad_new_pass = $_POST['ad_new_pass'];
			$mysqli->query("UPDATE ad SET ad_pass = '$ad_new_pass' WHERE ad_acc_id = '$ad_acc_id'");

			$_SESSION = array();
			session_destroy();

			header('location: /index.php');
			exit;
		}
	}


	$target_dir = "uploads/admin/profile/";

	if (is_dir($target_dir . $email)) {
		$target_dir = "uploads/admin/profile/" . $email . "/";
	} else {
		mkdir("uploads/admin/profile/" . $email);
		$target_dir = "uploads/admin/profile/" . $email . "/";
	}

	$target_file = $target_dir . basename($_FILES["ad_profile_picture"]["name"]);
	$uploadOk = 1;
	$imageFileType = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));

	if ($check !== false) {
		$uploadOk = 1;
	} else {
		$uploadOk = 0;
	}

	if (file_exists($target_file)) {
		$uploadOk = 0;
	}

	if ($uploadOk == 1) {
		if (move_uploaded_file($_FILES["ad_profile_picture"]["tmp_name"], $target_file)) {
			$mysqli->query("UPDATE ad SET ad_profile_pic = '$target_file' WHERE ad_acc_id = '$ad_acc_id'");
		}
	} else {
		if ($target_file != $target_dir) {
			$mysqli->query("UPDATE ad SET ad_profile_pic = '$target_file' WHERE ad_acc_id = '$ad_acc_id'");
		}
	}


	header('location: /website/user/profile/admin-profile.php');
	exit;
}


if (!empty($_POST) && isset($_POST['light_theme'])) {
	$mysqli->query("UPDATE ad SET ad_account_theme = NULL WHERE ad_acc_id = '$ad_acc_id'");

	header('location: /website/user/profile/admin-profile.php');
	exit;
}
if (!empty($_POST) && isset($_POST['dark_theme'])) {
	$mysqli->query("UPDATE ad SET ad_account_theme = 'DARK' WHERE ad_acc_id = '$ad_acc_id'");

	header('location: /website/user/profile/admin-profile.php');
	exit;
}
if (!empty($_POST) && isset($_POST['rtu_theme'])) {
	$mysqli->query("UPDATE ad SET ad_account_theme = 'RTU' WHERE ad_acc_id = '$ad_acc_id'");

	header('location: /website/user/profile/admin-profile.php');
	exit;
}


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
	<title>Profile</title>

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
							<h4>Profile</h4>
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
								<button type="submit" name="dashboard" class="gray full-width" tabindex="-1">Dashboard</button>
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
								<button type="submit" name="profile" class="gray full-width active" tabindex="-1">Profile</button>
							</form>
						</div>
					</div>
				</div>
				<div class="equal-content-spaced margin-left full-width scrollable" id="mainBody">
					<div class="padded-top-bottom border-bottom unselectable">
						<div class="padded-left-right">
							<h2>Admin Information</h2>
						</div>
					</div>
					<div class="padded-top-bottom">
						<div class="padded-left-right">
							<form action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>" method="post" enctype="multipart/form-data">
								<div class="margin-top-bottom">
									<fieldset>
										<legend>Personal Information</legend>
										<div class="equal-container">
											<div class="equal-content padded-right">
												<input class="full-width" type="text" name="ad_lname" placeholder="Last Name" oninput="this.value = this.value.toUpperCase();" value="<?php echo $mysqli->query("SELECT ad_lname FROM ad WHERE ad_acc_id = '$ad_acc_id'")->fetch_object()->ad_lname; ?>"><br>
												<label for="ad_lname">Last Name</label>
											</div>
											<div class="equal-content padded-left-right">
												<input class="full-width" type="text" name="ad_fname" placeholder="First Name" oninput="this.value = this.value.toUpperCase();" value="<?php echo $mysqli->query("SELECT ad_fname FROM ad WHERE ad_acc_id = '$ad_acc_id'")->fetch_object()->ad_fname; ?>"><br>
												<label for="ad_fname">First Name</label>
											</div>
											<div class="equal-content padded-left-right">
												<input class="full-width" type="text" name="ad_mname" placeholder="Middle Mame" oninput="this.value = this.value.toUpperCase();" value="<?php echo $mysqli->query("SELECT ad_mname FROM ad WHERE ad_acc_id = '$ad_acc_id'")->fetch_object()->ad_mname; ?>"><br>
												<label for="ad_mname">Middle Name</label>
											</div>
											<div class="equal-content padded-left">
												<input class="full-width" type="text" name="ad_sname" placeholder="Suffix" oninput="this.value = this.value.toUpperCase();" value="<?php echo $mysqli->query("SELECT ad_suffix FROM ad WHERE ad_acc_id = '$ad_acc_id'")->fetch_object()->ad_suffix; ?>"><br>
												<label for="ad_sname">Suffix (If any)</label>
											</div>
										</div>
									</fieldset>
								</div>
								<br>
								<div class="margin-top-bottom">
									<fieldset>
										<legend>Account Information</legend>
										<div class="equal-container">
											<div class="equal-content padded-right">
												<input class="full-width" type="email" name="ad_email" placeholder="Email" oninput="this.value = this.value.toLowerCase();" value="<?php echo $mysqli->query("SELECT ad_email FROM ad WHERE ad_acc_id = '$ad_acc_id'")->fetch_object()->ad_email; ?>"><br>
												<label for="ad_email">Email Address</label>
											</div>
											<div class="equal-content padded-left">
												<input class="full-width" type="password" name="ad_new_pass" placeholder="New Password"><br>
												<label for="ad_new_pass">New Password</label>
											</div>
										</div>
										<div class="equal-container-spaced margin-top">
											<div class="equal-content-spaced fit-width padded-right">
												<div class="full-width center">
													<img src="<?php
																$profile_picture = $mysqli->query("SELECT ad_profile_pic FROM ad WHERE ad_acc_id = '$ad_acc_id'")->fetch_object()->ad_profile_pic;
																$get_profile_picture = (file_exists($profile_picture)) ? $profile_picture : $profile_picture = false;

																echo ($profile_picture) ? $profile_picture : "/website/include/images/user.png";
																?>" alt="User Profile Picture" height="250" width="250" loading="lazy">
												</div>
											</div>
											<div class="equal-content-spaced full-width padded-left">
												<div class="margin-bottom">
													<input class="full-width" type="file" name="ad_profile_picture" placeholder="Select New Profile Picture" accept="image/*"><br>
													<label for="ad_profile_picture">Upload New Profile Picture</label>
												</div>
												<div class="margin-top full-width">
													<div class="equal-container full-width">
														<div class="equal-content padded-right">
															<button type="submit" name="light_theme" class="full-width margin-top-bottom">Light Theme</button>
														</div>
														<div class="equal-content padded-left-right">
															<button type="submit" name="dark_theme" class="full-width margin-top-bottom">Dark Theme</button>
														</div>
														<div class="equal-content padded-left">
															<button type="submit" name="rtu_theme" class="full-width margin-top-bottom">University Theme</button>
														</div>
													</div>
												</div>
											</div>
										</div>
									</fieldset>
								</div>
								<button type="submit" name="save" class="full-width margin-top-bottom">Save Changes</button>
							</form>
						</div>
					</div>
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
