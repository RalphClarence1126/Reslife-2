<?php echo '<h3>NOTE: All those marked with a red asterisk<span style="color: rgb(255, 55, 55);">*</span> is required and should be answered.</h3>'; ?>

<link rel="stylesheet" href="include/style/form-stylesheet.css">

<form method="post" action="enrollment.php" name="enrollment-form" enctype="multipart/form-data" id="student-enrollment-form" autocomplete="off">
	<!-- LEARNER INFORMATION -->
	<div class="enrollment-form">
		<fieldset>
			<legend class="form-title">LEARNER INFORMATION</legend>
			<fieldset>
				<legend>Student's Name</legend>

				<section class="horizontal-form-items" id="horizontal-items">
					<div>
						<input type="text" name="student_last_name" id="student-last-name" oninput="this.value = this.value.replace(/[^a-zA-Z|\-.]/g, '').replace(/(\..*)\./g, '$1').toUpperCase();" required>
						<br>
						<label for="student-last-name">Last Name</label>
					</div>

					<div>
						<input type="text" name="student_first_name" id="student-first-name" oninput="this.value = this.value.replace(/[^a-zA-Z|\-.]/g, '').replace(/(\..*)\./g, '$1').toUpperCase();" required>
						<br>
						<label for="student-first-name">First Name</label>
					</div>

					<div>
						<input type="text" name="student_middle_name" id="student-middle-name" oninput="this.value = this.value.replace(/[^a-zA-Z|\-.]/g, '').replace(/(\..*)\./g, '$1').toUpperCase();" required>
						<br>
						<label for=" student-middle-name">Middle Name</label>
					</div>

				</section>

				<section class="horizontal-form-items" id="horizontal-items">
					<div>
						<input type="text" name="student_suffix_name" id="student-suffix-name" placeholder="[OPTIONAL]" oninput="this.value = this.value.replace(/[^a-zA-Z|\-.]/g, '').replace(/(\..*)\./g, '$1').toUpperCase();">
						<br>
						<label for=" student-suffix-name">Suffix</label>
					</div>
				</section>
			</fieldset>

			<section class="horizontal-form">
				<fieldset>
					<legend>Student's Date of Birth</legend>

					<section id="horizontal-items">
						<div>
							<input type="text" name="student_birthdate_month" id="student-birthdate-month" placeholder="MM" pattern="[0-9]{2}" oninput="this.value = this.value.replace(/[^0-9.]/g, '').replace(/(\..*)\./g, '$1');" required>
							<br>
							<label for="student-birthdate-month">Month</label>
						</div>

						<div>
							<input type="text" name="student_birthdate_day" id="student-birthdate-day" placeholder="DD" pattern="[0-9]{2}" oninput="this.value = this.value.replace(/[^0-9.]/g, '').replace(/(\..*)\./g, '$1');" required>
							<br>
							<label for="student-birthdate-month">Day</label>
						</div>

						<div>
							<input type="text" name="student_birthdate_year" id="student-birthdate-year" placeholder="YYYY" pattern="[0-9]{4}" oninput="this.value = this.value.replace(/[^0-9.]/g, '').replace(/(\..*)\./g, '$1');" required>
							<br>
							<label for="student-birthdate-month">Year</label>
						</div>
					</section>
				</fieldset>

				<fieldset style="width: 100%;">
					<legend>Place of Birth</legend>
					<input type="text" name="student_birthplace" id="student-birthplace" oninput="this.value = this.value.toUpperCase();" required>
					<label for="student-birthplace">Address</label>
				</fieldset>
			</section>

			<section class="horizontal-form" id="horizontal-items">
				<div>
					<fieldset>
						<legend>Age</legend>
						<input type="number" name="student_age" id="student-age" min="1" max="100" oninput="this.value = this.value.replace(/[^0-9.]/g, '').replace(/(\..*)\./g, '$1');" required>
					</fieldset>
				</div>

				<div>
					<fieldset>
						<legend>Gender</legend>
						<input type="text" name="student_gender" id="student-gender" pattern="[a-zA-Z|\-]+" oninput="this.value = this.value.replace(/[^a-zA-Z|\-.]/g, '').replace(/(\..*)\./g, '$1').toUpperCase();" required>
					</fieldset>
				</div>

				<div>
					<fieldset>
						<legend>Religion</legend>
						<input type="text" name="student_religion" id="student-religion" oninput="this.value = this.value.replace(/[^a-zA-Z|\-.]/g, '').replace(/(\..*)\./g, '$1').toUpperCase();" required>
					</fieldset>
				</div>
			</section>

			<section class="horizontal-form" id="horizontal-items">
				<div style="flex-grow: 4;">
					<fieldset>
						<legend>Email Address</legend>
						<input type="email" name="student_email" id="student-email" placeholder="example@email.com" pattern="\S+@\S+\.com" oninput="this.value = this.value.toLowerCase();" required>
					</fieldset>
				</div>

				<div>
					<fieldset>
						<legend>Contact Number</legend>
						<input type="tel" name="student_contact_number" id="student-contact-number" placeholder="09XX-XXX-XXXX" pattern="(([0-9]{4})-([0-9]{3})-([0-9]{4}))|(([0-9]{4})([0-9]{3})([0-9]{4}))|((\+63)(([0-9]{3})-([0-9]{3})-([0-9]{4})))|((\+63)(([0-9]{3})([0-9]{3})([0-9]{4})))" oninput="this.value = this.value.replace(/[^0-9|\-.]/g, '').replace(/(\..*)\./g, '$1');" required>
					</fieldset>
				</div>

				<div>
					<fieldset>
						<legend>Telephone Number</legend>
						<input type="tel" name="student_telephone_number" id="student-telephone-number" placeholder="[OPTIONAL]" oninput="this.value = this.value.replace(/[^0-9|\-.]/g, '').replace(/(\..*)\./g, '$1');">
					</fieldset>
				</div>
			</section>

			<fieldset>
				<legend>Address</legend>

				<section class="horizontal-form-items" id="horizontal-items">
					<div style="flex-grow: 7;">
						<input type="text" name="student_address_street" id="student-address-street" oninput="this.value = this.value.toUpperCase();" required>
						<br>
						<label for="student-address-street">Street Address</label>
					</div>

					<div style="flex-grow: 1;">
						<input type="text" name="student_address_municipality" id="student-address-municipality" oninput="this.value = this.value.replace(/[^a-zA-Z|\-.]/g, '').replace(/(\..*)\./g, '$1').toUpperCase();" required>
						<br>
						<label for="student-address-municipality">Municipality</label>
					</div>

					<div style="flex-grow: 1;">
						<input type="text" name="student_address_province" id="student-address-province" oninput="this.value = this.value.replace(/[^a-zA-Z|\-.]/g, '').replace(/(\..*)\./g, '$1').toUpperCase();" required>
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
						<label for="student-application-grade">Application Grade</label>
						<br>
						<select name="student_application_grade" id="student-application-grade" style="width: 100%" onload="this.value = 'Default';" required>
							<option value="Default" hidden>Select Grade Level</option>
							<option value="Grade 11">Grade 11</option>
							<option value="Grade 12">Grade 12</option>
						</select>
					</div>

					<div>
						<label for="student-enrollment-status">Enrollment Status</label>
						<br>
						<select name="student_enrollment_status" id="student-enrollment-status" style="width: 100%" onload="this.value = '';" disabled>
							<option value="Default" hidden>Select Enrollment Status</option>
							<option value="New Student">New Student</option>
							<option value="Old Student">Old Student</option>
						</select>
					</div>

					<div>
						<label for="student-number">Student Number</label>
						<input type="text" name="student_number" id="student-number" pattern="[0-9]{4}-[0-9]{6}" oninput="this.value = this.value.replace(/[^0-9|\-.]/g, '').replace(/(\..*)\./g, '$1');" disabled>
					</div>
				</section>
			</fieldset>

			<fieldset>
				<legend>Strand Preference</legend>
				<select name="student_strand_preference" id="student-strand-preference" onload="this.value = 'Default';" required>
					<option value="Default" hidden>Select Strand Preference</option>
					<option value="STEM">STEM</option>
					<option value="ABM">ABM</option>
					<option value="HUMSS">HUMSS</option>
					<option value="TVL - ICT">TVL - ICT</option>
				</select>
			</fieldset>

			<fieldset>
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
				<input type="text" name="student_lrn" id="student-lrn" placeholder="123456123456" oninput="this.value = this.value.replace(/[^0-9.]/g, '').replace(/(\..*)\./g, '$1');" pattern="[0-9]{6}[0-9]{6}" required>
			</fieldset>

			<fieldset>
				<legend>Name of Former School</legend>

				<section class="horizontal-form-items" id="horizontal-items">
					<div style="flex-grow: 4;">
						<input type="text" name="student_former_school" id="student-former-school" oninput="this.value = this.value.toUpperCase();" required>
						<br>
						<label for="student-former-school">Complete School Name</label>
					</div>

				</section>

				<br>

				<section class="horizontal-form-items" id="horizontal-items">
					<div>
						<input type="text" name="student_former_school_graduate_year" id="student-former-school-graduate-year" placeholder="YYYY" pattern="[0-9]{4}" oninput="this.value = this.value.replace(/[^0-9.]/g, '').replace(/(\..*)\./g, '$1');" required>
						<br>
						<label for="student_former_school-graduate-year">Year Graduated</label>
					</div>

					<div>
						<input type="text" name="student_former_school_schoolyear" id="student-former-school-schoolyear" placeholder="YYYY-YYYY" pattern="[0-9]{4}-[0-9]{4}" oninput="this.value = this.value.replace(/[^0-9|\-.]/g, '').replace(/(\..*)\./g, '$1');" required>
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
						<input type="text" name="student_mother_last_name" id="student-mother-last-name" oninput="this.value = this.value.replace(/[^a-zA-Z|\-.]/g, '').replace(/(\..*)\./g, '$1').toUpperCase();" required>
						<br>
						<label for="last-name">Last Name</label>
					</div>

					<div>
						<input type="text" name="student_mother_first_name" id="student-mother-first-name" oninput="this.value = this.value.replace(/[^a-zA-Z|\-.]/g, '').replace(/(\..*)\./g, '$1').toUpperCase();" required>
						<br>
						<label for="first-name">First Name</label>
					</div>

					<div>
						<input type="text" name="student_mother_middle_name" id="student-mother-middle-name" oninput="this.value = this.value.replace(/[^a-zA-Z|\-.]/g, '').replace(/(\..*)\./g, '$1').toUpperCase();" required>
						<br>
						<label for=" middle-name">Middle Name</label>
					</div>
				</section>

			</fieldset>

			<section class="horizontal-form" id="horizontal-items">
				<div style="flex-grow: 5;">
					<fieldset>
						<legend>Occupation</legend>
						<input type="text" name="student_mother_occupation" id="student-mother-occupation" oninput="this.value = this.value.replace(/[^a-zA-Z|\-.]/g, '').replace(/(\..*)\./g, '$1').toUpperCase();" required>
					</fieldset>
				</div>

				<div>
					<fieldset>
						<legend>Contact Number</legend>
						<input type="tel" name="student_mother_contact_number" id="student-mother-contact-number" placeholder="09XX-XXX-XXXX" pattern="(([0-9]{4})-([0-9]{3})-([0-9]{4}))|(([0-9]{4})([0-9]{3})([0-9]{4}))|((\+63)(([0-9]{3})-([0-9]{3})-([0-9]{4})))|((\+63)(([0-9]{3})([0-9]{3})([0-9]{4})))" oninput="this.value = this.value.replace(/[^0-9|\-.]/g, '').replace(/(\..*)\./g, '$1');" required>
					</fieldset>
				</div>
			</section>

			<hr style="border-color: rgb(210, 210, 210);">

			<fieldset>
				<legend>Father's Name</legend>

				<section class="horizontal-form-items" id="horizontal-items">
					<div>
						<input type="text" name="student_father_last_name" id="student-father-last-name" oninput="this.value = this.value.replace(/[^a-zA-Z|\-.]/g, '').replace(/(\..*)\./g, '$1').toUpperCase();" required>
						<br>
						<label for="last-name">Last Name</label>
					</div>

					<div>
						<input type="text" name="student_father_first_name" id="student-father-first-name" oninput="this.value = this.value.replace(/[^a-zA-Z|\-.]/g, '').replace(/(\..*)\./g, '$1').toUpperCase();" required>
						<br>
						<label for="first-name">First Name</label>
					</div>

					<div>
						<input type="text" name="student_father_middle_name" id="student-father-middle-name" oninput="this.value = this.value.replace(/[^a-zA-Z|\-.]/g, '').replace(/(\..*)\./g, '$1').toUpperCase();" required>
						<br>
						<label for=" middle-name">Middle Name</label>
					</div>
				</section>

			</fieldset>

			<section class="horizontal-form" id="horizontal-items">
				<div style="flex-grow: 5;">
					<fieldset>
						<legend>Occupation</legend>
						<input type="text" name="student_father_occupation" id="student-father-occupation" oninput="this.value = this.value.replace(/[^a-zA-Z|\-.]/g, '').replace(/(\..*)\./g, '$1').toUpperCase();" required>
					</fieldset>
				</div>

				<div>
					<fieldset>
						<legend>Contact Number</legend>
						<input type="tel" name="student_father_contact_number" id="student-father-contact-number" placeholder="09XX-XXX-XXXX" pattern="(([0-9]{4})-([0-9]{3})-([0-9]{4}))|(([0-9]{4})([0-9]{3})([0-9]{4}))|((\+63)(([0-9]{3})-([0-9]{3})-([0-9]{4})))|((\+63)(([0-9]{3})([0-9]{3})([0-9]{4})))" oninput="this.value = this.value.replace(/[^0-9|\-.]/g, '').replace(/(\..*)\./g, '$1');" required>
					</fieldset>
				</div>
			</section>
		</fieldset>
	</div>

	<br>

	<!-- EMERGENCY CONTACT -->
	<div class="enrollment-form">
		<fieldset>
			<legend class="form-title">CONTACT IN CASE OF EMERGENCY</legend>
			<fieldset>
				<legend>Contact Name</legend>

				<section class="horizontal-form-items" id="horizontal-items">
					<div>
						<input type="text" name="student_emergency_contact_last_name" id="student-emergency-contact-last-name" oninput="this.value = this.value.replace(/[^a-zA-Z|\-.]/g, '').replace(/(\..*)\./g, '$1').toUpperCase();" required>
						<br>
						<label for="last-name">Last Name</label>
					</div>

					<div>
						<input type="text" name="student_emergency_contact_first_name" id="student-emergency-contact-first-name" oninput="this.value = this.value.replace(/[^a-zA-Z|\-.]/g, '').replace(/(\..*)\./g, '$1').toUpperCase();" required>
						<br>
						<label for="first-name">First Name</label>
					</div>

					<div>
						<input type="text" name="student_emergency_contact_middle_name" id="student-emergency-contact-middle-name" oninput="this.value = this.value.replace(/[^a-zA-Z|\-.]/g, '').replace(/(\..*)\./g, '$1').toUpperCase();" required>
						<br>
						<label for=" middle-name">Middle Name</label>
					</div>
				</section>

			</fieldset>

			<section class="horizontal-form" id="horizontal-items">
				<div>
					<fieldset>
						<legend>Contact Number</legend>
						<input type="tel" name="student_emergency_contact_contact_number" id="student-emergency-contact-contact-number" placeholder="09XX-XXX-XXXX" pattern="(([0-9]{4})-([0-9]{3})-([0-9]{4}))|(([0-9]{4})([0-9]{3})([0-9]{4}))|((\+63)(([0-9]{3})-([0-9]{3})-([0-9]{4})))|((\+63)(([0-9]{3})([0-9]{3})([0-9]{4})))" oninput="this.value = this.value.replace(/[^0-9|\-.]/g, '').replace(/(\..*)\./g, '$1');" required>
					</fieldset>
				</div>
			</section>
		</fieldset>
		</fieldset>
	</div>

	<hr>

	<div class="bottom-sticky">
		<input type="button" id="reset" value="Reset Form" onclick="verifyReset()">
		<button type="submit">Submit</button>
	</div>
</form>

<script src="include/scripts/validations.js"></script>
<script src="include/scripts/student-application-details-script.js"></script>