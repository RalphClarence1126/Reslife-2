<?php
require('../../database/config.php');


ob_start();


if (isset($_POST['disable_admission'])) {
	$mysqli->query("UPDATE g_frm_admn SET g_frm_admn_bool = 0 WHERE g_frm_admn_id = 1");

	header('location: /website/user/profile/admin.dashboard.php');
	exit;
}
?>


<form action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>" method="post">
	<button type="submit" name="disable_admission" class="red full-width" tabindex="-1">
		Disable Admissions
	</button>
</form>
