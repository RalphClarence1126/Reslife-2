<?php
require('../../database/config.php');


ob_start();


$email = $_SESSION['username'];
$ad_acc_id = $mysqli->query("SELECT * FROM ad WHERE ad_email = '$email'")->fetch_object()->ad_acc_id;
$sql = '';


if (!empty($_POST) && isset($_POST['view_details_open'])) {
	$_SESSION['view_details_open'] = 1;
	$_SESSION['student_account_id'] = $_POST['std_acc_id'];

	header('location: /website/user/profile/admin-dashboard.php');
	exit;
}
if (!empty($_POST) && isset($_POST['hide_details_close'])) {
	$_SESSION['view_details_open'] = 0;
	$_SESSION['student_account_id'] = '';

	header('location: /website/user/profile/admin-dashboard.php');
	exit;
}


if (!empty($_POST) && isset($_POST['accept_admission'])) {
	$std_acc_id = $_POST['std_acc_id'];

	$sql = "INSERT INTO ad_stdUpd (ad_acc_id, ad_stdUpd_title, ad_stdUpd_msg, stds_acc_id) VALUES ('$ad_acc_id', 'Admission Status', 'Your submission for admission has been accepted. Please wait for your email with additional admission information.', '$std_acc_id');";
	$mysqli->query($sql);

	$mysqli->query("DELETE FROM stds_frm_addm WHERE stds_acc_id = '$std_acc_id'");

	header('location: /website/user/profile/admin-dashboard.php');
	exit;
}
if (!empty($_POST) && isset($_POST['reject_admission'])) {
	$std_acc_id = $_POST['std_acc_id'];

	$sql = "INSERT INTO ad_stdUpd (ad_acc_id, ad_stdUpd_title, ad_stdUpd_msg, stds_acc_id) VALUES ('$ad_acc_id', 'Admission Status', 'We regret to inform you that your submission for admission has been rejected.', '$std_acc_id');";
	$mysqli->query($sql);

	$mysqli->query("DELETE FROM stds_frm_addm WHERE stds_acc_id = '$std_acc_id'");

	header('location: /website/user/profile/admin-dashboard.php');
	exit;
}
?>


<form action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>" method="post">
	<input type="hidden" name="std_acc_id" value="<?php echo $admissions_student_account_id ?>">

	<div class="rounded padded equal-container-spaced margin-top-bottom bordered">
		<div class="equal-content-spaced">
			<div class="margin-right">
				<div class="equal-container">
					<div class="equal-content-spaced margin-right">
						<div class="full-height center">
							<img class="profile" src="<?php echo ($admissions_student_picture) ? $admissions_student_picture : '/website/include/images/rtu-seal.png'; ?>" alt="Student 2x2 Picture" height="40" width="40" loading="lazy">
						</div>
					</div>
					<div class="equal-content-spaced margin-left">
						<div class="full-height center">
							<h6><?php echo $admissions_student_number ?> : <?php echo $admissions_student_lrn ?></h6>
						</div>
					</div>
				</div>
			</div>

		</div>
		<div class="equal-content-spaced">
			<div class="full-height center margin-left-right">
				<?php
				if ($_SESSION['student_account_id'] == $admissions_student_account_id) {
					if ($_SESSION['view_details_open']) {
						echo '<button type="submit" name="hide_details_close" class="red full-width" tabindex="-1">Hide Admission Details</button>';
					} else {
						echo '<button type="submit" name="view_details_open" class="full-width" tabindex="-1">View Admission Details</button>';
					}
				} else {
					echo '<button type="submit" name="view_details_open" class="full-width" tabindex="-1">View Admission Details</button>';
				}
				?>
			</div>
		</div>
		<div class="equal-content-spaced">
			<div class="full-height center margin-left">
				<div class="equal-container-spaced">
					<div class="equal-content-spaced margin-right">
						<button type="submit" name="accept_admission" class="full-width" tabindex="-1">Accept</button>
					</div>
					<div class="equal-content-spaced margin-left">
						<button type="submit" name="reject_admission" class="red full-width" tabindex="-1">Reject</button>
					</div>
				</div>
			</div>
		</div>
	</div>

	<?php
	if ($_SESSION['student_account_id'] == $admissions_student_account_id) {
		if ($_SESSION['view_details_open']) {
			include('../forms/admin/admission.php');
		} else {
			echo '';
		}
	} else {
		echo '';
	}

	?>
</form>
