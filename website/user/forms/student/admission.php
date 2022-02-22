<?php
require('../../database/config.php');


session_start();


$email = $_SESSION['username'];
$std_acc_id = $mysqli->query("SELECT * FROM stds WHERE stds_email = '$email'")->fetch_object()->stds_acc_id;
$sql = '';


if (!empty($_POST) && isset($_POST['submit_admission_form'])) {
	$mysqli->query("INSERT INTO stds_frm_addm (stds_acc_id) VALUES ('$std_acc_id')");

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


	if ($_POST['std_contact']) {
		$std_contact = $_POST['std_contact'];
		$mysqli->query("UPDATE stds SET stds_contact = '$std_contact' WHERE stds_acc_id = '$std_acc_id'");
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
	if ($_POST['std_birth_month']) {
		$std_birth_month = $_POST['std_birth_month'];
		$mysqli->query("UPDATE stds SET stds_birth_month = '$std_birth_month' WHERE stds_acc_id = '$std_acc_id'");
	}
	if ($_POST['std_birth_day']) {
		$std_birth_day = $_POST['std_birth_day'];
		$mysqli->query("UPDATE stds SET stds_birth_day = '$std_birth_day' WHERE stds_acc_id = '$std_acc_id'");
	}
	if ($_POST['std_birth_year']) {
		$std_birth_year = $_POST['std_birth_year'];
		$mysqli->query("UPDATE stds SET stds_birth_year = '$std_birth_year' WHERE stds_acc_id = '$std_acc_id'");
	}


	if ($_POST['std_birthplace']) {
		$std_birthplace = $_POST['std_birthplace'];
		$mysqli->query("UPDATE stds SET stds_address = '$std_birthplace' WHERE stds_acc_id = '$std_acc_id'");
	}

	$std_email = $_POST['std_email'];
	$mysqli->query("UPDATE stds SET stds_email = '$std_email' WHERE stds_acc_id = '$std_acc_id'");

	$std_birth_address = $_POST['std_birth_address'];
	$std_tel_number = $_POST['std_tel_number'];

	$mysqli->query("UPDATE stds_frm_addm SET stds_birth_address = '$std_birth_address', stds_tel_number = '$std_tel_number' WHERE stds_acc_id = '$std_acc_id'");


	$std_grade_level = $_POST['std_grade_level'];
	$std_admission_strand = $_POST['std_admission_strand'];
	$std_student_status = $_POST['std_student_status'];
	$std_std_number = $_POST['std_std_number'];

	$mysqli->query("UPDATE stds_frm_addm SET stds_grade_level = '$std_grade_level', stds_admission_strand = '$std_admission_strand', stds_student_status = '$std_student_status', stds_std_number = '$std_std_number' WHERE stds_acc_id = '$std_acc_id'");

	$target_dir = "uploads/student/forms/";

	if (is_dir($target_dir . $email)) {
		$target_dir = "uploads/student/forms/" . $email . "/";
	} else {
		mkdir("uploads/student/forms/" . $email);
		$target_dir = "uploads/student/forms/" . $email . "/";
	}

	$target_file_2x2_pic = $target_dir . basename($_FILES["std_2x2_pic"]["name"]);
	$uploadOk_2x2_pic = 1;
	$imageFileType_2x2_pic = strtolower(pathinfo($target_file_2x2_pic, PATHINFO_EXTENSION));
	if ($check_2x2_pic !== false) {
		$uploadOk_2x2_pic = 1;
	} else {
		$uploadOk_2x2_pic = 0;
	}
	if (file_exists($target_file_2x2_pic)) {
		$uploadOk_2x2_pic = 0;
	}
	if ($uploadOk_2x2_pic == 1) {
		if (move_uploaded_file($_FILES["std_2x2_pic"]["tmp_name"], $target_file_2x2_pic)) {
			$mysqli->query("UPDATE stds_frm_addm SET stds_2x2_pic = '$target_file_2x2_pic' WHERE stds_acc_id = '$std_acc_id'");
		}
	} else {
		if ($target_file_2x2_pic != $target_dir) {
			$mysqli->query("UPDATE stds_frm_addm SET stds_2x2_pic = '$target_file_2x2_pic' WHERE stds_acc_id = '$std_acc_id'");
		}
	}

	$target_file_psa = $target_dir . basename($_FILES["std_psa"]["name"]);
	$uploadOk_psa = 1;
	$imageFileType_psa = strtolower(pathinfo($target_file_psa, PATHINFO_EXTENSION));
	if ($check_psa !== false) {
		$uploadOk_psa = 1;
	} else {
		$uploadOk_psa = 0;
	}
	if (file_exists($target_file_psa)) {
		$uploadOk_psa = 0;
	}
	if ($uploadOk_psa == 1) {
		if (move_uploaded_file($_FILES["std_psa"]["tmp_name"], $target_file_psa)) {
			$mysqli->query("UPDATE stds_frm_addm SET stds_psa = '$target_file_psa' WHERE stds_acc_id = '$std_acc_id'");
		}
	} else {
		if ($target_file_psa != $target_dir) {
			$mysqli->query("UPDATE stds_frm_addm SET stds_psa = '$target_file_psa' WHERE stds_acc_id = '$std_acc_id'");
		}
	}

	$target_file_good_moral = $target_dir . basename($_FILES["std_good_moral"]["name"]);
	$uploadOk_good_moral = 1;
	$imageFileType_good_moral = strtolower(pathinfo($target_file_good_moral, PATHINFO_EXTENSION));
	if ($check_good_moral !== false) {
		$uploadOk_good_moral = 1;
	} else {
		$uploadOk_good_moral = 0;
	}
	if (file_exists($target_file_good_moral)) {
		$uploadOk_good_moral = 0;
	}
	if ($uploadOk_good_moral == 1) {
		if (move_uploaded_file($_FILES["std_good_moral"]["tmp_name"], $target_file_good_moral)) {
			$mysqli->query("UPDATE stds_frm_addm SET stds_good_moral = '$target_file_good_moral' WHERE stds_acc_id = '$std_acc_id'");
		}
	} else {
		if ($target_file_good_moral != $target_dir) {
			$mysqli->query("UPDATE stds_frm_addm SET stds_good_moral = '$target_file_good_moral' WHERE stds_acc_id = '$std_acc_id'");
		}
	}

	$target_file_form_137 = $target_dir . basename($_FILES["std_form_137"]["name"]);
	$uploadOk_form_137 = 1;
	$imageFileType_form_137 = strtolower(pathinfo($target_file_form_137, PATHINFO_EXTENSION));
	if ($check_form_137 !== false) {
		$uploadOk_form_137 = 1;
	} else {
		$uploadOk_form_137 = 0;
	}
	if (file_exists($target_file_form_137)) {
		$uploadOk_form_137 = 0;
	}
	if ($uploadOk_form_137 == 1) {
		if (move_uploaded_file($_FILES["std_form_137"]["tmp_name"], $target_file_form_137)) {
			$mysqli->query("UPDATE stds_frm_addm SET stds_form_137 = '$target_file_form_137' WHERE stds_acc_id = '$std_acc_id'");
		}
	} else {
		if ($target_file_form_137 != $target_dir) {
			$mysqli->query("UPDATE stds_frm_addm SET stds_form_137 = '$target_file_form_137' WHERE stds_acc_id = '$std_acc_id'");
		}
	}


	$std_std_lrn = $_POST['std_std_lrn'];
	$std_former_school = $_POST['std_former_school'];
	$std_former_graduate_year = $_POST['std_former_graduate_year'];
	$std_former_school_year = $_POST['std_former_school_year'];

	$mysqli->query("UPDATE stds_frm_addm SET stds_std_lrn = '$std_std_lrn', stds_former_school = '$std_former_school', stds_former_graduate_year = '$std_former_graduate_year', stds_former_school_year = '$std_former_school_year' WHERE stds_acc_id = '$std_acc_id'");


	$std_mother_lname = $_POST['std_mother_lname'];
	$std_mother_fname = $_POST['std_mother_fname'];
	$std_mother_mname = $_POST['std_mother_mname'];
	$std_mother_occupation = $_POST['std_mother_occupation'];
	$std_mother_contact = $_POST['std_mother_contact'];

	$mysqli->query("UPDATE stds_frm_addm SET stds_mother_lname = '$std_mother_lname', stds_mother_fname = '$std_mother_fname', stds_mother_mname = '$std_mother_mname', stds_mother_occupation = '$std_mother_occupation', stds_mother_contact = '$std_mother_contact' WHERE stds_acc_id = '$std_acc_id'");


	$std_father_lname = $_POST['std_father_lname'];
	$std_father_fname = $_POST['std_father_fname'];
	$std_father_mname = $_POST['std_father_mname'];
	$std_father_occupation = $_POST['std_father_occupation'];
	$std_father_contact = $_POST['std_father_contact'];

	$mysqli->query("UPDATE stds_frm_addm SET stds_father_lname = '$std_father_lname', stds_father_fname = '$std_father_fname', stds_father_mname = '$std_father_mname', stds_father_occupation = '$std_father_occupation', stds_father_contact = '$std_father_contact' WHERE stds_acc_id = '$std_acc_id'");


	$std_emergency_contact_lname = $_POST['std_emergency_contact_lname'];
	$std_emergency_contact_fname = $_POST['std_emergency_contact_fname'];
	$std_emergency_contact_mname = $_POST['std_emergency_contact_mname'];
	$std_emergency_contact_contact = $_POST['std_emergency_contact_contact'];

	$mysqli->query("UPDATE stds_frm_addm SET stds_emergency_contact_lname = '$std_emergency_contact_lname', stds_emergency_contact_fname = '$std_emergency_contact_fname', stds_emergency_contact_mname = '$std_emergency_contact_mname', stds_emergency_contact_contact = '$std_emergency_contact_contact' WHERE stds_acc_id = '$std_acc_id'");


	$sql = "INSERT INTO ad_stdUpd (ad_stdUpd_title, ad_stdUpd_msg, stds_acc_id) VALUES ('Admission Status', 'Thank you for filling out the admission form. You are now on the pending list. (This status automated, please wait for further status)', '$std_acc_id');";
	$mysqli->query($sql);


	header('location: /website/user/profile/student-admission.php');
	exit;
}
?>


<div class="margin-top-bottom padded rounded bordered unselectable">
	<form id="student_admission_form" action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>" method="post" enctype="multipart/form-data" autocomplete="off">
		<fieldset class="padded-none margin-none margin-bottom">
			<legend class="padded-left-right full-width center">
				<h4>Learner Information</h4>
			</legend>

			<div class="notification-red unselectable margin-top-bottom">
				Information saved in your user profile will be directly shown here as well. It is recommended that you also setup your profile. Any changes you make here will appear on your profile as well.
			</div>

			<fieldset class="padded-none margin-none margin-top">
				<legend>Student's Name</legend>
				<div class="equal-container">
					<div class="equal-content padded-right">
						<input class="full-width" type="text" name="std_lname" id="std_lname" oninput="this.value = this.value.toUpperCase();" value="<?php
																																						$retval = $mysqli->query("SELECT stds_lname FROM stds WHERE stds_acc_id = '$std_acc_id'")->fetch_object()->stds_lname;
																																						echo $retval;
																																						?>" required>
						<br>
						<label for="std_lname">Last Name</label>
					</div>
					<div class="equal-content padded-left-right">
						<input class="full-width" type="text" name="std_fname" id="std_fname" oninput="this.value = this.value.toUpperCase();" value="<?php
																																						$retval = $mysqli->query("SELECT stds_fname FROM stds WHERE stds_acc_id = '$std_acc_id'")->fetch_object()->stds_fname;
																																						echo $retval;
																																						?>" required>
						<br>
						<label for="std_fname">First Name</label>
					</div>
					<div class="equal-content padded-left-right">
						<input class="full-width" type="text" name="std_mname" id="std_mname" oninput="this.value = this.value.toUpperCase();" value="<?php
																																						$retval = $mysqli->query("SELECT stds_mname FROM stds WHERE stds_acc_id = '$std_acc_id'")->fetch_object()->stds_mname;
																																						echo $retval;
																																						?>" required>
						<br>
						<label for="std_mname">Middle Name</label>
					</div>
					<div class="equal-content padded-left">
						<input class="full-width" type="text" name="std_suffix" id="std_suffix" oninput="this.value = this.value.toUpperCase();" value="<?php
																																						$retval = $mysqli->query("SELECT stds_suffix FROM stds WHERE stds_acc_id = '$std_acc_id'")->fetch_object()->stds_suffix;
																																						echo $retval;
																																						?>" placeholder="[OPTIONAL]">
						<br>
						<label for="std_suffix">Suffix</label>
					</div>
				</div>
			</fieldset>
			<fieldset class="padded-none margin-none margin-top">
				<legend>Student's Date of Birth</legend>
				<div class="equal-container">
					<div class="equal-content padded-right">
						<input class="full-width" type="text" name="std_birth_month" id="std_birth_month" oninput="this.value = this.value.replace(/[^0-9.]/g, '').replace(/(\..*)\./g, '$1');" pattern="[0-9]{2}" placeholder="MM" value="<?php
																																																											$retval = $mysqli->query("SELECT stds_birth_month FROM stds WHERE stds_acc_id = '$std_acc_id'")->fetch_object()->stds_birth_month;
																																																											echo $retval;
																																																											?>" required>
						<br>
						<label for="std_birth_month">Month</label>
					</div>
					<div class="equal-content padded-left-right">
						<input class="full-width" type="text" name="std_birth_day" id="std_birth_day" oninput="this.value = this.value.replace(/[^0-9.]/g, '').replace(/(\..*)\./g, '$1');" pattern="[0-9]{2}" placeholder="DD" value="<?php
																																																										$retval = $mysqli->query("SELECT stds_birth_day FROM stds WHERE stds_acc_id = '$std_acc_id'")->fetch_object()->stds_birth_day;
																																																										echo $retval;
																																																										?>" required>
						<br>
						<label for="std_birth_day">Day</label>
					</div>
					<div class="equal-content padded-left">
						<input class="full-width" type="text" name="std_birth_year" id="std_birth_year" oninput="this.value = this.value.replace(/[^0-9.]/g, '').replace(/(\..*)\./g, '$1');" pattern="[0-9]{4}" placeholder="YYYY" value="<?php
																																																											$retval = $mysqli->query("SELECT stds_birth_year FROM stds WHERE stds_acc_id = '$std_acc_id'")->fetch_object()->stds_birth_year;
																																																											echo $retval;
																																																											?>" required>
						<br>
						<label for="std_birth_year">Year</label>
					</div>
				</div>
			</fieldset>
			<fieldset class="padded-none margin-none margin-top">
				<legend>Place of Birth</legend>
				<input class="full-width" type="text" name="std_birth_address" id="std_birth_address" oninput="this.value = this.value.toUpperCase();" required>
				<label for="std_birth_address">Address</label>
			</fieldset>
			<div class="equal-container margin-top">
				<div class="equal-content padded-right">
					<fieldset class="padded-none margin-none">
						<legend>Age</legend>
						<input class="full-width" type="number" name="std_age" id="std_age" oninput="this.value = this.value.replace(/[^0-9.]/g, '').replace(/(\..*)\./g, '$1');" min="1" max="100" value="<?php
																																																			$retval = $mysqli->query("SELECT stds_age FROM stds WHERE stds_acc_id = '$std_acc_id'")->fetch_object()->stds_age;
																																																			echo $retval;
																																																			?>" required>
					</fieldset>
				</div>
				<div class="equal-content padded-left-right">
					<fieldset class="padded-none margin-none">
						<legend>Gender</legend>
						<input class="full-width" type="text" name="std_gender" id="std_gender" oninput="this.value = this.value.toUpperCase();" pattern="[a-zA-Z|\-]+" value="<?php
																																												$retval = $mysqli->query("SELECT stds_gender FROM stds WHERE stds_acc_id = '$std_acc_id'")->fetch_object()->stds_gender;
																																												echo $retval;
																																												?>" required>
					</fieldset>
				</div>
				<div class="equal-content padded-left">
					<fieldset class="padded-none margin-none">
						<legend>Religion</legend>
						<input class="full-width" type="text" name="std_religion" id="std_religion" oninput="this.value = this.value.toUpperCase();" value="<?php
																																							$retval = $mysqli->query("SELECT stds_regligion FROM stds WHERE stds_acc_id = '$std_acc_id'")->fetch_object()->stds_regligion;
																																							echo $retval;
																																							?>" required>
					</fieldset>
				</div>
			</div>
			<div class="equal-container margin-top">
				<div class="equal-content padded-right">
					<fieldset class="padded-none margin-none">
						<legend>Email Address</legend>
						<input class="full-width" type="email" name="std_email" id="std_email" oninput="this.value = this.value.toLowerCase();" placeholder="example@email.com" pattern="\S+@\S+\.com" value="<?php
																																																				$retval = $mysqli->query("SELECT stds_email FROM stds WHERE stds_acc_id = '$std_acc_id'")->fetch_object()->stds_email;
																																																				echo $retval;
																																																				?>" required>
					</fieldset>
				</div>
				<div class="equal-content padded-left-right">
					<fieldset class="padded-none margin-none">
						<legend>Contact Number</legend>
						<input class="full-width" type="tel" name="std_contact" id="std_contact" oninput="this.value = this.value.replace(/[^0-9|\-.]/g, '').replace(/(\..*)\./g, '$1');" placeholder="09XX-XXX-XXXX" pattern="(([0-9]{4})-([0-9]{3})-([0-9]{4}))|(([0-9]{4})([0-9]{3})([0-9]{4}))|((\+63)(([0-9]{3})-([0-9]{3})-([0-9]{4})))|((\+63)(([0-9]{3})([0-9]{3})([0-9]{4})))" value="<?php
																																																																																																$retval = $mysqli->query("SELECT stds_contact FROM stds WHERE stds_acc_id = '$std_acc_id'")->fetch_object()->stds_contact;
																																																																																																echo $retval;
																																																																																																?>" required>
					</fieldset>
				</div>
				<div class="equal-content padded-left">
					<fieldset class="padded-none margin-none">
						<legend>Telephone Number</legend>
						<input class="full-width" type="tel" name="std_tel_number" id="std_tel_number" oninput="this.value = this.value.replace(/[^0-9|\-.]/g, '').replace(/(\..*)\./g, '$1');" placeholder="[OPTIONAL]">
					</fieldset>
				</div>
			</div>
			<fieldset class="padded-none margin-none margin-top">
				<legend>Current Address</legend>
				<input class="full-width" type="text" name="std_birthplace" id="std_birthplace" oninput="this.value = this.value.toUpperCase();" value="<?php
																																						$retval = $mysqli->query("SELECT stds_address FROM stds WHERE stds_acc_id = '$std_acc_id'")->fetch_object()->stds_address;
																																						echo $retval;
																																						?>">
			</fieldset>
		</fieldset>

		<br>

		<fieldset class="padded-none margin-none margin-top-bottom">
			<legend class="padded-left-right full-width center">
				<h4>Admission Details</h4>
			</legend>
			<div class="margin-top">
				<div class="equal-container">
					<div class="equal-content padded-right">
						<fieldset class="padded-none margin-none">
							<legend>Student Grade</legend>
							<select class="full-width white" name="std_grade_level" id="std_grade_level" onload="this.value = 'Default';" required>
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
					<div class="equal-content padded-left">
						<fieldset class="padded-none margin-none">
							<legend>Student Strand</legend>
							<select class="full-width white" name="std_admission_strand" id="std_admission_strand" onload="this.value = 'Default';" required>
								<option value="Default" hidden>Select Strand Preference</option>
								<option value="STEM">STEM</option>
								<option value="ABM">ABM</option>
								<option value="HUMSS">HUMSS</option>
								<option value="TVL - ICT">TVL - ICT</option>
							</select>
						</fieldset>
					</div>
				</div>
			</div>
			<div class="margin-top">
				<fieldset class="padded-none margin-none">
					<legend>Student Status</legend>
					<select class="full-width white" name="std_student_status" id="std_student_status" onload="this.value = '';">
						<option value="Default" hidden>Select Student Status</option>
						<option value="New Student">New Student</option>
						<option value="Old Student">Old Student</option>
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
					<li>2x2 Picture</li>
					<li>PSA</li>
					<li>Good Moral</li>
					<li>Form 137</li>
				</ul>

				<div class="equal-container">
					<div class="equal-content padded-right">
						<fieldset class="padded-none margin-none">
							<legend>Upload your 2x2 picture here</legend>
							<input class="full-width white" type="file" name="std_2x2_pic" id="std_2x2_pic" accept="image/*" required>
							<label><small><em>[Image Only]</em></small></label>
						</fieldset>
					</div>
					<div class="equal-content padded-left">
						<fieldset class="padded-none margin-none">
							<legend>Upload your PSA here</legend>
							<input class="full-width white" type="file" name="std_psa" id="std_psa" accept=".pdf" required>
							<label><small><em>[PDF Only]</em></small></label>
						</fieldset>
					</div>
				</div>
				<div class="equal-container margin-top">
					<div class="equal-content padded-right">
						<fieldset class="padded-none margin-none">
							<legend>Upload your Good Moral here</legend>
							<input class="full-width white" type="file" name="std_good_moral" id="std_good_moral" accept=".pdf" required>
							<label><small><em>[PDF Only]</em></small></label>
						</fieldset>
					</div>
					<div class="equal-content padded-left">
						<fieldset class="padded-none margin-none">
							<legend>Upload your Form 137 here</legend>
							<input class="full-width white" type="file" name="std_form_137" id="std_form_137" accept=".pdf" required>
							<label><small><em>[PDF Only]</em></small></label>
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
				<input class="full-width" type="text" name="std_std_lrn" id="std_std_lrn" oninput="this.value = this.value.replace(/[^0-9.]/g, '').replace(/(\..*)\./g, '$1');" placeholder="123456123456" pattern="[0-9]{6}[0-9]{6}" required>
			</fieldset>
			<fieldset class="padded-none margin-none margin-top">
				<legend>Name of Former School</legend>
				<input class="full-width" type="text" name="std_former_school" id="std_former_school" oninput="this.value = this.value.toUpperCase();" required>
				<br>
				<label for="std_former_school">Complete School Name</label>

				<div class="equal-container margin-top">
					<div class="equal-content padded-right">
						<input class="full-width" type="text" name="std_former_graduate_year" id="std_former_graduate_year" oninput="this.value = this.value.replace(/[^0-9.]/g, '').replace(/(\..*)\./g, '$1');" placeholder="YYYY" pattern="[0-9]{4}" required>
						<br>
						<label for="std_former_graduate_year">Year Graduated</label>
					</div>
					<div class="equal-content padded-left">
						<input class="full-width" type="text" name="std_former_school_year" id="std_former_school_year" oninput="this.value = this.value.replace(/[^0-9|\-.]/g, '').replace(/(\..*)\./g, '$1');" placeholder="YYYY-YYYY" pattern="[0-9]{4}-[0-9]{4}" required>
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
						<input class="full-width" type="text" name="std_mother_lname" id="std_mother_lname" oninput="this.value = this.value.toUpperCase();" required>
						<br>
						<label for="std_mother_lname">Last Name</label>
					</div>

					<div class="equal-content padded-left-right">
						<input class="full-width" type="text" name="std_mother_fname" id="std_mother_fname" oninput="this.value = this.value.toUpperCase();" required>
						<br>
						<label for="std_mother_fname">First Name</label>
					</div>

					<div class="equal-content padded-left">
						<input class="full-width" type="text" name="std_mother_mname" id="std_mother_mname" oninput="this.value = this.value.toUpperCase();" required>
						<br>
						<label for="std_mother_mname">Middle Name</label>
					</div>
				</div>
				<div class="equal-container margin-top">
					<div class="equal-content padded-right">
						<fieldset class="padded-none margin-none">
							<legend>Occupation</legend>
							<input class="full-width" type="text" name="std_mother_occupation" id="std_mother_occupation" oninput="this.value = this.value.toUpperCase();" required>
						</fieldset>
					</div>
					<div class="equal-content padded-left">
						<fieldset class="padded-none margin-none">
							<legend>Contact Number</legend>
							<input class="full-width" type="tel" name="std_mother_contact" id="std_mother_contact" oninput="this.value = this.value.replace(/[^0-9|\-.]/g, '').replace(/(\..*)\./g, '$1');" placeholder="09XX-XXX-XXXX" pattern="(([0-9]{4})-([0-9]{3})-([0-9]{4}))|(([0-9]{4})([0-9]{3})([0-9]{4}))|((\+63)(([0-9]{3})-([0-9]{3})-([0-9]{4})))|((\+63)(([0-9]{3})([0-9]{3})([0-9]{4})))" required>
						</fieldset>
					</div>
				</div>
			</fieldset>
			<fieldset class="padded-none margin-none margin-top">
				<legend>Father's Name</legend>
				<div class="equal-container">
					<div class="equal-content padded-right">
						<input class="full-width" type="text" name="std_father_lname" id="std_father_lname" oninput="this.value = this.value.toUpperCase();" required>
						<br>
						<label for="std_father_lname">Last Name</label>
					</div>

					<div class="equal-content padded-left-right">
						<input class="full-width" type="text" name="std_father_fname" id="std_father_fname" oninput="this.value = this.value.toUpperCase();" required>
						<br>
						<label for="std_father_fname">First Name</label>
					</div>

					<div class="equal-content padded-left">
						<input class="full-width" type="text" name="std_father_mname" id="std_father_mname" oninput="this.value = this.value.toUpperCase();" required>
						<br>
						<label for=" std_father_mname">Middle Name</label>
					</div>
				</div>
				<div class="equal-container margin-top">
					<div class="equal-content padded-right">
						<fieldset class="padded-none margin-none">
							<legend>Occupation</legend>
							<input class="full-width" type="text" name="std_father_occupation" id="std_father_occupation" oninput="this.value = this.value.toUpperCase();" required>
						</fieldset>
					</div>
					<div class="equal-content padded-left">
						<fieldset class="padded-none margin-none">
							<legend>Contact Number</legend>
							<input class="full-width" type="tel" name="std_father_contact" id="std_father_contact" oninput="this.value = this.value.replace(/[^0-9|\-.]/g, '').replace(/(\..*)\./g, '$1');" placeholder="09XX-XXX-XXXX" pattern="(([0-9]{4})-([0-9]{3})-([0-9]{4}))|(([0-9]{4})([0-9]{3})([0-9]{4}))|((\+63)(([0-9]{3})-([0-9]{3})-([0-9]{4})))|((\+63)(([0-9]{3})([0-9]{3})([0-9]{4})))" required>
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
						<input class="full-width" type="text" name="std_emergency_contact_lname" id="std_emergency_contact_lname" oninput="this.value = this.value.toUpperCase();" required>
						<br>
						<label for="std_emergency_contact_lname">Last Name</label>
					</div>

					<div class="equal-content padded-left-right">
						<input class="full-width" type="text" name="std_emergency_contact_fname" id="std_emergency_contact_fname" oninput="this.value = this.value.toUpperCase();" required>
						<br>
						<label for="std_emergency_contact_fname">First Name</label>
					</div>

					<div class="equal-content padded-left">
						<input class="full-width" type="text" name="std_emergency_contact_mname" id="std_emergency_contact_mname" oninput="this.value = this.value.toUpperCase();" required>
						<br>
						<label for="stds_emergency_contact_mname">Middle Name</label>
					</div>
				</div>
				<div class="margin-top">
					<fieldset class="padded-none margin-none">
						<legend>Contact Number</legend>
						<input class="full-width" type="tel" name="std_emergency_contact_contact" id="std_emergency_contact_contact" oninput="this.value = this.value.replace(/[^0-9|\-.]/g, '').replace(/(\..*)\./g, '$1');" placeholder="09XX-XXX-XXXX" pattern="(([0-9]{4})-([0-9]{3})-([0-9]{4}))|(([0-9]{4})([0-9]{3})([0-9]{4}))|((\+63)(([0-9]{3})-([0-9]{3})-([0-9]{4})))|((\+63)(([0-9]{3})([0-9]{3})([0-9]{4})))" required>
					</fieldset>
				</div>
			</fieldset>
		</fieldset>

		<br>

		<fieldset class="padded-none margin-none margin-top">
			<div class="equal-container-spaced">
				<div class="equal-content-spaced half-width">
					<button type="submit" name="submit_admission_form" class="full-width">Submit</button>
				</div>
				<div class="equal-content-spaced">
					<button type="reset" class="red full-width">Reset</button>
				</div>
			</div>
		</fieldset>
	</form>
</div>

<script>
	const getAdmissionForm = document.getElementById('student_admission_form');
	getAdmissionForm.addEventListener('keypress', function(event) {
		if (event.getModifierState('CapsLock')) {
			alert('You have capslock on.\n\nThe admission form will automatically all caps your input.')
		}
		if (event.key === 'Enter') {
			event.preventDefault();
		}
	});


	const getSystemDate = new Date,
		currentYear = getSystemDate.getFullYear().toString();

	const inputStudentBirthMonth = document.getElementById('std_birth_month');
	const inputStudentBirthDay = document.getElementById('std_birth_day');
	const inputStudentBirthYear = document.getElementById('std_birth_year');
	const inputStudentBirthAge = document.getElementById('std_age');

	let getStudentBirthMonth, getStudentBirthDay, getStudentBirthYear, getStudentBirthAge;


	inputStudentBirthMonth.addEventListener('input', function() {
		getStudentBirthMonth = inputStudentBirthMonth.value.toString();
		inputStudentBirthMonth.value = (getStudentBirthMonth > 12) ? '12' : getStudentBirthMonth;
	});
	inputStudentBirthDay.addEventListener('input', function() {
		getStudentBirthDay = inputStudentBirthDay.value.toString();;
		inputStudentBirthDay.value = (getStudentBirthDay > 31) ? '31' : getStudentBirthDay;
	});
	inputStudentBirthYear.addEventListener('input', function() {
		getStudentBirthYear = inputStudentBirthYear.value.toString();
		inputStudentBirthYear.value = (getStudentBirthYear > currentYear) ? currentYear : getStudentBirthYear;
	});


	function validateYearAndAge(studentBirthYear, studentBirthAge) {
		const expectedStudentAge = currentYear - studentBirthYear;
		const validateStudentAge = expectedStudentAge - studentBirthAge;
		if (validateStudentAge > 100) return;
		if (validateStudentAge > 1) {
			return alert(`Your age does not match your birthday.`);
		} else if (validateStudentAge < 0) {
			return alert(`Your age does not match your birthday.`);
		} else {
			return;
		}
	}
	inputStudentBirthYear.addEventListener('focusout', function() {
		getStudentBirthYear = inputStudentBirthYear.value.toString();
		getStudentBirthAge = inputStudentBirthAge.value.toString();
		if (!getStudentBirthAge) {
			return;
		} else {
			if (!getStudentBirthYear) return;
			return validateYearAndAge(getStudentBirthYear, getStudentBirthAge);
		}
	});
	inputStudentBirthAge.addEventListener('focusout', function() {
		getStudentBirthYear = inputStudentBirthYear.value.toString();
		getStudentBirthAge = inputStudentBirthAge.value.toString();
		if (!getStudentBirthYear) {
			return;
		} else {
			if (!getStudentBirthAge) return;
			return validateYearAndAge(getStudentBirthYear, getStudentBirthAge);
		}
	});
</script>
