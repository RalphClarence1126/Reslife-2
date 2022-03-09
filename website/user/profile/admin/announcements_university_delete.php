<?php
require('../../database/config.php');


ob_start();


if (!empty($_POST) && isset($_POST['del_uniAnn'])) {
	$uniAnn_id = $_POST['uniAnn_id'];

	$mysqli->query("DELETE FROM ad_uniAnn WHERE ad_uniAnn_id = '$uniAnn_id'");

	header('location: /website/user/profile/admin-announcements.php');
	exit;
}
?>


<div class='padded'>
	<form action='<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>' method='post'>
		<input type="hidden" name="uniAnn_id" value='<?php echo $announcement_id; ?>'>
		<button type='submit' name='del_uniAnn' class='red full-width'>Delete Announcement</button>
	</form>
</div>
