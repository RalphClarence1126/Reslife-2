<?php
require('../../database/config.php');


ob_start();


$email = $_COOKIE['username'];
$ad_acc_id = $mysqli->query("SELECT * FROM ad WHERE ad_email = '$email'")->fetch_object()->ad_acc_id;
$sql = '';


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


<form class="full-width margin-top-bottom" action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>" method="post">
	<input type="hidden" name="std_acc_id" value="<?php echo $admissions_student_account_id ?>">

	<div class="rounded bordered margin-top-bottom">
		<div class="padded-left-right equal-container-spaced border-bottom">
			<div class="fit-width padded-right equal-content-spaced">
				<h4>Admission ID: <?php echo $admissions_id; ?></h4>
			</div>
			<div class="fit-width padded-left equal-content-spaced">
				<h4>Student Account ID: <?php echo $admissions_student_account_id; ?></h4>
			</div>
		</div>
		<div class="padded equal-container">
			<div class="equal-content">
				<div class="margin-right">
					<div class="equal-container">
						<div class="equal-content-spaced margin-right">
							<div class="full-height center">
								<img class="profile" src="<?php echo ($admissions_student_picture) ? $admissions_student_picture : '/website/include/images/rtu-seal.png'; ?>" alt="Student 2x2 Picture" height="50" width="50" loading="lazy">
							</div>
						</div>
						<div class="equal-content-spaced margin-left">
							<div class="full-height center">
								<h4><?php echo $admissions_student_number ?> : <?php echo $admissions_student_lrn ?></h4>
							</div>
						</div>
					</div>
				</div>

			</div>
			<div class="equal-content">
				<div class="full-height center margin-left-right">
					<?php
					if (!empty($_POST) && isset($_POST['hide_details_close'])) {
						$_SESSION['view_details_open'] = 0;
						$_SESSION['student_account_id'] = '';

						header('location: /website/user/profile/admin-dashboard.php');
						exit;
					}
					if (!empty($_POST) && isset($_POST['view_details_open'])) {
						$_SESSION['view_details_open'] = 1;
						$_SESSION['student_account_id'] = $_POST['std_acc_id'];

						header('location: /website/user/profile/admin-dashboard.php');
						exit;
					}


					$view_admission_details_botton = '<button type="submit" name="view_details_open" class="full-width" tabindex="-1">View Admission Details</button>';
					$hide_admission_details_botton = '<button type="submit" name="hide_details_close" class="red full-width" tabindex="-1">Hide Admission Details</button>';


					// if ($_SESSION['student_account_id'] == $admissions_student_account_id) {
					// 	if ($_SESSION['view_details_open']) {
					// 		echo $hide_admission_details_botton;
					// 	} else {
					// 		echo $view_admission_details_botton;
					// 	}
					// } else {
					// 	echo $view_admission_details_botton;
					// }

					echo ($_SESSION['student_account_id'] == $admissions_student_account_id) ? (($_SESSION['view_details_open']) ? $hide_admission_details_botton : $view_admission_details_botton) : $view_admission_details_botton;
					?>
				</div>
			</div>
			<div class="equal-content">
				<div class="full-height center margin-left">
					<div class="equal-container">
						<div class="equal-content margin-right">
							<button type="submit" name="accept_admission" class="blue full-width" tabindex="-1">Accept</button>
						</div>
						<div class="equal-content margin-left-right">
							<?php
							if (!empty($_POST) && isset($_POST['pending_admission'])) {
								$std_acc_id = $_POST['std_acc_id'];

								$sql = "INSERT INTO ad_stdUpd (ad_acc_id, ad_stdUpd_title, ad_stdUpd_msg, stds_acc_id) VALUES ('$ad_acc_id', 'Admission Status', 'Your submission for admission has been put on the pending list. Please wait for further account status.', '$std_acc_id');";
								$mysqli->query($sql);

								$mysqli->query("UPDATE stds_frm_addm SET stds_status_bool = 'PENDING' WHERE stds_acc_id = '$std_acc_id'");

								header('location: /website/user/profile/admin-dashboard.php');
								exit;
							}
							if (!empty($_POST) && isset($_POST['waiting_admission'])) {
								$std_acc_id = $_POST['std_acc_id'];

								$sql = "INSERT INTO ad_stdUpd (ad_acc_id, ad_stdUpd_title, ad_stdUpd_msg, stds_acc_id) VALUES ('$ad_acc_id', 'Admission Status', 'Your submission for admission has been put on the waiting list. Please wait for further account status.', '$std_acc_id');";
								$mysqli->query($sql);

								$mysqli->query("UPDATE stds_frm_addm SET stds_status_bool = NULL WHERE stds_acc_id = '$std_acc_id'");

								header('location: /website/user/profile/admin-dashboard.php');
								exit;
							}


							$pending_button = "<button type='submit' name='pending_admission' class='full-width' tabindex='-1'>Pending</button>";
							$waiting_button = "<button type='submit' name='waiting_admission' class='full-width' tabindex='-1'>Waiting</button>";


							echo ($admissions_status == 'PENDING') ? $waiting_button : $pending_button;
							?>
						</div>
						<div class="equal-content margin-left">
							<button type="submit" name="reject_admission" class="red full-width" tabindex="-1">Reject</button>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>


	<!-- <div class="fit-width rounded margin-top-bottom bordered">
		<div class="padded-left-right border-bottom">
			<h6>Admission ID: <?php echo $admissions_id; ?></h6>
			<h6>Student Account ID: <?php echo $admissions_student_account_id; ?></h6>
		</div>
		<div class="center full-height padded border-bottom">
			<img class="profile" src="<?php echo ($admissions_student_picture) ? $admissions_student_picture : '/website/include/images/rtu-seal.png'; ?>" alt="Student 2x2 Picture" height="100" width="100" loading="lazy">
		</div>
		<div class="center full-height padded border-bottom">
			<span class="no-wrap">
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
			</span>
		</div>
		<div class="padded">
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
		</div>
		<div class="full-height padded-left-right">
			<div class="margin-top-bottom">
				<button type="submit" name="accept_admission" class="blue full-width" tabindex="-1">Accept</button>
			</div>
			<div class="margin-top-bottom">
				<?php
				if (!empty($_POST) && isset($_POST['pending_admission'])) {
					$std_acc_id = $_POST['std_acc_id'];

					$sql = "INSERT INTO ad_stdUpd (ad_acc_id, ad_stdUpd_title, ad_stdUpd_msg, stds_acc_id) VALUES ('$ad_acc_id', 'Admission Status', 'Your submission for admission has been put on the pending list. Please wait for further account status.', '$std_acc_id');";
					$mysqli->query($sql);

					$mysqli->query("UPDATE stds_frm_addm SET stds_status_bool = 'PENDING' WHERE stds_acc_id = '$std_acc_id'");

					header('location: /website/user/profile/admin-dashboard.php');
					exit;
				}
				if (!empty($_POST) && isset($_POST['waiting_admission'])) {
					$std_acc_id = $_POST['std_acc_id'];

					$sql = "INSERT INTO ad_stdUpd (ad_acc_id, ad_stdUpd_title, ad_stdUpd_msg, stds_acc_id) VALUES ('$ad_acc_id', 'Admission Status', 'Your submission for admission has been put on the waiting list. Please wait for further account status.', '$std_acc_id');";
					$mysqli->query($sql);

					$mysqli->query("UPDATE stds_frm_addm SET stds_status_bool = NULL WHERE stds_acc_id = '$std_acc_id'");

					header('location: /website/user/profile/admin-dashboard.php');
					exit;
				}


				$pending_button = "<button type='submit' name='pending_admission' class='full-width' tabindex='-1'>Pending</button>";
				$waiting_button = "<button type='submit' name='waiting_admission' class='full-width' tabindex='-1'>Waiting</button>";


				echo ($admissions_status == 'PENDING') ? $waiting_button : $pending_button;
				?>
			</div>
			<div class="margin-top-bottom">
				<button type="submit" name="reject_admission" class="red full-width" tabindex="-1">Reject</button>
			</div>
		</div>
	</div> -->
</form>

<div class="margin-top-bottom">
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
</div>
