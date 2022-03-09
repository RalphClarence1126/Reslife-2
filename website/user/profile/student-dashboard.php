<?php
require('../../database/config.php');


session_start();
ob_start();


if (isset($_COOKIE['login_student']) && !empty($_COOKIE['login_student'])) {
	$get_username_profile = $_COOKIE['username'];
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


$email = $_COOKIE['username'];
$std_acc_id = $mysqli->query("SELECT * FROM stds WHERE stds_email = '$email'")->fetch_object()->stds_acc_id;
$sql = '';


if (!empty($_POST) && isset($_POST['logout'])) {
	$_SESSION = array();
	session_destroy();

	setcookie('login_student', '', time() - 3600, '/');
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
																$account_theme = $mysqli->query("SELECT stds_account_theme FROM stds WHERE stds_acc_id = '$std_acc_id'")->fetch_object()->stds_account_theme;

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
							<a class="center" href="/website/user/profile/student-profile.php" title="View Profile">
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
			</div>
			<div class="padded-top-bottom border-bottom">
				<div class="margin-top-bottom padded-left-right">
					<form action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>" method="post">
						<button type="submit" name="admission" class="full-width" tabindex="-1">Admission</button>
					</form>
				</div>
				<div class="margin-top-bottom padded-left-right">
					<form action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>" method="post">
						<button type="submit" name="enrollment" class="full-width" tabindex="-1">Enrollment</button>
					</form>
				</div>
			</div>
			<div class="padded-top-bottom">
				<div class="margin-top-bottom padded-left-right">
					<form action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>" method="post">
						<button class="full-width" type="submit" name="profile" tabindex="-1">Profile</button>
					</form>
				</div>
			</div>
		</div>
		<div class="margin-left equal-content scrollable" id="main">
			<div class="padded-top-bottom border-bottom unselectable">
				<div class="padded-left-right">
					<h2>Status Updates</h2>
				</div>
			</div>
			<div class="padded-top-bottom">
				<div class="padded-left-right">
					<?php
					$sql = "SELECT * FROM ad_stdUpd WHERE stds_acc_id = '$std_acc_id' ORDER BY ad_stdUpd_id DESC";
					$student_updates = mysqli_query($mysqli, $sql);
					if (mysqli_num_rows($student_updates) > 0) {
						while ($updates = $student_updates->fetch_assoc()) {
							$update_title = $updates['ad_stdUpd_title'];
							$update_message = (!$updates['ad_stdUpd_msg']) ? 'No status body' : $updates['ad_stdUpd_msg'];
							$update_date = $updates['created_at'];

							echo "<div class='rounded bordered margin-top-bottom'>";
							echo "<div class='padded-left-right border-bottom unselectable'><h4>$update_title</h4></div>";
							echo "<div class='padded'><p>$update_message</p><small>$update_date</small></div>";
							echo "</div>";
						}

						$student_updates->free();
					} else {
						echo "<div class='center unselectable margin-top-bottom'><h6>You currently have no status updates at the moment.</h6></div>";
					}
					?>
				</div>
			</div>
			<div class="equal-container">
				<div class="equal-content margin-right">
					<div class="padded-top-bottom border-bottom unselectable">
						<div class="padded-left-right">
							<h2>Student Announcements</h2>
						</div>
					</div>
					<div class="padded-top-bottom">
						<div class="padded-left-right">
							<?php
							$sql = "SELECT * FROM ad_stdAnn ORDER BY ad_stdAnn_id DESC";
							$student_announcements = mysqli_query($mysqli, $sql);
							if (mysqli_num_rows($student_announcements) > 0) {
								while ($announcements = $student_announcements->fetch_assoc()) {
									$admin_id = $announcements['ad_acc_id'];
									$announcement_date = $announcements['created_at'];
									$announcement_message = (!$announcements['ad_stdAnn_msg']) ? 'No announcement body' : $announcements['ad_stdAnn_msg'];
									$announcement_title = $announcements['ad_stdAnn_title'];

									if (!$admin_id) {
										echo "<div class='rounded bordered-gold margin-top-bottom'>";
										echo "<div class='padded-left-right border-gold-bottom unselectable'><h4>$announcement_title</h4></div>";
										echo "<div class='padded-left-right'><p>$announcement_message<br><br><small>$announcement_date</small></p></div>";
										echo "</div>";
									} else {
										echo "<div class='rounded bordered margin-top-bottom'>";
										echo "<div class='padded-left-right border-bottom unselectable'><h4>$announcement_title</h4></div>";
										echo "<div class='padded-left-right'><p>$announcement_message<br><br><small>$announcement_date</small></p></div>";
										echo "</div>";
									}
								}

								$student_announcements->free();
							} else {
								echo "<div class='center unselectable margin-top-bottom'><h6>You currently have no student announcements at the moment.</h6></div>";
							}
							?>
						</div>
					</div>
				</div>
				<div class="equal-content margin-left">
					<div class="padded-top-bottom border-bottom unselectable">
						<div class="padded-left-right">
							<h2>University Announcements</h2>
						</div>
					</div>
					<div class="padded-top-bottom">
						<div class="padded-left-right">
							<?php
							$sql = "SELECT * FROM ad_uniAnn ORDER BY ad_uniAnn_id DESC";
							$university_announcements = mysqli_query($mysqli, $sql);
							if (mysqli_num_rows($university_announcements) > 0) {
								while ($announcements = $university_announcements->fetch_assoc()) {
									$admin_id = $announcements['ad_acc_id'];
									$announcement_date = $announcements['created_at'];
									$announcement_message = (!$announcements['ad_uniAnn_msg']) ? 'No announcement body' : $announcements['ad_uniAnn_msg'];
									$announcement_title = $announcements['ad_uniAnn_title'];

									if (!$admin_id) {
										echo "<div class='rounded bordered-blue margin-top-bottom'>";
										echo "<div class='padded-left-right border-blue-bottom unselectable'><h4>$announcement_title</h4></div>";
										echo "<div class='padded-left-right'><p>$announcement_message<br><br><small>$announcement_date</small></p></div>";
										echo "</div>";
									} else {
										echo "<div class='rounded bordered margin-top-bottom'>";
										echo "<div class='padded-left-right border-bottom unselectable'><h4>$announcement_title</h4></div>";
										echo "<div class='padded-left-right'><p>$announcement_message<br><br><small>$announcement_date</small></p></div>";
										echo "</div>";
									}
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
		</div>
	</div>
</body>

<script src="../../include/js/setMainBodyHeight.js"></script>

</html>


<?php
ob_end_flush();
?>
