<?php
require('../../database/config.php');


session_start();


$_SESSION['viewed_announcement'] = 1;


if (isset($_SESSION['valid_student']) && !empty($_SESSION['valid_student'])) {
	$get_username_profile = $_SESSION['username'];

	$email_regex = '/(\S+)@\S+/';
	$get_username_profile = preg_replace($email_regex, '$1', $get_username_profile);
} else {
	header('location: /index.php');
	exit;
}


if (!empty($_POST) && isset($_POST['status'])) {
	header('location: /website/user/profile/student.status.php');
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
						<h2>Announcements</h2>
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
					<h4>
						Student Announcements
					</h4>

					<?php
					$student_announcements = $mysqli->query("SELECT * FROM ad_stdAnn ORDER BY ad_stdAnn_id DESC");

					if ($student_announcements) {
						while ($announcements = $student_announcements->fetch_assoc()) {
							$announcement_title = $announcements['ad_stdAnn_title'];
							$announcement_message = (!$announcements['ad_stdAnn_msg']) ? 'No announcement body' : $announcements['ad_stdAnn_msg'];
							$announcement_date = $announcements['created_at'];

							echo "<div class='rounded-top blue padded margin-top'><h5>$announcement_title</h5></div>";
							echo "<div class='rounded-bottom white padded'><p>$announcement_message</p><br><small>$announcement_date</small></div>";
						}

						$student_announcements->free();
					}
					?>

					<hr>

					<h4>
						University Announcements
					</h4>

					<?php
					$university_announcements = $mysqli->query("SELECT * FROM ad_uniAnn ORDER BY ad_uniAnn_id DESC");

					if ($university_announcements) {
						while ($announcements = $university_announcements->fetch_assoc()) {
							$announcement_title = $announcements['ad_uniAnn_title'];
							$announcement_message = (!$announcements['ad_uniAnn_msg']) ? 'No announcement body' : $announcements['ad_uniAnn_msg'];
							$announcement_date = $announcements['created_at'];

							echo "<div class='rounded-top gold padded margin-top'><h5>$announcement_title</h5></div>";
							echo "<div class='rounded-bottom white padded'><p>$announcement_message</p><br><small>$announcement_date</small></div>";
						}

						$university_announcements->free();
					}
					?>
				</div>
			</div>
		</div>
	</div>
</body>

</html>
