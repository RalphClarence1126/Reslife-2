<?php
require('../../database/config.php');


session_start();
?>


<div class="margin-top-bottom padded rounded bordered unselectable">
	<form action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>" method="post" enctype="multipart/form-data" autocomplete="off">
		<fieldset class="padded-none margin-none margin-bottom">
			<legend class="padded-left-right full-width center">
				<h4>Learner Information</h4>
			</legend>

			<fieldset class="padded-none margin-none margin-top">
				<legend>Student's Name</legend>
				<div class="equal-container">
					<div class="equal-content padded-right">
						<input class="full-width" type="text" name="std_lname" id="std_lname" value="<?php
																										$retval = $mysqli->query("SELECT stds_lname FROM stds WHERE stds_acc_id = '$admissions_student_account_id'")->fetch_object()->stds_lname;
																										echo $retval;
																										?>" disabled>
						<br>
						<label for="std_lname">Last Name</label>
					</div>
					<div class="equal-content padded-left-right">
						<input class="full-width" type="text" name="std_fname" id="std_fname" value="<?php
																										$retval = $mysqli->query("SELECT stds_fname FROM stds WHERE stds_acc_id = '$admissions_student_account_id'")->fetch_object()->stds_fname;
																										echo $retval;
																										?>" disabled>
						<br>
						<label for="std_fname">First Name</label>
					</div>
					<div class="equal-content padded-left-right">
						<input class="full-width" type="text" name="std_mname" id="std_mname" value="<?php
																										$retval = $mysqli->query("SELECT stds_mname FROM stds WHERE stds_acc_id = '$admissions_student_account_id'")->fetch_object()->stds_mname;
																										echo $retval;
																										?>" disabled>
						<br>
						<label for="std_mname">Middle Name</label>
					</div>
					<div class="equal-content padded-left">
						<input class="full-width" type="text" name="std_suffix" id="std_suffix" value="<?php
																										$retval = $mysqli->query("SELECT stds_suffix FROM stds WHERE stds_acc_id = '$admissions_student_account_id'")->fetch_object()->stds_suffix;
																										echo $retval;
																										?>" disabled>
						<br>
						<label for="std_suffix">Suffix</label>
					</div>
				</div>
			</fieldset>
			<fieldset class="padded-none margin-none margin-top">
				<legend>Student's Date of Birth</legend>
				<div class="equal-container">
					<div class="equal-content padded-right">
						<input class="full-width" type="text" name="std_birth_moth" id="std_birth_moth" value="<?php
																												$retval = $mysqli->query("SELECT stds_birth_month FROM stds WHERE stds_acc_id = '$admissions_student_account_id'")->fetch_object()->stds_birth_month;
																												echo $retval;
																												?>" disabled>
						<br>
						<label for="std_birth_moth">Month</label>
					</div>
					<div class="equal-content padded-left-right">
						<input class="full-width" type="text" name="std_birth_day" id="std_birth_day" value="<?php
																												$retval = $mysqli->query("SELECT stds_birth_day FROM stds WHERE stds_acc_id = '$admissions_student_account_id'")->fetch_object()->stds_birth_day;
																												echo $retval;
																												?>" disabled>
						<br>
						<label for="std_birth_day">Day</label>
					</div>
					<div class="equal-content padded-left">
						<input class="full-width" type="text" name="std_birth_year" id="std_birth_year" value="<?php
																												$retval = $mysqli->query("SELECT stds_birth_year FROM stds WHERE stds_acc_id = '$admissions_student_account_id'")->fetch_object()->stds_birth_year;
																												echo $retval;
																												?>" disabled>
						<br>
						<label for="std_birth_year">Year</label>
					</div>
				</div>
			</fieldset>
			<fieldset class="padded-none margin-none margin-top">
				<legend>Place of Birth</legend>
				<input class="full-width" type="text" name="std_birth_address" id="std_birth_address" value="<?php
																												$retval = $mysqli->query("SELECT stds_birth_address FROM stds_frm_addm WHERE stds_acc_id = '$admissions_student_account_id'")->fetch_object()->stds_birth_address;
																												echo $retval;
																												?>" disabled>
				<label for="std_birth_address">Address</label>
			</fieldset>
			<div class="equal-container margin-top">
				<div class="equal-content padded-right">
					<fieldset class="padded-none margin-none">
						<legend>Age</legend>
						<input class="full-width" type="text" name="std_age" id="std_age" value="<?php
																									$retval = $mysqli->query("SELECT stds_age FROM stds WHERE stds_acc_id = '$admissions_student_account_id'")->fetch_object()->stds_age;
																									echo $retval;
																									?>" disabled>
					</fieldset>
				</div>
				<div class="equal-content padded-left-right">
					<fieldset class="padded-none margin-none">
						<legend>Gender</legend>
						<input class="full-width" type="text" name="std_gender" id="std_gender" value="<?php
																										$retval = $mysqli->query("SELECT stds_gender FROM stds WHERE stds_acc_id = '$admissions_student_account_id'")->fetch_object()->stds_gender;
																										echo $retval;
																										?>" disabled>
					</fieldset>
				</div>
				<div class="equal-content padded-left">
					<fieldset class="padded-none margin-none">
						<legend>Religion</legend>
						<input class="full-width" type="text" name="std_religion" id="std_religion" value="<?php
																											$retval = $mysqli->query("SELECT stds_regligion FROM stds WHERE stds_acc_id = '$admissions_student_account_id'")->fetch_object()->stds_regligion;
																											echo $retval;
																											?>" disabled>
					</fieldset>
				</div>
			</div>
			<div class="equal-container margin-top">
				<div class="equal-content padded-right">
					<fieldset class="padded-none margin-none">
						<legend>Email Address</legend>
						<input class="full-width" type="email" name="std_email" id="std_email" value="<?php
																										$retval = $mysqli->query("SELECT stds_email FROM stds WHERE stds_acc_id = '$admissions_student_account_id'")->fetch_object()->stds_email;
																										echo $retval;
																										?>" disabled>
					</fieldset>
				</div>
				<div class="equal-content padded-left-right">
					<fieldset class="padded-none margin-none">
						<legend>Contact Number</legend>
						<input class="full-width" type="tel" name="std_contact" id="std_contact" value="<?php
																										$retval = $mysqli->query("SELECT stds_contact FROM stds WHERE stds_acc_id = '$admissions_student_account_id'")->fetch_object()->stds_contact;
																										echo $retval;
																										?>" disabled>
					</fieldset>
				</div>
				<div class="equal-content padded-left">
					<fieldset class="padded-none margin-none">
						<legend>Telephone Number</legend>
						<input class="full-width" type="tel" name="std_tel_number" id="std_tel_number" value="<?php
																												$retval = $mysqli->query("SELECT stds_tel_number FROM stds_frm_addm WHERE stds_acc_id = '$admissions_student_account_id'")->fetch_object()->stds_tel_number;
																												echo $retval;
																												?>" disabled>
					</fieldset>
				</div>
			</div>
			<fieldset class="padded-none margin-none margin-top">
				<legend>Current Address</legend>
				<input class="full-width" type="text" name="std_birthplace" id="std_birthplace" value="<?php
																										$retval = $mysqli->query("SELECT stds_address FROM stds WHERE stds_acc_id = '$admissions_student_account_id'")->fetch_object()->stds_address;
																										echo $retval;
																										?>" disabled>
			</fieldset>
		</fieldset>

		<br>

		<fieldset class="padded-none margin-none margin-top-bottom">
			<legend class="padded-left-right full-width center">
				<h4>Application Details</h4>
			</legend>
			<div class="margin-top">
				<div class="equal-container">
					<div class="equal-content padded-right">
						<fieldset class="padded-none margin-none">
							<legend>Student Grade</legend>
							<input class="full-width white" name="std_grade_level" id="std_grade_level" value="<?php
																												$retval = $mysqli->query("SELECT stds_grade_level FROM stds_frm_addm WHERE stds_acc_id = '$admissions_student_account_id'")->fetch_object()->stds_grade_level;
																												echo $retval;
																												?>" disabled>
						</fieldset>
					</div>
					<div class="equal-content padded-left">
						<fieldset class="padded-none margin-none">
							<legend>Student Strand</legend>
							<input class="full-width white" name="std_admission_strand" id="std_admission_strand" value="<?php
																															$retval = $mysqli->query("SELECT stds_admission_strand FROM stds_frm_addm WHERE stds_acc_id = '$admissions_student_account_id'")->fetch_object()->stds_admission_strand;
																															echo $retval;
																															?>" disabled>
						</fieldset>
					</div>
				</div>
			</div>
			<div class="margin-top">
				<fieldset class="padded-none margin-none">
					<legend>Student Status</legend>
					<input class="full-width white" name="std_student_status" id="std_student_status" value="<?php
																												$retval = $mysqli->query("SELECT stds_student_status FROM stds_frm_addm WHERE stds_acc_id = '$admissions_student_account_id'")->fetch_object()->stds_student_status;
																												echo $retval;
																												?>" disabled>
				</fieldset>
			</div>
			<div class="margin-top">
				<fieldset class="padded-none margin-none">
					<input class="full-width" type="text" name="std_std_number" id="std_std_number" value="<?php
																											$retval = $mysqli->query("SELECT stds_std_number FROM stds_frm_addm WHERE stds_acc_id = '$admissions_student_account_id'")->fetch_object()->stds_std_number;
																											echo $retval;
																											?>" disabled>
					<br>
					<label for="std_std_number">Student Number</label>
				</fieldset>
			</div>
			<div class="margin-top">
				<div class="equal-container">
					<div class="equal-content padded-right">
						<fieldset class="padded-none margin-none">
							<legend>2x2 picture</legend>
							<div class="full-width center">
								<a class="full-width rounded bordered button-link" href="<?php
																							$retval = $mysqli->query("SELECT stds_2x2_pic FROM stds_frm_addm WHERE stds_acc_id = '$admissions_student_account_id'")->fetch_object()->stds_2x2_pic;
																							echo $retval;
																							?>" target="_blank" type="image/*" rel="noopener noreferrer nofollow external">View Student 2x2</a>
							</div>
						</fieldset>
					</div>
					<div class="equal-content padded-left">
						<fieldset class="padded-none margin-none">
							<legend>PSA</legend>
							<div class="full-width center">
								<a class="full-width rounded bordered button-link" href="<?php
																							$retval = $mysqli->query("SELECT stds_psa FROM stds_frm_addm WHERE stds_acc_id = '$admissions_student_account_id'")->fetch_object()->stds_psa;
																							echo $retval;
																							?>" target="_blank" type="application/pdf" rel="noopener noreferrer nofollow external">View Student PSA</a>
							</div>
						</fieldset>
					</div>
				</div>
				<div class="equal-container margin-top">
					<div class="equal-content padded-right">
						<fieldset class="padded-none margin-none">
							<legend>Good Moral</legend>
							<div class="full-width center">
								<a class="full-width rounded bordered button-link" href="<?php
																							$retval = $mysqli->query("SELECT stds_good_moral FROM stds_frm_addm WHERE stds_acc_id = '$admissions_student_account_id'")->fetch_object()->stds_good_moral;
																							echo $retval;
																							?>" target="_blank" type="application/pdf" rel="noopener noreferrer nofollow external">View Student Good Moral</a>
							</div>
						</fieldset>
					</div>
					<div class="equal-content padded-left">
						<fieldset class="padded-none margin-none">
							<legend>Form 137</legend>
							<div class="full-width center">
								<a class="full-width rounded bordered button-link" href="<?php
																							$retval = $mysqli->query("SELECT stds_form_137 FROM stds_frm_addm WHERE stds_acc_id = '$admissions_student_account_id'")->fetch_object()->stds_form_137;
																							echo $retval;
																							?>" target="_blank" type="application/pdf" rel="noopener noreferrer nofollow external">View Student Form 137</a>
							</div>
						</fieldset>
					</div>
				</div>
			</div>
		</fieldset>

		<br>

		<fieldset class="padded-none margin-none margin-top-bottom">
			<legend class="padded-left-right full-width center">
				<h4>Educational Background</h4>
			</legend>
			<fieldset class="padded-none margin-none margin-top">
				<legend>Learner Reference Number (LRN)</legend>
				<input class="full-width" type="text" name="std_std_lrn" id="std_std_lrn" value="<?php
																									$retval = $mysqli->query("SELECT stds_std_lrn FROM stds_frm_addm WHERE stds_acc_id = '$admissions_student_account_id'")->fetch_object()->stds_std_lrn;
																									echo $retval;
																									?>" disabled>
			</fieldset>
			<fieldset class="padded-none margin-none margin-top">
				<legend>Name of Former School</legend>
				<input class="full-width" type="text" name="std_former_school" id="std_former_school" value="<?php
																												$retval = $mysqli->query("SELECT stds_former_school FROM stds_frm_addm WHERE stds_acc_id = '$admissions_student_account_id'")->fetch_object()->stds_former_school;
																												echo $retval;
																												?>" disabled>
				<br>
				<label for="std_former_school">Complete School Name</label>

				<div class="equal-container margin-top">
					<div class="equal-content padded-right">
						<input class="full-width" type="text" name="std_former_graduate_year" id="std_former_graduate_year" value="<?php
																																	$retval = $mysqli->query("SELECT stds_former_graduate_year FROM stds_frm_addm WHERE stds_acc_id = '$admissions_student_account_id'")->fetch_object()->stds_former_graduate_year;
																																	echo $retval;
																																	?>" disabled>
						<br>
						<label for="std_former_graduate_year">Year Graduated</label>
					</div>
					<div class="equal-content padded-left">
						<input class="full-width" type="text" name="std_former_school_year" id="std_former_school_year" value="<?php
																																$retval = $mysqli->query("SELECT stds_former_school_year FROM stds_frm_addm WHERE stds_acc_id = '$admissions_student_account_id'")->fetch_object()->stds_former_school_year;
																																echo $retval;
																																?>" disabled>
						<br>
						<label for="std_former_school_year">School Year</label>
					</div>
				</div>
			</fieldset>
		</fieldset>

		<br>

		<fieldset class="padded-none margin-none margin-top-bottom">
			<legend class="padded-left-right full-width center">
				<h4>Parent Information</h4>
			</legend>
			<fieldset class="padded-none margin-none margin-top">
				<legend>Mother's Name</legend>
				<div class="equal-container">
					<div class="equal-content padded-right">
						<input class="full-width" type="text" name="std_mother_lname" id="std_mother_lname" value="<?php
																													$retval = $mysqli->query("SELECT stds_mother_lname FROM stds_frm_addm WHERE stds_acc_id = '$admissions_student_account_id'")->fetch_object()->stds_mother_lname;
																													echo $retval;
																													?>" disabled>
						<br>
						<label for="std_mother_lname">Last Name</label>
					</div>

					<div class="equal-content padded-left-right">
						<input class="full-width" type="text" name="std_mother_fname" id="std_mother_fname" value="<?php
																													$retval = $mysqli->query("SELECT stds_mother_fname FROM stds_frm_addm WHERE stds_acc_id = '$admissions_student_account_id'")->fetch_object()->stds_mother_fname;
																													echo $retval;
																													?>" disabled>
						<br>
						<label for="std_mother_fname">First Name</label>
					</div>

					<div class="equal-content padded-left">
						<input class="full-width" type="text" name="std_mother_mname" id="std_mother_mname" value="<?php
																													$retval = $mysqli->query("SELECT stds_mother_mname FROM stds_frm_addm WHERE stds_acc_id = '$admissions_student_account_id'")->fetch_object()->stds_mother_mname;
																													echo $retval;
																													?>" disabled>
						<br>
						<label for="std_mother_mname">Middle Name</label>
					</div>
				</div>
				<div class="equal-container margin-top">
					<div class="equal-content padded-right">
						<fieldset class="padded-none margin-none">
							<legend>Occupation</legend>
							<input class="full-width" type="text" name="std_mother_occupation" id="std_mother_occupation" value="<?php
																																	$retval = $mysqli->query("SELECT stds_mother_occupation FROM stds_frm_addm WHERE stds_acc_id = '$admissions_student_account_id'")->fetch_object()->stds_mother_occupation;
																																	echo $retval;
																																	?>" disabled>
						</fieldset>
					</div>
					<div class="equal-content padded-left">
						<fieldset class="padded-none margin-none">
							<legend>Contact Number</legend>
							<input class="full-width" type="tel" name="std_mother_contact" id="std_mother_contact" value="<?php
																															$retval = $mysqli->query("SELECT stds_mother_contact FROM stds_frm_addm WHERE stds_acc_id = '$admissions_student_account_id'")->fetch_object()->stds_mother_contact;
																															echo $retval;
																															?>" disabled>
						</fieldset>
					</div>
				</div>
			</fieldset>
			<fieldset class="padded-none margin-none margin-top">
				<legend>Father's Name</legend>
				<div class="equal-container">
					<div class="equal-content padded-right">
						<input class="full-width" type="text" name="std_father_lname" id="std_father_lname" value="<?php
																													$retval = $mysqli->query("SELECT stds_father_lname FROM stds_frm_addm WHERE stds_acc_id = '$admissions_student_account_id'")->fetch_object()->stds_father_lname;
																													echo $retval;
																													?>" disabled>
						<br>
						<label for="std_father_lname">Last Name</label>
					</div>

					<div class="equal-content padded-left-right">
						<input class="full-width" type="text" name="std_father_fname" id="std_father_fname" value="<?php
																													$retval = $mysqli->query("SELECT stds_father_fname FROM stds_frm_addm WHERE stds_acc_id = '$admissions_student_account_id'")->fetch_object()->stds_father_fname;
																													echo $retval;
																													?>" disabled>
						<br>
						<label for="std_father_fname">First Name</label>
					</div>

					<div class="equal-content padded-left">
						<input class="full-width" type="text" name="std_father_mname" id="std_father_mname" value="<?php
																													$retval = $mysqli->query("SELECT stds_father_mname FROM stds_frm_addm WHERE stds_acc_id = '$admissions_student_account_id'")->fetch_object()->stds_father_mname;
																													echo $retval;
																													?>" disabled>
						<br>
						<label for=" std_father_mname">Middle Name</label>
					</div>
				</div>
				<div class="equal-container margin-top">
					<div class="equal-content padded-right">
						<fieldset class="padded-none margin-none">
							<legend>Occupation</legend>
							<input class="full-width" type="text" name="std_father_occupation" id="std_father_occupation" value="<?php
																																	$retval = $mysqli->query("SELECT stds_father_occupation FROM stds_frm_addm WHERE stds_acc_id = '$admissions_student_account_id'")->fetch_object()->stds_father_occupation;
																																	echo $retval;
																																	?>" disabled>
						</fieldset>
					</div>
					<div class="equal-content padded-left">
						<fieldset class="padded-none margin-none">
							<legend>Contact Number</legend>
							<input class="full-width" type="tel" name="std_father_contact" id="std_father_contact" value="<?php
																															$retval = $mysqli->query("SELECT stds_father_contact FROM stds_frm_addm WHERE stds_acc_id = '$admissions_student_account_id'")->fetch_object()->stds_father_contact;
																															echo $retval;
																															?>" disabled>
						</fieldset>
					</div>
				</div>
			</fieldset>
		</fieldset>

		<br>

		<fieldset class="padded-none margin-none margin-top-bottom">
			<legend class="padded-left-right full-width center">
				<h4>Contact In Case Of Emmergency</h4>
			</legend>
			<fieldset class="padded-none margin-none margin-top">
				<legend>Contact Person</legend>
				<div class="equal-container">
					<div class="equal-content padded-right">
						<input class="full-width" type="text" name="std_emergency_contact_lname" id="std_emergency_contact_lname" value="<?php
																																			$retval = $mysqli->query("SELECT stds_emergency_contact_lname FROM stds_frm_addm WHERE stds_acc_id = '$admissions_student_account_id'")->fetch_object()->stds_emergency_contact_lname;
																																			echo $retval;
																																			?>" disabled>
						<br>
						<label for="std_emergency_contact_lname">Last Name</label>
					</div>

					<div class="equal-content padded-left-right">
						<input class="full-width" type="text" name="std_emergency_contact_fname" id="std_emergency_contact_fname" value="<?php
																																			$retval = $mysqli->query("SELECT stds_emergency_contact_fname FROM stds_frm_addm WHERE stds_acc_id = '$admissions_student_account_id'")->fetch_object()->stds_emergency_contact_fname;
																																			echo $retval;
																																			?>" disabled>
						<br>
						<label for="std_emergency_contact_fname">First Name</label>
					</div>

					<div class="equal-content padded-left">
						<input class="full-width" type="text" name="std_emergency_contact_mname" id="std_emergency_contact_mname" value="<?php
																																			$retval = $mysqli->query("SELECT stds_emergency_contact_mname FROM stds_frm_addm WHERE stds_acc_id = '$admissions_student_account_id'")->fetch_object()->stds_emergency_contact_mname;
																																			echo $retval;
																																			?>" disabled>
						<br>
						<label for="stds_emergency_contact_mname">Middle Name</label>
					</div>
				</div>
				<div class="margin-top">
					<fieldset class="padded-none margin-none">
						<legend>Contact Number</legend>
						<input class="full-width" type="tel" name="std_emergency_contact_contact" id="std_emergency_contact_contact" value="<?php
																																			$retval = $mysqli->query("SELECT stds_emergency_contact_contact FROM stds_frm_addm WHERE stds_acc_id = '$admissions_student_account_id'")->fetch_object()->stds_emergency_contact_contact;
																																			echo $retval;
																																			?>" disabled>
					</fieldset>
				</div>
			</fieldset>
		</fieldset>
	</form>
</div>
