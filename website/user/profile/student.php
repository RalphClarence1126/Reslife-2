<?php
session_start();

// To prevent invalid tampering with an account
if (isset($_SESSION['valid']) && !empty($_SESSION['valid'])) {
	$get_username_profile = $_SESSION['username'];
} else {

	// Redirect to default page
	header('location: /index.php');
	exit;
}

// Check if user wants to check profile
if (!empty($_POST) && isset($_POST['profile'])) {

	// Redirect to profile
	header('location: /website/user/profile/student.php');
	exit;
}

// Check if user wants to check the admission form
if (!empty($_POST) && isset($_POST['admission_form'])) {

	// Redirect to admission form
	header('location: /website/user/forms/student/admission.php');
	exit;
}

// Check if user wants to check the enrollment form
if (!empty($_POST) && isset($_POST['enrollment_form'])) {

	// Redirect to enrollment form
	header('location: /website/user/forms/student/enrollment.php');
	exit;
}

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

// Announcements and Updates
$user_announcements = 'No announcements yet';
$user_updates = 'No updates yet';
?>


<!DOCTYPE html>
<html lang="en">

<head>
	<meta charset="UTF-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>Profile | <?php echo ucfirst($get_username_profile); ?></title>

	<link rel="shortcut icon" href="/website/include/images/rtu-seal.png" type="image/x-icon">

	<link rel="stylesheet" href="/website/include/css/style.css">
</head>

