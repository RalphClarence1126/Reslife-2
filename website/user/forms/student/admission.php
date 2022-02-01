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
	<title>Profile | <?php echo ucfirst($get_username_profile); ?> | Admission Form</title>

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

		<div class="padded-top-bottom">
			<div class="white padded rounded">
				<div class="blue padded rounded-top">
					<h1>
						Admission Form
					</h1>
				</div>
				<div class="light-gray padded rounded-bottom">
					<form action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>" method="post" enctype="multipart/form-data" autocomplete="off">
						<fieldset class="padded-none margin-none margin-bottom">
							<legend class="rounded gold padded-left-right full-width center">
								<h2>
									Learner Information
								</h2>
							</legend>
							<fieldset class="padded-none margin-none margin-top">
								<legend>
									Student's Name
								</legend>
								<div class="equal-container">
									<div class="equal-content padded-right">
										<input class="full-width" type="text" name="student_last_name" oninput="this.value = this.value.replace(/[^a-zA-Z|\-.]/g, '').replace(/(\..*)\./g, '$1').toUpperCase();" required>
										<br>
										<label for="student-last-name">Last Name</label>
									</div>
									<div class="equal-content padded-left-right">
										<input class="full-width" type="text" name="student_first_name" oninput="this.value = this.value.replace(/[^a-zA-Z|\-.]/g, '').replace(/(\..*)\./g, '$1').toUpperCase();" required>
										<br>
										<label for="student-first-name">First Name</label>
									</div>
									<div class="equal-content padded-left-right">
										<input class="full-width" type="text" name="student_middle_name" oninput="this.value = this.value.replace(/[^a-zA-Z|\-.]/g, '').replace(/(\..*)\./g, '$1').toUpperCase();" required>
										<br>
										<label for=" student-middle-name">Middle Name</label>
									</div>
									<div class="equal-content padded-left">
										<input class="full-width" type="text" name="student_suffix_name" oninput="this.value = this.value.replace(/[^a-zA-Z|\-.]/g, '').replace(/(\..*)\./g, '$1').toUpperCase();" placeholder="[OPTIONAL]">
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
										<input class="full-width" type="text" name="student_birthdate_month" oninput="this.value = this.value.replace(/[^0-9.]/g, '').replace(/(\..*)\./g, '$1');" pattern="[0-9]{2}" placeholder="MM" required>
										<br>
										<label for="student-birthdate-month">Month</label>
									</div>
									<div class="equal-content padded-left-right">
										<input class="full-width" type="text" name="student_birthdate_day" oninput="this.value = this.value.replace(/[^0-9.]/g, '').replace(/(\..*)\./g, '$1');" pattern="[0-9]{2}" placeholder="DD" required>
										<br>
										<label for="student-birthdate-month">Day</label>
									</div>
									<div class="equal-content padded-left">
										<input class="full-width" type="text" name="student_birthdate_year" oninput="this.value = this.value.replace(/[^0-9.]/g, '').replace(/(\..*)\./g, '$1');" pattern="[0-9]{4}" placeholder="YYYY" required>
										<br>
										<label for="student-birthdate-month">Year</label>
									</div>
								</div>
							</fieldset>
							<fieldset class="padded-none margin-none margin-top">
								<legend>
									Place of Birth
								</legend>
								<input class="full-width" type="text" name="student_birthplace" oninput="this.value = this.value.toUpperCase();" required>
								<label for="student-birthplace">Address</label>
							</fieldset>
							<div class="equal-container margin-top">
								<div class="equal-content padded-right">
									<fieldset class="padded-none margin-none">
										<legend>
											Age
										</legend>
										<input class="full-width" type="number" name="student_age" oninput="this.value = this.value.replace(/[^0-9.]/g, '').replace(/(\..*)\./g, '$1');" min="1" max="100" required>
									</fieldset>
								</div>
								<div class="equal-content padded-left-right">
									<fieldset class="padded-none margin-none">
										<legend>
											Gender
										</legend>
										<input class="full-width" type="text" name="student_gender" oninput="this.value = this.value.replace(/[^a-zA-Z|\-.]/g, '').replace(/(\..*)\./g, '$1').toUpperCase();" pattern="[a-zA-Z|\-]+" required>
									</fieldset>
								</div>
								<div class="equal-content padded-left">
									<fieldset class="padded-none margin-none">
										<legend>
											Religion
										</legend>
										<input class="full-width" type="text" name="student_religion" oninput="this.value = this.value.replace(/[^a-zA-Z|\-.]/g, '').replace(/(\..*)\./g, '$1').toUpperCase();" required>
									</fieldset>
								</div>
							</div>
							<div class="equal-container margin-top">
								<div class="equal-content padded-right">
									<fieldset class="padded-none margin-none">
										<legend>
											Email Address
										</legend>
										<input class="full-width" type="email" name="student_email" oninput="this.value = this.value.toLowerCase();" placeholder="example@email.com" pattern="\S+@\S+\.com" required>
									</fieldset>
								</div>
								<div class="equal-content padded-left-right">
									<fieldset class="padded-none margin-none">
										<legend>
											Contact Number
										</legend>
										<input class="full-width" type="tel" name="student_contact_number" oninput="this.value = this.value.replace(/[^0-9|\-.]/g, '').replace(/(\..*)\./g, '$1');" placeholder="09XX-XXX-XXXX" pattern="(([0-9]{4})-([0-9]{3})-([0-9]{4}))|(([0-9]{4})([0-9]{3})([0-9]{4}))|((\+63)(([0-9]{3})-([0-9]{3})-([0-9]{4})))|((\+63)(([0-9]{3})([0-9]{3})([0-9]{4})))" required>
									</fieldset>
								</div>
								<div class="equal-content padded-left">
									<fieldset class="padded-none margin-none">
										<legend>
											Telephone Number
										</legend>
										<input class="full-width" type="tel" name="student_telephone_number" oninput="this.value = this.value.replace(/[^0-9|\-.]/g, '').replace(/(\..*)\./g, '$1');" placeholder="[OPTIONAL]">
									</fieldset>
								</div>
							</div>
							<fieldset class="padded-none margin-none margin-top">
								<legend>
									Address
								</legend>
								<div class="equal-container">
									<div class="equal-content padded-right">
										<input class="full-width" type="text" name="student_address_street" oninput="this.value = this.value.toUpperCase();" required>
										<br>
										<label for="student-address-street">Street Address</label>
									</div>
									<div class="equal-content padded-left-right">
										<input class="full-width" type="text" name="student_address_municipality" oninput="this.value = this.value.replace(/[^a-zA-Z|\-.]/g, '').replace(/(\..*)\./g, '$1').toUpperCase();" required>
										<br>
										<label for="student-address-municipality">Municipality</label>
									</div>
									<div class="equal-content padded-left">
										<input class="full-width" type="text" name="student_address_province" oninput="this.value = this.value.replace(/[^a-zA-Z|\-.]/g, '').replace(/(\..*)\./g, '$1').toUpperCase();" required>
										<br>
										<label for="student-address-province">Province</label>
									</div>
								</div>
							</fieldset>
						</fieldset>

						<br>

						<fieldset class="padded-none margin-none margin-top-bottom">
							<legend class="rounded gold padded-left-right full-width center">
								<h2>
									Application Details
								</h2>
							</legend>
							<div class="margin-top">
								<fieldset class="padded-none margin-none">
									<legend>
										Application Grade
									</legend>
									<select class="full-width white" name="student_application_grade" onload="this.value = 'Default';" required>
										<option value="Default" hidden>
											Select Grade Level
										</option>
										<option value="Grade 11">
											Grade 11
										</option>
										<option value="Grade 12">
											Grade 12
										</option>
									</select>
								</fieldset>
							</div>
							<div class="margin-top">
								<fieldset class="padded-none margin-none">
									<legend>
										Enrollment Status
									</legend>
									<select class="full-width white" name="student_enrollment_status" onload="this.value = '';">
										<option value="Default" hidden>
											Select Enrollment Status
										</option>
										<option value="New Student">
											New Student
										</option>
										<option value="Old Student">
											Old Student
										</option>
									</select>
								</fieldset>
							</div>
							<div class="margin-top">
								<fieldset class="padded-none margin-none">
									<input class="full-width" type="text" name="student_number" oninput="this.value = this.value.replace(/[^0-9|\-.]/g, '').replace(/(\..*)\./g, '$1');" placeholder="XXXX-XXXXXX" pattern="[0-9]{4}-[0-9]{6}">
								</fieldset>
							</div>
							<div class="margin-top">
								<ul>
									Please upload a copy of the following:
									<li>
										2x2 Picture
									</li>
									<li>
										PSA
									</li>
									<li>
										Good Moral
									</li>
									<li>
										Form 137
									</li>
								</ul>

								<div class="equal-container">
									<div class="equal-content padded-right">
										<fieldset class="padded-none margin-none">
											<legend>
												Upload your 2x2 picture here
											</legend>
											<input class="full-width white" type="file" name="student_picture" accept="image/*" required>
											<label>
												<small>
													<em>
														[Image Only]
													</em>
												</small>
											</label>
										</fieldset>
									</div>
									<div class="equal-content padded-left">
										<fieldset class="padded-none margin-none">
											<legend>
												Upload your PSA here
											</legend>
											<input class="full-width white" type="file" name="student_psa" accept=".pdf" required>
											<label>
												<small>
													<em>
														[PDF Only]
													</em>
												</small>
											</label>
										</fieldset>
									</div>
								</div>
								<div class="equal-container margin-top">
									<div class="equal-content padded-right">
										<fieldset class="padded-none margin-none">
											<legend>
												Upload your Good Moral here
											</legend>
											<input class="full-width white" type="file" name="student_good_moral" accept=".pdf" required>
											<label>
												<small>
													<em>
														[PDF Only]
													</em>
												</small>
											</label>
										</fieldset>
									</div>
									<div class="equal-content padded-left">
										<fieldset class="padded-none margin-none">
											<legend>
												Upload your Form 137 here
											</legend>
											<input class="full-width white" type="file" name="student_form_137" accept=".pdf" required>
											<label>
												<small>
													<em>
														[PDF Only]
													</em>
												</small>
											</label>
										</fieldset>
									</div>
								</div>
							</div>
						</fieldset>

						<br>

						<fieldset class="padded-none margin-none margin-top-bottom">
							<legend class="rounded gold padded-left-right full-width center">
								<h2>
									Educational Background
								</h2>
							</legend>
							<fieldset class="padded-none margin-none margin-top">
								<legend>
									Learner Reference Number (LRN)
								</legend>
								<input class="full-width" type="text" name="student_lrn" oninput="this.value = this.value.replace(/[^0-9.]/g, '').replace(/(\..*)\./g, '$1');" placeholder="123456123456" pattern="[0-9]{6}[0-9]{6}" required>
							</fieldset>
							<fieldset class="padded-none margin-none margin-top">
								<legend>
									Name of Former School
								</legend>
								<input class="full-width" type="text" name="student_former_school" oninput="this.value = this.value.toUpperCase();" required>
								<br>
								<label for="student-former-school">Complete School Name</label>

								<div class="equal-container margin-top">
									<div class="equal-content padded-right">
										<input class="full-width" type="text" name="student_former_school_graduate_year" oninput="this.value = this.value.replace(/[^0-9.]/g, '').replace(/(\..*)\./g, '$1');" placeholder="YYYY" pattern="[0-9]{4}" required>
										<br>
										<label for="student_former_school-graduate-year">Year Graduated</label>
									</div>
									<div class="equal-content padded-left">
										<input class="full-width" type="text" name="student_former_school_schoolyear" oninput="this.value = this.value.replace(/[^0-9|\-.]/g, '').replace(/(\..*)\./g, '$1');" placeholder="YYYY-YYYY" pattern="[0-9]{4}-[0-9]{4}" required>
										<br>
										<label for="student-former-school-schoolyear">School Year</label>
									</div>
								</div>
							</fieldset>
						</fieldset>

						<br>

						<fieldset class="padded-none margin-none margin-top-bottom">
							<legend class="rounded gold padded-left-right full-width center">
								<h2>
									Parent Information
								</h2>
							</legend>
							<fieldset class="padded-none margin-none margin-top">
								<legend>
									Mother's Name
								</legend>
								<div class="equal-container">
									<div class="equal-content padded-right">
										<input class="full-width" type="text" name="student_mother_last_name" oninput="this.value = this.value.replace(/[^a-zA-Z|\-.]/g, '').replace(/(\..*)\./g, '$1').toUpperCase();" required>
										<br>
										<label for="last-name">Last Name</label>
									</div>

									<div class="equal-content padded-left-right">
										<input class="full-width" type="text" name="student_mother_first_name" oninput="this.value = this.value.replace(/[^a-zA-Z|\-.]/g, '').replace(/(\..*)\./g, '$1').toUpperCase();" required>
										<br>
										<label for="first-name">First Name</label>
									</div>

									<div class="equal-content padded-left">
										<input class="full-width" type="text" name="student_mother_middle_name" oninput="this.value = this.value.replace(/[^a-zA-Z|\-.]/g, '').replace(/(\..*)\./g, '$1').toUpperCase();" required>
										<br>
										<label for=" middle-name">Middle Name</label>
									</div>
								</div>
								<div class="equal-container margin-top">
									<div class="equal-content padded-right">
										<fieldset class="padded-none margin-none">
											<legend>
												Occupation
											</legend>
											<input class="full-width" type="text" name="student_mother_occupation" oninput="this.value = this.value.replace(/[^a-zA-Z|\-.]/g, '').replace(/(\..*)\./g, '$1').toUpperCase();" required>
										</fieldset>
									</div>
									<div class="equal-content padded-left">
										<fieldset class="padded-none margin-none">
											<legend>
												Contact Number
											</legend>
											<input class="full-width" type="tel" name="student_mother_contact_number" oninput="this.value = this.value.replace(/[^0-9|\-.]/g, '').replace(/(\..*)\./g, '$1');" placeholder="09XX-XXX-XXXX" pattern="(([0-9]{4})-([0-9]{3})-([0-9]{4}))|(([0-9]{4})([0-9]{3})([0-9]{4}))|((\+63)(([0-9]{3})-([0-9]{3})-([0-9]{4})))|((\+63)(([0-9]{3})([0-9]{3})([0-9]{4})))" required>
										</fieldset>
									</div>
								</div>
							</fieldset>
							<fieldset class="padded-none margin-none margin-top">
								<legend>
									Father's Name
								</legend>
								<div class="equal-container">
									<div class="equal-content padded-right">
										<input class="full-width" type="text" name="student_father_last_name" oninput="this.value = this.value.replace(/[^a-zA-Z|\-.]/g, '').replace(/(\..*)\./g, '$1').toUpperCase();" required>
										<br>
										<label for="last-name">Last Name</label>
									</div>

									<div class="equal-content padded-left-right">
										<input class="full-width" type="text" name="student_father_first_name" oninput="this.value = this.value.replace(/[^a-zA-Z|\-.]/g, '').replace(/(\..*)\./g, '$1').toUpperCase();" required>
										<br>
										<label for="first-name">First Name</label>
									</div>

									<div class="equal-content padded-left">
										<input class="full-width" type="text" name="student_father_middle_name" oninput="this.value = this.value.replace(/[^a-zA-Z|\-.]/g, '').replace(/(\..*)\./g, '$1').toUpperCase();" required>
										<br>
										<label for=" middle-name">Middle Name</label>
									</div>
								</div>
								<div class="equal-container margin-top">
									<div class="equal-content padded-right">
										<fieldset class="padded-none margin-none">
											<legend>
												Occupation
											</legend>
											<input class="full-width" type="text" name="student_father_occupation" oninput="this.value = this.value.replace(/[^a-zA-Z|\-.]/g, '').replace(/(\..*)\./g, '$1').toUpperCase();" required>
										</fieldset>
									</div>
									<div class="equal-content padded-left">
										<fieldset class="padded-none margin-none">
											<legend>
												Contact Number
											</legend>
											<input class="full-width" type="tel" name="student_father_contact_number" oninput="this.value = this.value.replace(/[^0-9|\-.]/g, '').replace(/(\..*)\./g, '$1');" placeholder="09XX-XXX-XXXX" pattern="(([0-9]{4})-([0-9]{3})-([0-9]{4}))|(([0-9]{4})([0-9]{3})([0-9]{4}))|((\+63)(([0-9]{3})-([0-9]{3})-([0-9]{4})))|((\+63)(([0-9]{3})([0-9]{3})([0-9]{4})))" required>
										</fieldset>
									</div>
								</div>
							</fieldset>
						</fieldset>

						<br>

						<fieldset class="padded-none margin-none margin-top-bottom">
							<legend class="rounded gold padded-left-right full-width center">
								<h2>
									Contact In Case Of Emmergency
								</h2>
							</legend>
							<fieldset class="padded-none margin-none margin-top">
								<legend>
									Contact Person
								</legend>
								<div class="equal-container">
									<div class="equal-content padded-right">
										<input class="full-width" type="text" name="student_emergency_contact_last_name" oninput="this.value = this.value.replace(/[^a-zA-Z|\-.]/g, '').replace(/(\..*)\./g, '$1').toUpperCase();" required>
										<br>
										<label for="last-name">Last Name</label>
									</div>

									<div class="equal-content padded-left-right">
										<input class="full-width" type="text" name="student_emergency_contact_first_name" oninput="this.value = this.value.replace(/[^a-zA-Z|\-.]/g, '').replace(/(\..*)\./g, '$1').toUpperCase();" required>
										<br>
										<label for="first-name">First Name</label>
									</div>

									<div class="equal-content padded-left">
										<input class="full-width" type="text" name="student_emergency_contact_middle_name" oninput="this.value = this.value.replace(/[^a-zA-Z|\-.]/g, '').replace(/(\..*)\./g, '$1').toUpperCase();" required>
										<br>
										<label for=" middle-name">Middle Name</label>
									</div>
								</div>
								<div class="margin-top">
									<fieldset class="padded-none margin-none">
										<legend>
											Contact Number
										</legend>
										<input class="full-width" type="tel" name="student_emergency_contact_contact_number" oninput="this.value = this.value.replace(/[^0-9|\-.]/g, '').replace(/(\..*)\./g, '$1');" placeholder="09XX-XXX-XXXX" pattern="(([0-9]{4})-([0-9]{3})-([0-9]{4}))|(([0-9]{4})([0-9]{3})([0-9]{4}))|((\+63)(([0-9]{3})-([0-9]{3})-([0-9]{4})))|((\+63)(([0-9]{3})([0-9]{3})([0-9]{4})))" required>
									</fieldset>
								</div>
							</fieldset>
						</fieldset>

						<br>

						<fieldset class="padded-none margin-none margin-top">
							<div class="equal-container-spaced">
								<div class="equal-content-spaced half-width">
									<button type="submit" name="submit_admission_form" class="rounded full-width">Submit</button>
								</div>
								<div class="equal-content-spaced">
									<button type="reset" class="red rounded full-width">Reset</button>
								</div>
							</div>
						</fieldset>
					</form>
				</div>
			</div>
		</div>
	</div>
</body>

</html>