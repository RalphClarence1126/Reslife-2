<head>
	<link rel="stylesheet" href="include/style/form-stylesheet.css">
</head>

<form method="post" action="enrollment.php" name="enrollment-form" enctype="multipart/form-data" id="student-enrollment-form">
	<!-- LEARNER INFORMATION -->
	<div class="enrollment-form">
		<fieldset>
			<legend class="form-title">LEARNER INFORMATION</legend>
			<fieldset>
				<legend>Student's Name</legend>

				<section class="horizontal-form-items" id="horizontal-items">
					<div>
						<input type="text" name="student_last_name" id="student-last-name" required>
						<br>
						<label for="last-name">Last Name</label>
					</div>

					<div>
						<input type="text" name="student_first_name" id="student-first-name" required>
						<br>
						<label for="first-name">First Name</label>
					</div>

					<div>
						<input type="text" name="student_middle_name" id="student-middle-name" required>
						<br>
						<label for=" middle-name">Middle Name</label>
					</div>
				</section>
			</fieldset>

			<section class="horizontal-form">
				<fieldset>
					<legend>Student's Date of Birth</legend>

					<section id="horizontal-items">
						<div>
							<input type="text" name="student_birthdate_month" id="student-birthdate-month" required>
							<br>
							<label for="student-birthdate-month">Month</label>
						</div>

						<div>
							<input type="text" name="student_birthdate_day" id="student-birthdate-day" required>
							<br>
							<label for="student-birthdate-month">Day</label>
						</div>

						<div>
							<input type="text" name="student_birthdate_year" id="student-birthdate-year" required>
							<br>
							<label for="student-birthdate-month">Year</label>
						</div>
					</section>
				</fieldset>

				<fieldset style="width: 100%;">
					<legend>Place of Birth</legend>
					<input type="text" name="student_birthplace" id="student-birthplace" required>
					<br>
					<label for="student-birthplace">Address</label>
				</fieldset>
			</section>

			<section class="horizontal-form" id="horizontal-items">
				<div>
					<fieldset>
						<legend>Age</legend>
						<input type="number" name="student_age" id="student-age" required>
					</fieldset>
				</div>

				<div>
					<fieldset>
						<legend>Gender</legend>
						<input type="text" name="student_gender" id="student-gender" required>
					</fieldset>
				</div>

				<div>
					<fieldset>
						<legend>Religion</legend>
						<input type="text" name="student_religion" id="student-religion" required>
					</fieldset>
				</div>
			</section>

			<section class="horizontal-form" id="horizontal-items">
				<div style="flex-grow: 4;">
					<fieldset>
						<legend>Email Address</legend>
						<input type="email" name="student_email" id="student-email" required>
					</fieldset>
				</div>

				<div>
					<fieldset>
						<legend>Contact Number</legend>
						<input type="tel" name="student_contact_number" id="student-contact-number" required>
					</fieldset>
				</div>

				<div>
					<fieldset>
						<legend>Telephone Number</legend>
						<input type="tel" name="student_telephone_number" id="student-telephone-number">
					</fieldset>
				</div>
			</section>

			<fieldset>
				<legend>Address</legend>

				<section class="horizontal-form-items" id="horizontal-items">
					<div style="flex-grow: 7;">
						<input type="text" name="student_address_street" id="student-address-street" required>
						<br>
						<label for="student-address-street">Street Address</label>
					</div>

					<div style="flex-grow: 1;">
						<input type="text" name="student_address_municipality" id="student-address-municipality" required>
						<br>
						<label for="student-address-municipality">Municipality</label>
					</div>

					<div style="flex-grow: 1;">
						<input type="text" name="student_address_province" id="student-address-province" required>
						<br>
						<label for="student-address-province">Province</label>
					</div>
				</section>
			</fieldset>
		</fieldset>
	</div>

	<br>

	<!-- APPLICATION DETAILS -->
	<div class="enrollment-form">
		<fieldset>
			<legend class="form-title">APPLICATION DETAILS</legend>
			<fieldset>
				<legend>Application Type</legend>

				<section class="horizontal-form-items" id="horizontal-items">
					<div>
						<label for="student-application-grade">Application Grade<span style="color: rgb(255, 55, 55);">*</span></label>
						<br>
						<select name="student_application_grade" id="student-application-grade" required>
							<option value="Grade 11">Grade 11</option>
							<option value="Grade 11">Grade 12</option>
						</select>
					</div>

					<!-- <div style="display: flex; flex-direction: column;">
						<section style="flex: auto;">
							<input type="radio" name="student_application_grade_11" id="student-application-grade-11">
							<label for="student-application-grade-11">Grade 11</label>
						</section>

						<section style="flex: auto;">
							<input type="radio" name="student_application_grade_12" id="student-application-grade-12">
							<label for="student-application-grade-12">Grade 12</label>
						</section>
					</div> -->

					<div>
						<label for="student-enrollment-status">Enrollment Status<span style="color: rgb(255, 55, 55);">*</span></label>
						<br>
						<select name="student_application_grade" id="student-application-grade" required>
							<option value="New Student">New Student</option>
							<option value="Old Student">Old Student</option>
						</select>
					</div>

					<div>
						<label for="student-enrollment-status">Student Number</label>
						<input type="text" name="student_enrollment_status" id="student-enrollment-status" required>
					</div>
				</section>
			</fieldset>

			<fieldset>
				<legend>Strand Preference<span style="color: rgb(255, 55, 55);">*</span></legend>
				<select name="student_student_number" id="student-number" required>
					<option value="Science, Technology, Engineering, and Mathematics (STEM)">Science, Technology, Engineering, and Mathematics (STEM)</option>
					<option value="Accountancy, Business, and Management (ABM)">Accountancy, Business, and Management (ABM)</option>
					<option value="Huanities and Social Sciences (HUMSS)">Huanities and Social Sciences (HUMSS)</option>
					<option value="TVL - Information and Communication Technology (ICT)">TVL - Information and Communication Technology (ICT)</option>
				</select>
			</fieldset>

			<fieldset>
				<!-- <legend>Additional Files</legend> -->
				<ul>
					<label for="student-additional-files">Please upload a soft copy of the following:</label>
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

				<section class="horizontal-form-items" id="horizontal-items">
					<div style="flex: auto; width: 50%;">
						<label for="student-picture">Upload your 2x2 picture here:</label>
						<input type="file" name="student_picture" id="student-picture" required>
					</div>

					<div style="flex: auto; width: 50%;">
						<label for="student-psa">Upload your PSA here:</label>
						<input type="file" name="student_psa" id="student-psa" required>
					</div>
				</section>

				<br>

				<section class="horizontal-form-items" id="horizontal-items">
					<div style="flex: auto; width: 50%;">
						<label for="student-good-moral">Upload your Good Moral here:</label>
						<input type="file" name="student_good_moral" id="student-good-moral" required>
					</div>

					<div style="flex: auto; width: 50%;">
						<label for="student-form-137">Upload your Form 137 here:</label>
						<input type="file" name="student_form_137" id="student-form-137" required>
					</div>
				</section>
			</fieldset>
		</fieldset>
	</div>

	<br>

	<!-- EDUCATIONAL BACKGROUND -->
	<div class="enrollment-form">
		<fieldset>
			<legend class="form-title">EDUCATIONAL BACKGROUND</legend>
			<fieldset>
				<legend>Learner Reference Number (LRN)</legend>
				<input type="text" name="student_lrn" id="student-lrn" required>
			</fieldset>

			<fieldset>
				<legend>Name of Former School</legend>

				<section class="horizontal-form-items" id="horizontal-items">
					<div style="flex-grow: 4;">
						<input type="text" name="student_former_school" id="student-former-school" required>
						<br>
						<label for="student-former-school">Complete School Name</label>
					</div>

				</section>

				<br>

				<section class="horizontal-form-items" id="horizontal-items">
					<div>
						<input type="text" name="student_former_school_graduate_year" id="student-former-school-graduate-year" required>
						<br>
						<label for="student_former_school-graduate-year">Year Graduated</label>
					</div>

					<div>
						<input type="text" name="student_former_school_schoolyear" id="student-former-school-schoolyear" required>
						<br>
						<label for="student-former-school-schoolyear">School Year</label>
					</div>
				</section>
			</fieldset>
		</fieldset>
	</div>

	<br>

	<!-- PARENT INFORMATION -->
	<div class="enrollment-form">
		<fieldset>
			<legend class="form-title">PARENT INFORMATION</legend>
			<fieldset>
				<legend>Mother's Name</legend>

				<section class="horizontal-form-items" id="horizontal-items">
					<div>
						<input type="text" name="student_mother_last_name" id="student-mother-last-name" required>
						<br>
						<label for="last-name">Last Name</label>
					</div>

					<div>
						<input type="text" name="student_mother_first_name" id="student-mother-first-name" required>
						<br>
						<label for="first-name">First Name</label>
					</div>

					<div>
						<input type="text" name="student_mother_middle_name" id="student-mother-middle-name" required>
						<br>
						<label for=" middle-name">Middle Name</label>
					</div>
				</section>

			</fieldset>

			<section class="horizontal-form" id="horizontal-items">
				<div style="flex-grow: 5;">
					<fieldset>
						<legend>Occupation</legend>
						<input type="text" name="student_mother_occupation" id="student-mother-occupation" required>
					</fieldset>
				</div>

				<div>
					<fieldset>
						<legend>Contact Number</legend>
						<input type="tel" name="student_mother_contact_number" id="student-mother-contact-number" required>
					</fieldset>
				</div>
			</section>

			<hr style="border-color: rgb(210, 210, 210);">

			<fieldset>
				<legend>Father's Name</legend>

				<section class="horizontal-form-items" id="horizontal-items">
					<div>
						<input type="text" name="student_father_last_name" id="student-father-last-name" required>
						<br>
						<label for="last-name">Last Name</label>
					</div>

					<div>
						<input type="text" name="student_father_first_name" id="student-father-first-name" required>
						<br>
						<label for="first-name">First Name</label>
					</div>

					<div>
						<input type="text" name="student_father_middle_name" id="student-father-middle-name" required>
						<br>
						<label for=" middle-name">Middle Name</label>
					</div>
				</section>

			</fieldset>

			<section class="horizontal-form" id="horizontal-items">
				<div style="flex-grow: 5;">
					<fieldset>
						<legend>Occupation</legend>
						<input type="text" name="student_father_occupation" id="student-father-occupation" required>
					</fieldset>
				</div>

				<div>
					<fieldset>
						<legend>Contact Number</legend>
						<input type="tel" name="student_father_contact_number" id="student-father-contact-number" required>
					</fieldset>
				</div>
			</section>
		</fieldset>
	</div>

	<br>

	<!-- CONTACT IN CASE OF EMERGENCY -->
	<div class="enrollment-form">
		<fieldset>
			<legend class="form-title">CONTACT IN CASE OF EMERGENCY</legend>
			<fieldset>
				<legend>Contact Name</legend>

				<section class="horizontal-form-items" id="horizontal-items">
					<div>
						<input type="text" name="student_emergency_contact_last_name" id="student-emergency-contact-last-name" required>
						<br>
						<label for="last-name">Last Name</label>
					</div>

					<div>
						<input type="text" name="student_emergency_contact_first_name" id="student-emergency-contact-first-name" required>
						<br>
						<label for="first-name">First Name</label>
					</div>

					<div>
						<input type="text" name="student_emergency_contact_middle_name" id="student-emergency-contact-middle-name" required>
						<br>
						<label for=" middle-name">Middle Name</label>
					</div>
				</section>

			</fieldset>

			<section class="horizontal-form" id="horizontal-items">
				<div>
					<fieldset>
						<legend>Contact Number</legend>
						<input type="tel" name="student_emergency_contact_contact_number" id="student-emergency-contact-contact-number" required>
					</fieldset>
				</div>
			</section>
		</fieldset>
		</fieldset>
	</div>

	<hr>

	<input type="button" id="reset" value="Reset Form" onclick="verifyReset()">

	<button type="submit">Submit</button>
</form>

<script>
	function verifyReset() {
		if (confirm("Are you sure to reset your enrollment form?")) {
			alert("Will now reset your enrollment form...");
			document.getElementById("student-enrollment-form").reset();
		} else {
			alert("Please continue filling up your enrollment form...");
		};
	}
</script>