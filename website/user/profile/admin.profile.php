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


	header('location: /website/user/profile/admin.profile.php');
	exit;
}


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
	<title>Profile</title>

	<link rel="shortcut icon" href="/website/include/images/rtu-seal.png" type="image/x-icon">

	<link rel="stylesheet" href="/website/include/css/style.css">
</head>

<body>
	<div class="fade-in padded-left-right">
		<div class="padded-bottom">
			<div class="padded white rounded-bottom margin-bottom">
				<div class="equal-container">
					<div class="equal-content center">

					</div>

					<div class="equal-content center">
						<a href="/index.php">
							<img src="/website/include/images/rtu-seal.png" alt="RTU Seal Logo" height="60" width="60" loading="lazy">
						</a>
					</div>
					<div class="equal-content center">
						<h2>Profile</h2>
					</div>
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

				<div class="rounded-top padded-top-bottom gray">
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
				<div class="rounded-bottom light-gray padded">
					<form action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>" method="post" enctype="multipart/form-data">
						<fieldset>
							<legend>Admin Information</legend>

							<div class="equal-container">
								<div class="equal-content padded-right">
									<input class="full-width" type="text" name="ad_lname" placeholder="Last Name" oninput="this.value = this.value.toUpperCase();" value="<?php
																																											$retval = $mysqli->query("SELECT ad_lname FROM ad WHERE ad_acc_id = '$ad_acc_id'")->fetch_object()->ad_lname;
																																											echo $retval;
																																											?>"><br>
									<label for="ad_lname">Last Name</label>
								</div>
								<div class="equal-content padded-left-right">
									<input class="full-width" type="text" name="ad_fname" placeholder="First Name" oninput="this.value = this.value.toUpperCase();" value="<?php
																																											$retval = $mysqli->query("SELECT ad_fname FROM ad WHERE ad_acc_id = '$ad_acc_id'")->fetch_object()->ad_fname;
																																											echo $retval;
																																											?>"><br>
									<label for="ad_fname">First Name</label>
								</div>
								<div class="equal-content padded-left-right">
									<input class="full-width" type="text" name="ad_mname" placeholder="Middle Mame" oninput="this.value = this.value.toUpperCase();" value="<?php
																																											$retval = $mysqli->query("SELECT ad_mname FROM ad WHERE ad_acc_id = '$ad_acc_id'")->fetch_object()->ad_mname;
																																											echo $retval;
																																											?>"><br>
									<label for="ad_mname">Middle Name</label>
								</div>
								<div class="equal-content padded-left">
									<input class="full-width" type="text" name="ad_sname" placeholder="Suffix" oninput="this.value = this.value.toUpperCase();" value="<?php
																																										$retval = $mysqli->query("SELECT ad_suffix FROM ad WHERE ad_acc_id = '$ad_acc_id'")->fetch_object()->ad_suffix;
																																										echo $retval;
																																										?>"><br>
									<label for="ad_sname">Suffix (If any)</label>
								</div>
							</div>
						</fieldset>

						<hr>

						<fieldset>
							<legend>Account Information</legend>

							<div class="equal-container">
								<div class="equal-content padded-right">
									<input class="full-width" type="email" name="ad_email" placeholder="Email" oninput="this.value = this.value.toLowerCase();" value="<?php
																																										$retval = $mysqli->query("SELECT ad_email FROM ad WHERE ad_acc_id = '$ad_acc_id'")->fetch_object()->ad_email;
																																										echo $retval;
																																										?>"><br>
									<label for="ad_email">Email Address</label>
								</div>
								<div class="equal-content padded-left">
									<input class="full-width" type="password" name="ad_new_pass" placeholder="New Password"><br>
									<label for="ad_new_pass">New Password</label>
								</div>
							</div>

							<div class="equal-container margin-top">
								<div class="equal-content">
									<input class="full-width" type="file" name="ad_profile_picture" placeholder="Select New Profile Picture" accept="image/*"><br>
									<label for="ad_profile_picture">Select New Profile Picture</label>
								</div>
							</div>
						</fieldset>

						<br>

						<button type="submit" name="save" class="rounded full-width">Save Changes</button>
					</form>
				</div>
			</div>
		</div>
	</div>
</body>

</html>