<body>
	<div class="fade-in padded-left-right">
		<div class="padded white rounded-bottom">
			<div class="equal-container-spaced">
				<div class="equal-content">
					<form class="full-height" action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>" method="post" enctype="multipart/form-data" autocomplete="off">
						<button type="submit" name="profile" class="padded-left-right full-height full-width rounded">
							<h1>
								<?php echo ucfirst($get_username_profile); ?>
							</h1>
						</button>
					</form>
				</div>

				<div class="equal-content center">
					<a href="/index.php">
						<img src="/website/include/images/rtu-seal.png" alt="RTU Seal Logo" height="60" width="60" loading="lazy">
					</a>
				</div>

				<div class="equal-content center">
					<form action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>" method="post">
						<button type="submit" name="logout" class="red rounded" tabindex="-1">Logout</button>
					</form>
				</div>
			</div>
		</div>

		<div class="equal-container-spaced margin-top">
			<div class="margin-right quarter-width padded-bottom">
				<div class="light-gray padded rounded margin-bottom">
					<h2>
						Announcements
					</h2>

					<div class="gold padded rounded-top">
						<h3>
							<?php echo date('d-m-Y') . " " . date('l'); ?>
						</h3>
					</div>
					<div class="white padded rounded-bottom">
						<p>
							<?php echo $user_announcements; ?>
						</p>
					</div>
				</div>

				<div class="light-gray padded rounded">
					<h2>
						Updates
					</h2>

					<div class="gold padded rounded-top">
						<h3>
							<?php echo date('d-m-Y') . " " . date('l'); ?>
						</h3>
					</div>
					<div class="white padded rounded-bottom">
						<p>
							<?php echo $user_updates; ?>
						</p>
					</div>
				</div>
			</div>

			<div class="margin-left three-quarter-width padded-bottom">
				<div class="white padded rounded margin-bottom">
					<h1>
						Profile Details
					</h1>

					<div class="blue padded rounded-top">
						<h2>
							Student Information
						</h2>
					</div>
					<div class="light-gray padded rounded-bottom">
						<form>
							<fieldset class="padded-none margin-none">
								<legend>
									Student's Name
								</legend>
								<div class="equal-container">
									<div class="equal-content padded-right">
										<input class="full-width" type="text" name="student_last_name" value="Last Name" disabled>
										<br>
										<label for="student-last-name">Last Name</label>
									</div>
									<div class="equal-content padded-left-right">
										<input class="full-width" type="text" name="student_first_name" value="First Name" disabled>
										<br>
										<label for="student-first-name">First Name</label>
									</div>
									<div class="equal-content padded-left-right">
										<input class="full-width" type="text" name="student_middle_name" value="Middle Name" disabled>
										<br>
										<label for=" student-middle-name">Middle Name</label>
									</div>
									<div class="equal-content padded-left">
										<input class="full-width" type="text" name="student_suffix_name" value="Suffix" disabled>
										<br>
										<label for=" student-suffix-name">Suffix</label>
									</div>
								</div>
							</fieldset>
							<fieldset class="padded-none margin-none margin-top">
								<legend>
									Student's Date of Birth
								</legend>
								<div class="equal-container">
									<div class="equal-content padded-right">
										<input class="full-width" type="text" name="student_birthdate_month" value="<?php echo date('m'); ?>" disabled>
										<br>
										<label for="student-birthdate-month">Month</label>
									</div>
									<div class="equal-content padded-left-right">
										<input class="full-width" type="text" name="student_birthdate_day" value="<?php echo date('d'); ?>" disabled>
										<br>
										<label for="student-birthdate-month">Day</label>
									</div>
									<div class="equal-content padded-left">
										<input class="full-width" type="text" name="student_birthdate_year" value="<?php echo date('Y'); ?>" disabled>
										<br>
										<label for="student-birthdate-month">Year</label>
									</div>
								</div>
							</fieldset>
							<fieldset class="padded-none margin-none margin-top">
								<legend>
									Place of Birth
								</legend>
								<input class="full-width" type="text" name="student_birthplace" value="Place of Birth" disabled>
								<label for="student-birthplace">Address</label>
							</fieldset>
							<div class="equal-container margin-top">
								<div class="equal-content padded-right">
									<fieldset class="padded-none margin-none">
										<legend>
											Age
										</legend>
										<input class="full-width" type="number" name="student_age" value="<?php echo rand(1, 100); ?>" disabled>
									</fieldset>
								</div>
								<div class="equal-content padded-left-right">
									<fieldset class="padded-none margin-none">
										<legend>
											Gender
										</legend>
										<input class="full-width" type="text" name="student_gender" value="Gender" disabled>
									</fieldset>
								</div>
								<div class="equal-content padded-left">
									<fieldset class="padded-none margin-none">
										<legend>
											Religion
										</legend>
										<input class="full-width" type="text" name="student_religion" value="Religion" disabled>
									</fieldset>
								</div>
							</div>
							<div class="equal-container margin-top">
								<div class="equal-content padded-right">
									<fieldset class="padded-none margin-none">
										<legend>
											Email Address
										</legend>
										<input class="full-width" type="email" name="student_email" value="email@address.com" disabled>
									</fieldset>
								</div>
								<div class="equal-content padded-left-right">
									<fieldset class="padded-none margin-none">
										<legend>
											Contact Number
										</legend>
										<input class="full-width" type="tel" name="student_contact_number" value="<?php echo rand(11111111111, 99999999999); ?>" disabled>
									</fieldset>
								</div>
								<div class="equal-content padded-left">
									<fieldset class="padded-none margin-none">
										<legend>
											Telephone Number
										</legend>
										<input class="full-width" type="tel" name="student_telephone_number" value="<?php echo rand(1111111111, 9999999999); ?>" disabled>
									</fieldset>
								</div>
							</div>
							<fieldset class="padded-none margin-none margin-top">
								<legend>
									Address
								</legend>
								<div class="equal-container">
									<div class="equal-content padded-right">
										<input class="full-width" type="text" name="student_address_street" value="Street Address" disabled>
										<br>
										<label for="student-address-street">Street Address</label>
									</div>
									<div class="equal-content padded-left-right">
										<input class="full-width" type="text" name="student_address_municipality" value="Municipality" disabled>
										<br>
										<label for="student-address-municipality">Municipality</label>
									</div>
									<div class="equal-content padded-left">
										<input class="full-width" type="text" name="student_address_province" value="Province" disabled>
										<br>
										<label for="student-address-province">Province</label>
									</div>
								</div>
							</fieldset>
						</form>
					</div>
				</div>

				<div class="white padded rounded">
					<div class="equal-container">
						<div class="equal-content margin-right">
							<form action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>" method="post" enctype="multipart/form-data" autocomplete="off">
								<button type="submit" name="admission_form" class="blue padded full-width rounded">Admission Form</button>
							</form>
						</div>

						<div class="equal-content margin-left">
							<form action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>" method="post" enctype="multipart/form-data" autocomplete="off">
								<button type="submit" name="enrollment_form" class="blue padded full-width rounded">Enrollment Form</button>
							</form>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
</body>

</html>