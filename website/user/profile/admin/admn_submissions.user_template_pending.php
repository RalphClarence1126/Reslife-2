<?php
require('../../database/config.php');


ob_start();


$email = $_SESSION['username'];
$ad_acc_id = $mysqli->query("SELECT * FROM ad WHERE ad_email = '$email'")->fetch_object()->ad_acc_id;
$sql = '';


if (!empty($_POST) && isset($_POST['pending_admission'])) {
	$std_acc_id = $_POST['std_acc_id'];

	$sql = "INSERT INTO ad_stdUpd (ad_acc_id, ad_stdUpd_title, ad_stdUpd_msg, stds_acc_id) VALUES ('$ad_acc_id', 'Admission Status', 'Your submission for admission has been put on the pending list. Please wait for further account status.', '$std_acc_id');";
	$mysqli->query($sql);

	$mysqli->query("UPDATE stds_frm_addm SET stds_status_bool = 'PENDING' WHERE stds_acc_id = '$std_acc_id'");

	header('location: /website/user/profile/admin-dashboard.php');
	exit;
}
?>


<div class='equal-content margin-left-right'>
	<button type='submit' name='pending_admission' class='full-width' tabindex='-1'>Pending</button>
</div>
