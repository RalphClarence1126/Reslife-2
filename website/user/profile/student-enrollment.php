<?php
require('../../database/config.php');


session_start();
ob_start();


if (isset($_SESSION['valid_student']) && !empty($_SESSION['valid_student'])) {
	$get_username_profile = $_SESSION['username'];

	// $email_regex = '/(\S+)@\S+/';
	// $get_username_profile = preg_replace($email_regex, '$1', $get_username_profile);
} else {
	header('location: /index.php');
	exit;
}


if (!empty($_POST) && isset($_POST['dashboard'])) {
	header('location: /website/user/profile/student-dashboard.php');
	exit;
}
if (!empty($_POST) && isset($_POST['admission'])) {
	header('location: /website/user/profile/student-admission.php');
	exit;
}
if (!empty($_POST) && isset($_POST['enrollment'])) {
	header('location: /website/user/profile/student-enrollment.php');
	exit;
}
if (!empty($_POST) && isset($_POST['profile'])) {
	header('location: /website/user/profile/student-profile.php');
	exit;
}


$email = $_SESSION['username'];
$std_acc_id = $mysqli->query("SELECT * FROM stds WHERE stds_email = '$email'")->fetch_object()->stds_acc_id;
$sql = '';


// $sql = "SELECT * FROM ad_stdAnn";
// $get_student_announcement = mysqli_query($mysqli, $sql);
// if ($get_student_announcement) {
// 	if (mysqli_num_rows($get_student_announcement) > 0) {
// 		$_SESSION['has_student_announcement'] = 1;
// 	} else {
// 		$_SESSION['has_student_announcement'] = 0;
// 	}
// }
// $get_student_announcement->free();

// $sql = "SELECT * FROM ad_uniAnn";
// $get_university_announcement = mysqli_query($mysqli, $sql);
// if ($get_university_announcement) {
// 	if (mysqli_num_rows($get_university_announcement) > 0) {
// 		$_SESSION['has_university_announcement'] = 1;
// 	} else {
// 		$_SESSION['has_university_announcement'] = 0;
// 	}
// }
// $get_university_announcement->free();

// if ($_SESSION['has_student_announcement'] || $_SESSION['has_university_announcement']) {
// 	$_SESSION['has_announcements'] = 1;
// } else {
// 	$_SESSION['has_announcements'] = 0;
// }


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
	<title>Enrollment</title>

	<link rel="shortcut icon" href="/website/include/images/rtu-seal.png" type="image/x-icon">

	<link rel="stylesheet" href="/website/include/css/style.css">
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
							<h4>Enrollment</h4>
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
										$last_name = $mysqli->query("SELECT stds_lname FROM stds WHERE stds_acc_id = '$std_acc_id'")->fetch_object()->stds_lname;
										$first_name = $mysqli->query("SELECT stds_fname FROM stds WHERE stds_acc_id = '$std_acc_id'")->fetch_object()->stds_fname;

										$retval = ($last_name && $first_name) ? $last_name . ', ' . $first_name : strtoupper($get_username_profile);

										echo $retval;
										?>
									</span>
								</h6>
								<form action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>" method="post">
									<button type="submit" name="logout" class="red full-width" tabindex="-1">Logout</button>
								</form>
							</div>
						</div>
						<div class="equal-content center margin-left">
							<a class="center" href="/website/user/profile/student-profile.php">
								<img class="profile" src="<?php
															$profile_picture = $mysqli->query("SELECT stds_profile_pic FROM stds WHERE stds_acc_id = '$std_acc_id'")->fetch_object()->stds_profile_pic;
															$get_profile_picture = (file_exists($profile_picture)) ? $profile_picture : $profile_picture = false;

															$retval = ($profile_picture) ? $profile_picture : "/website/include/images/user.png";

															echo $retval;
															?>" alt="User Profile Picture" height="50" width="50" loading="lazy">
							</a>
						</div>
					</div>
				</div>
			</div>
		</div>
		<div class="main-container-remaining">
			<div class="equal-container-spaced full-height">
				<div class="equal-content-spaced margin-right border-bottom" style="min-width: 200px;">
					<div class="padded-top-bottom border-bottom">
						<div class="padded-left-right margin-top-bottom">
							<form action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>" method="post">
								<button type="submit" name="dashboard" class="<?php echo ($_SESSION['has_announcements']) ? 'has-announcement' : 'gray'; ?> full-width" tabindex="-1">Dashboard</button>
							</form>
						</div>
					</div>
					<div class="padded-top-bottom border-bottom">
						<div class="padded-left-right margin-top-bottom">
							<form action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>" method="post">
								<button type="submit" name="admission" class="gray full-width" tabindex="-1">Admission</button>
							</form>
						</div>
						<div class="padded-left-right margin-top-bottom">
							<form action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>" method="post">
								<button type="submit" name="enrollment" class="gray full-width active" tabindex="-1">Enrollment</button>
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
				<div class="equal-content-spaced margin-left-right full-width scrollable" id="mainBody">
					<div class="padded-top-bottom border-bottom unselectable">
						<div class="padded-left-right">
							<h2>Enrollment Form</h2>
						</div>
					</div>
					<div class="padded-top-bottom">
						<div class="padded-left-right">
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
		</div>
	</div>
</body>

<script src="../../include/js/setMainBodyHeight.js"></script>

</html>


<?php
ob_end_flush();
?>
