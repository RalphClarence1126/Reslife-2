<?php
require('../../database/config.php');


session_start();
?>


<div class="margin-top">
	<div class="blue padded rounded-top">
		<h4>
			Admission Form
		</h4>
	</div>
	<div class="white padded rounded-bottom">
		<form action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>" method="post" enctype="multipart/form-data" autocomplete="off">
			<fieldset class="padded-none margin-none margin-bottom">
				<legend class="rounded gold padded-left-right full-width center">
					<h5>
						Learner Information
					</h5>
				</legend>

				<fieldset class="padded-none margin-none margin-top">
					<legend>
						Student's Name
					</legend>
					<div class="equal-container">
						<div class="equal-content padded-right">
							<input class="full-width" type="text" name="std_lname" id="std_lname" oninput="this.value = this.value.toUpperCase();" disabled>
							<br>
							<label for="std_lname">Last Name</label>
						</div>
						<div class="equal-content padded-left-right">
							<input class="full-width" type="text" name="std_fname" id="std_fname" oninput="this.value = this.value.toUpperCase();" disabled>
							<br>
							<label for="std_fname">First Name</label>
						</div>
						<div class="equal-content padded-left-right">
							<input class="full-width" type="text" name="std_mname" id="std_mname" oninput="this.value = this.value.toUpperCase();" disabled>
							<br>
							<label for="std_mname">Middle Name</label>
						</div>
						<div class="equal-content padded-left">
							<input class="full-width" type="text" name="std_suffix" id="std_suffix" oninput="this.value = this.value.toUpperCase();" placeholder="[OPTIONAL]">
							<br>
							<label for="std_suffix">Suffix</label>
						</div>
					</div>
				</fieldset>
				<fieldset class="padded-none margin-none margin-top">
					<legend>
						Student's Date of Birth
					</legend>
					<div class="equal-container">
						<div class="equal-content padded-right">
							<input class="full-width" type="text" name="std_birth_moth" id="std_birth_moth" oninput="this.value = this.value.replace(/[^0-9.]/g, '').replace(/(\..*)\./g, '$1');" pattern="[0-9]{2}" placeholder="MM" disabled>
							<br>
							<label for="std_birth_moth">Month</label>
						</div>
						<div class="equal-content padded-left-right">
							<input class="full-width" type="text" name="std_birth_day" id="std_birth_day" oninput="this.value = this.value.replace(/[^0-9.]/g, '').replace(/(\..*)\./g, '$1');" pattern="[0-9]{2}" placeholder="DD" disabled>
							<br>
							<label for="std_birth_day">Day</label>
						</div>
						<div class="equal-content padded-left">
							<input class="full-width" type="text" name="std_birth_year" id="std_birth_year" oninput="this.value = this.value.replace(/[^0-9.]/g, '').replace(/(\..*)\./g, '$1');" pattern="[0-9]{4}" placeholder="YYYY" disabled>
							<br>
							<label for="std_birth_year">Year</label>
						</div>
					</div>
				</fieldset>
				<fieldset class="padded-none margin-none margin-top">
					<legend>
						Place of Birth
					</legend>
					<input class="full-width" type="text" name="std_birth_address" id="std_birth_address" oninput="this.value = this.value.toUpperCase();" disabled>
					<label for="std_birth_address">Address</label>
				</fieldset>
				<div class="equal-container margin-top">
					<div class="equal-content padded-right">
						<fieldset class="padded-none margin-none">
							<legend>
								Age
							</legend>
							<input class="full-width" type="number" name="std_age" id="std_age" oninput="this.value = this.value.replace(/[^0-9.]/g, '').replace(/(\..*)\./g, '$1');" min="1" max="100" disabled>
						</fieldset>
					</div>
					<div class="equal-content padded-left-right">
						<fieldset class="padded-none margin-none">
							<legend>
								Gender
							</legend>
							<input class="full-width" type="text" name="std_gender" id="std_gender" oninput="this.value = this.value.replace(/[^a-zA-Z|\-.]/g, '').replace(/(\..*)\./g, '$1').toUpperCase();" pattern="[a-zA-Z|\-]+" disabled>
						</fieldset>
					</div>
					<div class="equal-content padded-left">
						<fieldset class="padded-none margin-none">
							<legend>
								Religion
							</legend>
							<input class="full-width" type="text" name="std_religion" id="std_religion" oninput="this.value = this.value.replace(/[^a-zA-Z|\-.]/g, '').replace(/(\..*)\./g, '$1').toUpperCase();" disabled>
						</fieldset>
					</div>
				</div>
				<div class="equal-container margin-top">
					<div class="equal-content padded-right">
						<fieldset class="padded-none margin-none">
							<legend>
								Email Address
							</legend>
							<input class="full-width" type="email" name="std_email" id="std_email" oninput="this.value = this.value.toLowerCase();" placeholder="example@email.com" pattern="\S+@\S+\.com" disabled>
						</fieldset>
					</div>
					<div class="equal-content padded-left-right">
						<fieldset class="padded-none margin-none">
							<legend>
								Contact Number
							</legend>
							<input class="full-width" type="tel" name="std_contact" id="std_contact" oninput="this.value = this.value.replace(/[^0-9|\-.]/g, '').replace(/(\..*)\./g, '$1');" placeholder="09XX-XXX-XXXX" pattern="(([0-9]{4})-([0-9]{3})-([0-9]{4}))|(([0-9]{4})([0-9]{3})([0-9]{4}))|((\+63)(([0-9]{3})-([0-9]{3})-([0-9]{4})))|((\+63)(([0-9]{3})([0-9]{3})([0-9]{4})))" disabled>
						</fieldset>
					</div>
					<div class="equal-content padded-left">
						<fieldset class="padded-none margin-none">
							<legend>
								Telephone Number
							</legend>
							<input class="full-width" type="tel" name="std_tel_number" id="std_tel_number" oninput="this.value = this.value.replace(/[^0-9|\-.]/g, '').replace(/(\..*)\./g, '$1');" placeholder="[OPTIONAL]">
						</fieldset>
					</div>
				</div>
				<fieldset class="padded-none margin-none margin-top">
					<legend>
						Current Address
					</legend>
					<input class="full-width" type="text" name="std_birthplace" id="std_birthplace" oninput="this.value = this.value.toUpperCase();">
				</fieldset>
			</fieldset>

			<br>

			<fieldset class="padded-none margin-none margin-top-bottom">
				<legend class="rounded gold padded-left-right full-width center">
					<h5>
						Application Details
					</h5>
				</legend>
				<div class="margin-top">
					<fieldset class="padded-none margin-none">
						<legend>
							Application Grade
						</legend>
						<select class="full-width white" name="std_grade_level" id="std_grade_level" onload="this.value = 'Default';" disabled>
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
							Student Status
						</legend>
						<select class="full-width white" name="std_student_status" id="std_student_status" onload="this.value = '';">
							<option value="Default" hidden>
								Select Student Status
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
						<input class="full-width" type="text" name="std_std_number" id="std_std_number" oninput="this.value = this.value.replace(/[^0-9|\-.]/g, '').replace(/(\..*)\./g, '$1');" placeholder="XXXX-XXXXXX" pattern="[0-9]{4}-[0-9]{6}">
						<br>
						<label for="std_std_number">Student Number</label>
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
								<div class="center">
									<img src="<?php echo $admissions_student_picture ?>" alt="Student Picture" width="200" height="200">
								</div>
								<br>
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
								<br>
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
								<br>
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
								<br>
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
					<h5>
						Educational Background
					</h5>
				</legend>
				<fieldset class="padded-none margin-none margin-top">
					<legend>
						Learner Reference Number (LRN)
					</legend>
					<input class="full-width" type="text" name="std_std_lrn" id="std_std_lrn" oninput="this.value = this.value.replace(/[^0-9.]/g, '').replace(/(\..*)\./g, '$1');" placeholder="123456123456" pattern="[0-9]{6}[0-9]{6}" disabled>
				</fieldset>
				<fieldset class="padded-none margin-none margin-top">
					<legend>
						Name of Former School
					</legend>
					<input class="full-width" type="text" name="std_former_school" id="std_former_school" oninput="this.value = this.value.toUpperCase();" disabled>
					<br>
					<label for="std_former_school">Complete School Name</label>

					<div class="equal-container margin-top">
						<div class="equal-content padded-right">
							<input class="full-width" type="text" name="std_former_graduate_year" id="std_former_graduate_year" oninput="this.value = this.value.replace(/[^0-9.]/g, '').replace(/(\..*)\./g, '$1');" placeholder="YYYY" pattern="[0-9]{4}" disabled>
							<br>
							<label for="std_former_graduate_year">Year Graduated</label>
						</div>
						<div class="equal-content padded-left">
							<input class="full-width" type="text" name="std_former_school_year" id="std_former_school_year" oninput="this.value = this.value.replace(/[^0-9|\-.]/g, '').replace(/(\..*)\./g, '$1');" placeholder="YYYY-YYYY" pattern="[0-9]{4}-[0-9]{4}" disabled>
							<br>
							<label for="std_former_school_year">School Year</label>
						</div>
					</div>
				</fieldset>
			</fieldset>

			<br>

			<fieldset class="padded-none margin-none margin-top-bottom">
				<legend class="rounded gold padded-left-right full-width center">
					<h5>
						Parent Information
					</h5>
				</legend>
				<fieldset class="padded-none margin-none margin-top">
					<legend>
						Mother's Name
					</legend>
					<div class="equal-container">
						<div class="equal-content padded-right">
							<input class="full-width" type="text" name="std_mother_lname" id="std_mother_lname" oninput="this.value = this.value.toUpperCase();" disabled>
							<br>
							<label for="std_mother_lname">Last Name</label>
						</div>

						<div class="equal-content padded-left-right">
							<input class="full-width" type="text" name="std_mother_fname" id="std_mother_fname" oninput="this.value = this.value.toUpperCase();" disabled>
							<br>
							<label for="std_mother_fname">First Name</label>
						</div>

						<div class="equal-content padded-left">
							<input class="full-width" type="text" name="std_mother_mname" id="std_mother_mname" oninput="this.value = this.value.toUpperCase();" disabled>
							<br>
							<label for="std_mother_mname">Middle Name</label>
						</div>
					</div>
					<div class="equal-container margin-top">
						<div class="equal-content padded-right">
							<fieldset class="padded-none margin-none">
								<legend>
									Occupation
								</legend>
								<input class="full-width" type="text" name="std_mother_occupation" id="std_mother_occupation" oninput="this.value = this.value.toUpperCase();" disabled>
							</fieldset>
						</div>
						<div class="equal-content padded-left">
							<fieldset class="padded-none margin-none">
								<legend>
									Contact Number
								</legend>
								<input class="full-width" type="tel" name="std_mother_contact" id="std_mother_contact" oninput="this.value = this.value.replace(/[^0-9|\-.]/g, '').replace(/(\..*)\./g, '$1');" placeholder="09XX-XXX-XXXX" pattern="(([0-9]{4})-([0-9]{3})-([0-9]{4}))|(([0-9]{4})([0-9]{3})([0-9]{4}))|((\+63)(([0-9]{3})-([0-9]{3})-([0-9]{4})))|((\+63)(([0-9]{3})([0-9]{3})([0-9]{4})))" disabled>
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
							<input class="full-width" type="text" name="std_father_lname" id="std_father_lname" oninput="this.value = this.value.toUpperCase();" disabled>
							<br>
							<label for="std_father_lname">Last Name</label>
						</div>

						<div class="equal-content padded-left-right">
							<input class="full-width" type="text" name="std_father_fname" id="std_father_fname" oninput="this.value = this.value.toUpperCase();" disabled>
							<br>
							<label for="std_father_fname">First Name</label>
						</div>

						<div class="equal-content padded-left">
							<input class="full-width" type="text" name="std_father_mname" id="std_father_mname" oninput="this.value = this.value.toUpperCase();" disabled>
							<br>
							<label for=" std_father_mname">Middle Name</label>
						</div>
					</div>
					<div class="equal-container margin-top">
						<div class="equal-content padded-right">
							<fieldset class="padded-none margin-none">
								<legend>
									Occupation
								</legend>
								<input class="full-width" type="text" name="std_father_occupation" id="std_father_occupation" oninput="this.value = this.value.toUpperCase();" disabled>
							</fieldset>
						</div>
						<div class="equal-content padded-left">
							<fieldset class="padded-none margin-none">
								<legend>
									Contact Number
								</legend>
								<input class="full-width" type="tel" name="std_father_contact" id="std_father_contact" oninput="this.value = this.value.replace(/[^0-9|\-.]/g, '').replace(/(\..*)\./g, '$1');" placeholder="09XX-XXX-XXXX" pattern="(([0-9]{4})-([0-9]{3})-([0-9]{4}))|(([0-9]{4})([0-9]{3})([0-9]{4}))|((\+63)(([0-9]{3})-([0-9]{3})-([0-9]{4})))|((\+63)(([0-9]{3})([0-9]{3})([0-9]{4})))" disabled>
							</fieldset>
						</div>
					</div>
				</fieldset>
			</fieldset>

			<br>

			<fieldset class="padded-none margin-none margin-top-bottom">
				<legend class="rounded gold padded-left-right full-width center">
					<h5>
						Contact In Case Of Emmergency
					</h5>
				</legend>
				<fieldset class="padded-none margin-none margin-top">
					<legend>
						Contact Person
					</legend>
					<div class="equal-container">
						<div class="equal-content padded-right">
							<input class="full-width" type="text" name="std_emergency_contact_lname" id="std_emergency_contact_lname" oninput="this.value = this.value.toUpperCase();" disabled>
							<br>
							<label for="std_emergency_contact_lname">Last Name</label>
						</div>

						<div class="equal-content padded-left-right">
							<input class="full-width" type="text" name="std_emergency_contact_fname" id="std_emergency_contact_fname" oninput="this.value = this.value.toUpperCase();" disabled>
							<br>
							<label for="std_emergency_contact_fname">First Name</label>
						</div>

						<div class="equal-content padded-left">
							<input class="full-width" type="text" name="std_emergency_contact_mname" id="std_emergency_contact_mname" oninput="this.value = this.value.toUpperCase();" disabled>
							<br>
							<label for="stds_emergency_contact_mname">Middle Name</label>
						</div>
					</div>
					<div class="margin-top">
						<fieldset class="padded-none margin-none">
							<legend>
								Contact Number
							</legend>
							<input class="full-width" type="tel" name="std_emergency_contact_contact" id="std_emergency_contact_contact" oninput="this.value = this.value.replace(/[^0-9|\-.]/g, '').replace(/(\..*)\./g, '$1');" placeholder="09XX-XXX-XXXX" pattern="(([0-9]{4})-([0-9]{3})-([0-9]{4}))|(([0-9]{4})([0-9]{3})([0-9]{4}))|((\+63)(([0-9]{3})-([0-9]{3})-([0-9]{4})))|((\+63)(([0-9]{3})([0-9]{3})([0-9]{4})))" disabled>
						</fieldset>
					</div>
				</fieldset>
			</fieldset>
		</form>
	</div>
</div>
