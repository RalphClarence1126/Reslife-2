<?php
// Require database config
require('../../database/config.php');


session_start();

// To prevent invalid tampering with an account
if (isset($_SESSION['valid_student']) && !empty($_SESSION['valid_student'])) {
	$get_username_profile = $_SESSION['username'];

	$email_regex = '/(\S+)@\S+/';
	$get_username_profile = preg_replace($email_regex, '$1', $get_username_profile);
} else {

	// Redirect to default page
	header('location: /index.php');
	exit;
}

// Check if user wants to check status
if (!empty($_POST) && isset($_POST['status'])) {

	// Redirect to status
	header('location: /website/user/profile/student.status.php');
	exit;
}
// Check if user wants to check announcements
if (!empty($_POST) && isset($_POST['announcements'])) {

	// Redirect to announcements
	header('location: /website/user/profile/student.announcements.php');
	exit;
}
// Check if user wants to check admission
if (!empty($_POST) && isset($_POST['admission'])) {

	// Redirect to admission
	header('location: /website/user/profile/student.admission.php');
	exit;
}
// Check if user wants to check enrollment
if (!empty($_POST) && isset($_POST['enrollment'])) {

	// Redirect to enrollment
	header('location: /website/user/profile/student.enrollment.php');
	exit;
}
// Check if user wants to check profile
if (!empty($_POST) && isset($_POST['profile'])) {

	// Redirect to profile
	header('location: /website/user/profile/student.profile.php');
	exit;
}


$email = $_SESSION['username'];
$std_acc_id = $mysqli->query("SELECT * FROM stds WHERE stds_email = '$email'")->fetch_object()->stds_acc_id;


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
	<title>Enrollment</title>

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
						<h2>Enrollment</h2>
					</div>
				</div>
			</div>

			<div class="padded white rounded">
				<div class="padded margin-bottom equal-container-spaced">
					<div class="equal-content-spaced">
						<div class="equal-container">
							<div class="equal-content margin-right">
								<div class="full-height center">
									<a href="/website/user/profile/student.php">
										<img class="profile" src="<?php
																	$profile_picture = $mysqli->query("SELECT stds_profile_pic FROM stds WHERE stds_acc_id = '$std_acc_id'")->fetch_object()->stds_profile_pic;
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
										$last_name = $mysqli->query("SELECT stds_lname FROM stds WHERE stds_acc_id = '$std_acc_id'")->fetch_object()->stds_lname;
										$first_name = $mysqli->query("SELECT stds_fname FROM stds WHERE stds_acc_id = '$std_acc_id'")->fetch_object()->stds_fname;

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
								<button type="submit" name="status" class="rounded full-width" tabindex="-1">Status</button>
							</form>
						</div>
						<div class="equal-content padded-left-right">
							<form action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>" method="post">
								<button type="submit" name="announcements" class="rounded full-width" tabindex="-1">Announcements</button>
							</form>
						</div>
						<div class="equal-content padded-left-right">
							<form action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>" method="post">
								<button type="submit" name="admission" class="rounded full-width" tabindex="-1">Admission</button>
							</form>
						</div>
						<div class="equal-content padded-left-right">
							<form action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>" method="post">
								<button type="submit" name="enrollment" class="rounded full-width" tabindex="-1">Enrollment</button>
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
					<?php
					$get_enrollment_form_boolean = $mysqli->query('SELECT g_frm_enrll_bool FROM g_frm_enrll')->fetch_object()->g_frm_enrll_bool;;

					if (!$get_enrollment_form_boolean) {
						include('../notification/form_closed_enrollment.html');
					} else {
						include('../forms/student/enrollment.php');
					}
					?>
				</div>
			</div>
		</div>
	</div>
</body>

</html>
