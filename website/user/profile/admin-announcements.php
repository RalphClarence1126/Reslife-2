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


if (!empty($_POST) && isset($_POST['set_ann'])) {
	$set_ann_title = $_POST['set_ann_title'];
	$set_ann_msg = $_POST['set_ann_msg'];

	if ($_POST['set_announcement_type_student'] == 'on') {
		$mysqli->query("INSERT INTO ad_stdAnn (ad_acc_id, ad_stdAnn_title, ad_stdAnn_msg) VALUES ('$ad_acc_id', '$set_ann_title', '$set_ann_msg')");
	}
	if ($_POST['set_announcement_type_university'] == 'on') {
		$mysqli->query("INSERT INTO ad_uniAnn (ad_acc_id, ad_uniAnn_title, ad_uniAnn_msg) VALUES ('$ad_acc_id', '$set_ann_title', '$set_ann_msg')");
	}

	header('location: /website/user/profile/admin-announcements.php');
	exit;
}


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
	<title>Announcements</title>

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
						<button class="full-width" type="submit" name="dashboard" tabindex="-1">Dashboard</button>
					</form>
				</div>
				<div class="margin-top-bottom padded-left-right">
					<form action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>" method="post">
						<button class="full-width active" type="submit" name="announcements" tabindex="-1">Announcements</button>
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
			<div class="padded-top-bottom border-bottom unselectable">
				<div class="padded-left-right">
					<h2>Create Announcements</h2>
				</div>
			</div>
			<div class="padded-top-bottom border-bottom">
				<div class="padded-left-right">
					<div class="notification-red unselectable margin-top-bottom">
						An automatic announcement is made for both students and the university when admissions or enrollments are enabled or disabled.
					</div>
					<div class="rounded bordered margin-top-bottom">
						<form action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>" method="post" autocomplete="off">
							<div class="padded border-bottom">
								<input class="full-width" type="text" name="set_ann_title" placeholder="Announcement title" required><br>
								<label for="set_ann_title"></label>
							</div>
							<div class="padded">
								<textarea class="full-width" name="set_ann_msg" rows="1" placeholder="Announcement details here..."></textarea>
								<div class="margin-top-bottom equal-container">
									<div class="margin-right equal-content center">
										<span class="no-wrap center">
											<input type="checkbox" name="set_announcement_type_student" id="set_announcement_type_student" checked>
											<label for="set_announcement_type_student">Student Announcement</label>
										</span>
									</div>
									<div class="margin-left equal-content center">
										<span class="no-wrap center">
											<input type="checkbox" name="set_announcement_type_university" id="set_announcement_type_university" checked>
											<label for="set_announcement_type_university">University Announcement</label>
										</span>
									</div>
								</div>
								<div class="equal-container-spaced">
									<div class="half-width margin-right equal-content-spaced center">
										<button class="blue full-width" type="submit" name="set_ann">Set announcement</button>
									</div>
									<div class="fit-width margin-left equal-content-spaced center">
										<button class="red full-width" type="reset">Reset</button>
									</div>
								</div>
							</div>
						</form>
					</div>
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
							$student_announcements = $mysqli->query("SELECT * FROM ad_stdAnn ORDER BY ad_stdAnn_id DESC");

							if (mysqli_num_rows($student_announcements) > 0) {
								while ($announcements = $student_announcements->fetch_assoc()) {
									$admin_id = $announcements['ad_acc_id'];
									$announcement_date = $announcements['created_at'];
									$announcement_id = $announcements['ad_stdAnn_id'];
									$announcement_message = (!$announcements['ad_stdAnn_msg']) ? 'No announcement body' : $announcements['ad_stdAnn_msg'];
									$announcement_title = $announcements['ad_stdAnn_title'];

									if (!$admin_id) {
										echo "<div class='rounded bordered-gold margin-top-bottom'>";
										echo "<div class='padded-left-right border-gold-bottom unselectable'><h4>$announcement_title</h4></div>";
										echo "<div class='padded-left-right border-gold-bottom'><p>$announcement_message<br><br><small>$announcement_date</small></p></div>";
										if (!$admin_id) {
											echo "<div class='padded'><div class='center notification-red unselectable'>Automated announcements can not be deleted.</div></div>";
										} else {
											include('admin/announcements_student_delete.php');
										}
										echo "</div>";
									} else {
										echo "<div class='rounded bordered margin-top-bottom'>";
										echo "<div class='padded-left-right border-bottom unselectable'><h4>$announcement_title</h4></div>";
										echo "<div class='padded-left-right border-bottom'><p>$announcement_message<br><br><small>$announcement_date</small></p></div>";
										if (!$admin_id) {
											echo "<div class='padded'><div class='center notification-red unselectable'>Automated announcements can not be deleted.</div></div>";
										} else {
											include('admin/announcements_student_delete.php');
										}
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
							$university_announcements = $mysqli->query("SELECT * FROM ad_uniAnn ORDER BY ad_uniAnn_id DESC");

							if (mysqli_num_rows($university_announcements) > 0) {
								while ($announcements = $university_announcements->fetch_assoc()) {
									$admin_id = $announcements['ad_acc_id'];
									$announcement_date = $announcements['created_at'];
									$announcement_id = $announcements['ad_uniAnn_id'];
									$announcement_message = (!$announcements['ad_uniAnn_msg']) ? 'No announcement body' : $announcements['ad_uniAnn_msg'];
									$announcement_title = $announcements['ad_uniAnn_title'];

									if (!$admin_id) {
										echo "<div class='rounded bordered-blue margin-top-bottom'>";
										echo "<div class='padded-left-right border-blue-bottom unselectable'><h4>$announcement_title</h4></div>";
										echo "<div class='padded-left-right border-blue-bottom'><p>$announcement_message<br><br><small>$announcement_date</small></p></div>";
										if (!$admin_id) {
											echo "<div class='padded'><div class='center notification-red unselectable'>Automated announcements can not be deleted.</div></div>";
										} else {
											include('admin/announcements_university_delete.php');
										}
										echo "</div>";
									} else {
										echo "<div class='rounded bordered margin-top-bottom'>";
										echo "<div class='padded-left-right border-bottom unselectable'><h4>$announcement_title</h4></div>";
										echo "<div class='padded-left-right border-bottom'><p>$announcement_message<br><br><small>$announcement_date</small></p></div>";
										if (!$admin_id) {
											echo "<div class='padded'><div class='center notification-red unselectable'>Automated announcements can not be deleted.</div></div>";
										} else {
											include('admin/announcements_university_delete.php');
										}
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
