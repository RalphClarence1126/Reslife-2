<?php
require('../../database/config.php');


session_start();
ob_start();


$new_student_announcements = $mysqli->query("SELECT UPDATE_TIME FROM information_schema.tables WHERE TABLE_SCHEMA = 'prototype' AND TABLE_NAME = 'ad_stdAnn'")->fetch_object()->UPDATE_TIME;



if (isset($_SESSION['valid_student']) && !empty($_SESSION['valid_student'])) {
	$get_username_profile = $_SESSION['username'];

	$email_regex = '/(\S+)@\S+/';
	$get_username_profile = preg_replace($email_regex, '$1', $get_username_profile);
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
$sql = '';


if (isset($_POST['save'])) {
	if ($_POST['std_lname']) {
		$std_last_name = $_POST['std_lname'];
		$mysqli->query("UPDATE stds SET stds_lname = '$std_last_name' WHERE stds_acc_id = '$std_acc_id'");
	}
	if ($_POST['std_fname']) {
		$std_first_name = $_POST['std_fname'];
		$mysqli->query("UPDATE stds SET stds_fname = '$std_first_name' WHERE stds_acc_id = '$std_acc_id'");
	}
	if ($_POST['std_mname']) {
		$std_middle_name = $_POST['std_mname'];
		$mysqli->query("UPDATE stds SET stds_mname = '$std_middle_name' WHERE stds_acc_id = '$std_acc_id'");
	}
	// if ($_POST['std_sname']) {
	$std_suffix = $_POST['std_sname'];
	$mysqli->query("UPDATE stds SET stds_suffix = '$std_suffix' WHERE stds_acc_id = '$std_acc_id'");
	// }


	if ($_POST['std_contact_number']) {
		$std_contact_number = $_POST['std_contact_number'];
		$mysqli->query("UPDATE stds SET stds_contact = '$std_contact_number' WHERE stds_acc_id = '$std_acc_id'");
	}
	if ($_POST['std_gender']) {
		$std_gender = $_POST['std_gender'];
		$mysqli->query("UPDATE stds SET stds_gender = '$std_gender' WHERE stds_acc_id = '$std_acc_id'");
	}
	if ($_POST['std_religion']) {
		$std_religion = $_POST['std_religion'];
		$mysqli->query("UPDATE stds SET stds_regligion = '$std_religion' WHERE stds_acc_id = '$std_acc_id'");
	}


	if ($_POST['std_age']) {
		$std_age = $_POST['std_age'];
		$mysqli->query("UPDATE stds SET stds_age = '$std_age' WHERE stds_acc_id = '$std_acc_id'");
	}
	if ($_POST['std_mbirthdate']) {
		$std_mbirthdate = $_POST['std_mbirthdate'];
		$mysqli->query("UPDATE stds SET stds_birth_month = '$std_mbirthdate' WHERE stds_acc_id = '$std_acc_id'");
	}
	if ($_POST['std_dbirthdate']) {
		$std_dbirthdate = $_POST['std_dbirthdate'];
		$mysqli->query("UPDATE stds SET stds_birth_day = '$std_dbirthdate' WHERE stds_acc_id = '$std_acc_id'");
	}
	if ($_POST['std_ybirthdate']) {
		$std_ybirthdate = $_POST['std_ybirthdate'];
		$mysqli->query("UPDATE stds SET stds_birth_year = '$std_ybirthdate' WHERE stds_acc_id = '$std_acc_id'");
	}


	if ($_POST['std_birthplace']) {
		$std_birthplace = $_POST['std_birthplace'];
		$mysqli->query("UPDATE stds SET stds_address = '$std_birthplace' WHERE stds_acc_id = '$std_acc_id'");
	}


	if ($_POST['std_email']) {
		$std_email = $mysqli->query("SELECT stds_email FROM stds WHERE stds_acc_id = '$std_acc_id'")->fetch_object()->stds_email;

		if ($_POST['std_email'] != $std_email) {
			$std_email = $_POST['std_email'];
			$mysqli->query("UPDATE stds SET stds_email = '$std_email' WHERE stds_acc_id = '$std_acc_id'");

			$_SESSION = array();
			session_destroy();

			header('location: /index.php');
			exit;
		}
	}
	if ($_POST['std_new_pass']) {
		$std_new_pass = $mysqli->query("SELECT stds_pass FROM stds WHERE stds_acc_id = '$std_acc_id'")->fetch_object()->stds_pass;

		if ($_POST['std_new_pass'] != $std_new_pass) {
			$std_new_pass = $_POST['std_new_pass'];
			$mysqli->query("UPDATE stds SET stds_pass = '$std_new_pass' WHERE stds_acc_id = '$std_acc_id'");

			$_SESSION = array();
			session_destroy();

			header('location: /index.php');
			exit;
		}
	}


	$target_dir = "uploads/student/profile/";

	if (is_dir($target_dir . $email)) {
		$target_dir = "uploads/student/profile/" . $email . "/";
	} else {
		mkdir("uploads/student/profile/" . $email);
		$target_dir = "uploads/student/profile/" . $email . "/";
	}

	$target_file = $target_dir . basename($_FILES["std_profile_picture"]["name"]);
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
		if (move_uploaded_file($_FILES["std_profile_picture"]["tmp_name"], $target_file)) {
			$mysqli->query("UPDATE stds SET stds_profile_pic = '$target_file' WHERE stds_acc_id = '$std_acc_id'");
		}
	} else {
		if ($target_file != $target_dir) {
			$mysqli->query("UPDATE stds SET stds_profile_pic = '$target_file' WHERE stds_acc_id = '$std_acc_id'");
		}
	}


	header('location: /website/user/profile/student.profile.php');
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
							<h4>Profile</h4>
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
								<button type="submit" name="announcements" class="gray full-width" tabindex="-1">Announcements</button>
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
								<button type="submit" name="profile" class="gray full-width active" tabindex="-1">Profile</button>
							</form>
						</div>
					</div>
				</div>
				<div class="equal-content-spaced padded-left-right full-width scrollable" id="mainBody">
					<div class="padded-top-bottom border-bottom unselectable">
						<div class="padded-left-right">
							<h2>Student Information</h2>
						</div>
					</div>
					<div class="padded-top-bottom">
						<div class="padded-left-right">
							<form action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>" method="post" enctype="multipart/form-data" autocomplete="off">
								<div class="margin-top-bottom">
									<fieldset>
										<legend>Personal Information</legend>

										<div class="equal-container">
											<div class="equal-content padded-right">
												<input class="full-width" type="text" name="std_lname" placeholder="Last Name" oninput="this.value = this.value.toUpperCase();" value="<?php
																																														$retval = $mysqli->query("SELECT stds_lname FROM stds WHERE stds_acc_id = '$std_acc_id'")->fetch_object()->stds_lname;
																																														echo $retval;
																																														?>"><br>
												<label for="std_lname">Last Name</label>
											</div>
											<div class="equal-content padded-left-right">
												<input class="full-width" type="text" name="std_fname" placeholder="First Name" oninput="this.value = this.value.toUpperCase();" value="<?php
																																														$retval = $mysqli->query("SELECT stds_fname FROM stds WHERE stds_acc_id = '$std_acc_id'")->fetch_object()->stds_fname;
																																														echo $retval;
																																														?>"><br>
												<label for="std_fname">First Name</label>
											</div>
											<div class="equal-content padded-left-right">
												<input class="full-width" type="text" name="std_mname" placeholder="Middle Mame" oninput="this.value = this.value.toUpperCase();" value="<?php
																																															$retval = $mysqli->query("SELECT stds_mname FROM stds WHERE stds_acc_id = '$std_acc_id'")->fetch_object()->stds_mname;
																																															echo $retval;
																																															?>"><br>
												<label for="std_mname">Middle Name</label>
											</div>
											<div class="equal-content padded-left">
												<input class="full-width" type="text" name="std_sname" placeholder="Suffix" oninput="this.value = this.value.toUpperCase();" value="<?php
																																													$retval = $mysqli->query("SELECT stds_suffix FROM stds WHERE stds_acc_id = '$std_acc_id'")->fetch_object()->stds_suffix;
																																													echo $retval;
																																													?>"><br>
												<label for="std_sname">Suffix (If any)</label>
											</div>
										</div>

										<div class="equal-container margin-top">
											<div class="equal-content padded-right">
												<input class="full-width" type="tel" name="std_contact_number" placeholder="09XX-XXX-XXXX" pattern="(([0-9]{4})-([0-9]{3})-([0-9]{4}))|(([0-9]{4})([0-9]{3})([0-9]{4}))|((\+63)(([0-9]{3})-([0-9]{3})-([0-9]{4})))|((\+63)(([0-9]{3})([0-9]{3})([0-9]{4})))" oninput="this.value = this.value.replace(/[^0-9|\-.]/g, '').replace(/(\..*)\./g, '$1');" value="<?php
																																																																																																				$retval = $mysqli->query("SELECT stds_contact FROM stds WHERE stds_acc_id = '$std_acc_id'")->fetch_object()->stds_contact;
																																																																																																				echo $retval;
																																																																																																				?>"><br>
												<label for="std_contact_number">Contact Number</label>
											</div>
											<div class="equal-content padded-left-right">
												<input class="full-width" type="text" name="std_gender" pattern="[a-zA-Z|\-]+" oninput="this.value = this.value.toUpperCase();" value="<?php
																																														$retval = $mysqli->query("SELECT stds_gender FROM stds WHERE stds_acc_id = '$std_acc_id'")->fetch_object()->stds_gender;
																																														echo $retval;
																																														?>"><br>
												<label for="std_gender">Gender</label>
											</div>
											<div class="equal-content padded-left">
												<input class="full-width" type="text" name="std_religion" oninput="this.value = this.value.toUpperCase();" value="<?php
																																									$retval = $mysqli->query("SELECT stds_regligion FROM stds WHERE stds_acc_id = '$std_acc_id'")->fetch_object()->stds_regligion;
																																									echo $retval;
																																									?>"><br>
												<label for="std_religion">Religion</label>
											</div>
										</div>

										<div class="equal-content margin-top">
											<div class="equal-container">
												<div class="equal-content padded-right">
													<input class="full-width" type="number" name="std_age" min="1" max="100" oninput="this.value = this.value.replace(/[^0-9.]/g, '').replace(/(\..*)\./g, '$1');" value="<?php
																																																							$retval = $mysqli->query("SELECT stds_age FROM stds WHERE stds_acc_id = '$std_acc_id'")->fetch_object()->stds_age;
																																																							echo $retval;
																																																							?>"><br>
													<label for="std_age">Age</label>
												</div>
												<div class="equal-content padded-left-right">
													<input class="full-width" type="text" name="std_mbirthdate" placeholder="MM" pattern="[0-9]{2}" oninput="this.value = this.value.replace(/[^0-9.]/g, '').replace(/(\..*)\./g, '$1');" value="<?php
																																																													$retval = $mysqli->query("SELECT stds_birth_month FROM stds WHERE stds_acc_id = '$std_acc_id'")->fetch_object()->stds_birth_month;
																																																													echo $retval;
																																																													?>"><br>
													<label for="std_mbirthdate">Month</label>
												</div>
												<div class="equal-content padded-left-right">
													<input class="full-width" type="text" name="std_dbirthdate" placeholder="DD" pattern="[0-9]{2}" oninput="this.value = this.value.replace(/[^0-9.]/g, '').replace(/(\..*)\./g, '$1');" value="<?php
																																																													$retval = $mysqli->query("SELECT stds_birth_day FROM stds WHERE stds_acc_id = '$std_acc_id'")->fetch_object()->stds_birth_day;
																																																													echo $retval;
																																																													?>"><br>
													<label for="std_dbirthdate">Day</label>
												</div>
												<div class="equal-content padded-left">
													<input class="full-width" type="text" name="std_ybirthdate" placeholder="YYYY" pattern="[0-9]{4}" oninput="this.value = this.value.replace(/[^0-9.]/g, '').replace(/(\..*)\./g, '$1');" value="<?php
																																																													$retval = $mysqli->query("SELECT stds_birth_year FROM stds WHERE stds_acc_id = '$std_acc_id'")->fetch_object()->stds_birth_year;
																																																													echo $retval;
																																																													?>"><br>
													<label for="std_ybirthdate">Year</label>
												</div>
											</div>
										</div>

										<div class="equal-content margin-top">
											<input class="full-width" type="text" name="std_birthplace" oninput="this.value = this.value.toUpperCase();" value="<?php
																																								$retval = $mysqli->query("SELECT stds_address FROM stds WHERE stds_acc_id = '$std_acc_id'")->fetch_object()->stds_address;
																																								echo $retval;
																																								?>"><br>
											<label for="std_birthplace">Address</label>
										</div>
									</fieldset>
								</div>

								<br>

								<div class="margin-top-bottom">
									<fieldset>
										<legend>Account Information</legend>

										<div class="equal-container">
											<div class="equal-content padded-right">
												<input class="full-width" type="email" name="std_email" placeholder="Email" oninput="this.value = this.value.toLowerCase();" value="<?php
																																													$retval = $mysqli->query("SELECT stds_email FROM stds WHERE stds_acc_id = '$std_acc_id'")->fetch_object()->stds_email;
																																													echo $retval;
																																													?>"><br>
												<label for="std_email">Email Address</label>
											</div>
											<div class="equal-content padded-left">
												<input class="full-width" type="password" name="std_new_pass" placeholder="New Password"><br>
												<label for="std_new_pass">New Password</label>
											</div>
										</div>

										<div class="equal-container-spaced margin-top">
											<div class="equal-content-spaced fit-width padded-right">
												<img src="<?php
															$profile_picture = $mysqli->query("SELECT stds_profile_pic FROM stds WHERE stds_acc_id = '$std_acc_id'")->fetch_object()->stds_profile_pic;
															$get_profile_picture = (file_exists($profile_picture)) ? $profile_picture : $profile_picture = false;

															$retval = ($profile_picture) ? $profile_picture : "/website/include/images/user.png";

															echo $retval;
															?>" alt="User Profile Picture" height="250" width="250" loading="lazy">
											</div>
											<div class="equal-content-spaced full-width padded-left">
												<input class="full-width" type="file" name="std_profile_picture" placeholder="Select New Profile Picture" accept="image/*"><br>
												<label for="std_profile_picture">Upload New Profile Picture</label>
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
