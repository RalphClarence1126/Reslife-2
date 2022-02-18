<?php
require('../../database/config.php');


session_start();
ob_start();


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
if (!empty($_POST) && isset($_POST['form-builder'])) {
	header('location: /website/user/profile/admin.form-builder.php');
	exit;
}
if (!empty($_POST) && isset($_POST['profile'])) {
	header('location: /website/user/profile/admin.profile.php');
	exit;
}


$email = $_SESSION['username'];
$ad_acc_id = $mysqli->query("SELECT * FROM ad WHERE ad_email = '$email'")->fetch_object()->ad_acc_id;
$sql = '';


if (!empty($_POST) && isset($_POST['set_ann'])) {
	$set_ann_title = $_POST['set_ann_title'];
	$set_ann_msg = $_POST['set_ann_msg'];

	if ($_POST['set_announcement_type_student'] == 'on') {
		$mysqli->query("INSERT INTO ad_stdAnn (ad_acc_id, ad_stdAnn_title, ad_stdAnn_msg) VALUES ('$ad_acc_id', '$set_ann_title', '$set_ann_msg')");
	}
	if ($_POST['set_announcement_type_university'] == 'on') {
		$mysqli->query("INSERT INTO ad_uniAnn (ad_acc_id, ad_uniAnn_title, ad_uniAnn_msg) VALUES ('$ad_acc_id', '$set_ann_title', '$set_ann_msg')");
	}

	header('location: /website/user/profile/admin.announcements.php');
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
	<title>Portal</title>

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
							<h4>Dashboard</h4>
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
										$last_name = $mysqli->query("SELECT ad_lname FROM ad WHERE ad_acc_id = '$ad_acc_id'")->fetch_object()->ad_lname;
										$first_name = $mysqli->query("SELECT ad_fname FROM ad WHERE ad_acc_id = '$ad_acc_id'")->fetch_object()->ad_fname;

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
							<a class="center" href="/website/user/profile/admin.profile.php">
								<img class="profile" src="<?php
															$profile_picture = $mysqli->query("SELECT ad_profile_pic FROM ad WHERE ad_acc_id = '$ad_acc_id'")->fetch_object()->ad_profile_pic;
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
				<div class="equal-content-spaced padded-left-right full-width scrollable" id="mainBody">
					<div class="padded-top-bottom border-bottom unselectable">
						<div class="padded-left-right">
							<h2>Create Announcements</h2>
						</div>
					</div>
					<div class="padded-top-bottom border-bottom">
						<div class="padded-left-right">
							<div class="notification-red margin-top-bottom">
								An automatic announcement is made for both students and the university when admissions or enrollments are enabled or disabled.
							</div>

							<div class="rounded bordered margin-top-bottom">
								<form action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>" method="post" autocomplete="off">
									<div class="padded border-bottom">
										<input class="full-width" type="text" name="set_ann_title" placeholder="Announcement Title" required><br>
										<label for="set_ann_title"></label>
									</div>
									<div class="padded">
										<textarea class="full-width" name="set_ann_msg" rows="1" placeholder="Announcements details here..."></textarea>

										<div class="equal-container margin-top">
											<div class="equal-content padded-left-right center">
												<span class="no-wrap center">
													<input type="checkbox" name="set_announcement_type_student" id="set_announcement_type_student" checked>
													<label for="set_announcement_type_student">Student Announcement</label>
												</span>
											</div>
											<div class="equal-content padded-left-right center">
												<span class="no-wrap center">
													<input type="checkbox" name="set_announcement_type_university" id="set_announcement_type_university" checked>
													<label for="set_announcement_type_university">University Announcement</label>
												</span>
											</div>
										</div>

										<div class="equal-container-spaced margin-top">
											<div class="equal-content-spaced half-width">
												<div class="center">
													<button type="submit" name="set_ann" class="full-width">Set announcement</button>
												</div>
											</div>
											<div class="equal-content-spaced">
												<div class="center">
													<button type="reset" class="red">Reset</button>
												</div>
											</div>
										</div>
									</div>
								</form>
							</div>
						</div>
					</div>

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
				</div>
			</div>
		</div>
	</div>
</body>

<script src="../../include/js/setMainBodyHeight.js"></script>

</html>
