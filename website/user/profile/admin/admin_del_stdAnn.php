<?php
require('../../database/config.php');


ob_start();


if (!empty($_POST) && isset($_POST['del_stdAnn'])) {
	$stdAnn_id = $_POST['stdAnn_id'];

	$mysqli->query("DELETE FROM ad_stdAnn WHERE ad_stdAnn_id = '$stdAnn_id'");

	header('location: /website/user/profile/admin-announcements.php');
	exit;
}
?>


<div class='padded'>
	<form action='<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>' method='post'>
		<input type="hidden" name="stdAnn_id" value='<?php echo $announcement_id; ?>'>
		<button type='submit' name='del_stdAnn' class='red full-width'>Delete Announcement</button>
	</form>
</div>
