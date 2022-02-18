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
	header('location: /website/user/profile/student.dashboard.php');
	exit;
}
if (!empty($_POST) && isset($_POST['announcements'])) {
	header('location: /website/user/profile/student.announcements.php');
	exit;
}
if (!empty($_POST) && isset($_POST['admission'])) {
	header('location: /website/user/profile/student.admission.php');
	exit;
}
if (!empty($_POST) && isset($_POST['enrollment'])) {
	header('location: /website/user/profile/student.enrollment.php');
	exit;
}
if (!empty($_POST) && isset($_POST['profile'])) {
	header('location: /website/user/profile/student.profile.php');
	exit;
}


$email = $_SESSION['username'];
$std_acc_id = $mysqli->query("SELECT * FROM stds WHERE stds_email = '$email'")->fetch_object()->stds_acc_id;


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
	<title>Announcements</title>

	<link rel="shortcut icon" href="/website/include/images/rtu-seal.png" type="image/x-icon">

	<link rel="stylesheet" href="/website/include/css/style.css">
</head>

<body id="body">
	<div class="main-container">
		<div class="main-container-fixed" id="navBar">
			<div class="equal-container-spaced border-bottom unselectable">
				<div class="equal-content-spaced padded fit-width">
					<div class="equal-container fit-width">
						<div class="equal-content center padded-right">
							<a class="center" href="/index.php"><img src="/website/include/images/rtu-seal.png" alt="RTU Seal Logo" height="50" width="50" loading="lazy"></a>
						</div>
						<div class="equal-content center padded-left">
							<h4>Announcements</h4>
						</div>
					</div>
				</div>

				<div class="equal-content-spaced padded fit-width">
					<div class="equal-container fit-width">
						<div class="equal-content center padded-right">
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
						<div class="equal-content center padded-left">
							<a class="center" href="/website/user/profile/student.profile.php">
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
				<div class="equal-content-spaced padded-right fit-width">
					<div class="padded-top-bottom border-bottom">
						<div class="padded-left-right margin-top-bottom">
							<form action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>" method="post">
								<button type="submit" name="dashboard" class="gray full-width" tabindex="-1">Dashboard</button>
							</form>
						</div>
						<div class="padded-left-right margin-top-bottom">
							<form action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>" method="post">
								<button type="submit" name="announcements" class="gray full-width active" tabindex="-1">Announcements</button>
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
								<button type="submit" name="enrollment" class="gray full-width" tabindex="-1">Enrollment</button>
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
				<div class="equal-content-spaced padded-left-right full-width scrollable" id="mainBody">
					<div class="equal-container">
						<div class="equal-content padded-right">
							<div class="padded-top-bottom border-bottom unselectable">
								<div class="padded-left-right">
									<h2>Student Announcements</h2>
								</div>
							</div>
							<div class="padded-top-bottom">
								<div class="padded-left-right">
									<?php
									$student_announcements = $mysqli->query("SELECT * FROM ad_stdAnn ORDER BY ad_stdAnn_id DESC");

									if (mysqli_num_rows($student_announcements) > 0) {
										while ($announcements = $student_announcements->fetch_assoc()) {
											$announcement_title = $announcements['ad_stdAnn_title'];
											$announcement_message = (!$announcements['ad_stdAnn_msg']) ? 'No announcement body' : $announcements['ad_stdAnn_msg'];
											$announcement_date = $announcements['created_at'];

											echo "<div class='rounded bordered margin-top-bottom'>";
											echo "<div class='padded-left-right border-bottom'><h4>$announcement_title</h4></div>";
											echo "<div class='padded'><p>$announcement_message</p><small>$announcement_date</small></div>";
											echo "</div>";
										}

										$student_announcements->free();
									} else {
										echo "<div class='center unselectable margin-top-bottom'><h6>You currently have no student announcements at the moment.</h6></div>";
									}
									?>
								</div>
							</div>
						</div>
						<div class="equal-content padded-left">
							<div class="padded-top-bottom border-bottom unselectable">
								<div class="padded-left-right">
									<h2>University Announcements</h2>
								</div>
							</div>
							<div class="padded-top-bottom">
								<div class="padded-left-right">
									<?php
									$university_announcements = $mysqli->query("SELECT * FROM ad_uniAnn ORDER BY ad_uniAnn_id DESC");

									if (mysqli_num_rows($university_announcements) > 0) {
										while ($announcements = $university_announcements->fetch_assoc()) {
											$announcement_title = $announcements['ad_uniAnn_title'];
											$announcement_message = (!$announcements['ad_uniAnn_msg']) ? 'No announcement body' : $announcements['ad_uniAnn_msg'];
											$announcement_date = $announcements['created_at'];

											echo "<div class='rounded bordered margin-top-bottom'>";
											echo "<div class='padded-left-right border-bottom'><h4>$announcement_title</h4></div>";
											echo "<div class='padded'><p>$announcement_message</p><small>$announcement_date</small></div>";
											echo "</div>";
										}

										$university_announcements->free();
									} else {
										echo "<div class='center unselectable margin-top-bottom'><h6>You currently have no university announcements at the moment.</h6></div>";
									}
									?>
								</div>
							</div>
						</div>
					</div>
					<?php
					if ($_SESSION['show_admissions']) {
						include('admin/admn_submissions.php');
					}

					if ($_SESSION['show_enrollments']) {
						include('admin/enrll_submissions.php');
					}
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
