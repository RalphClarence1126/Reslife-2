<?php
require('../../database/config.php');


ob_start();


if (isset($_POST['disable_enrollment'])) {
	$mysqli->query("UPDATE g_frm_enrll SET g_frm_enrll_bool = 0 WHERE g_frm_enrll_id = 1");

	header('location: /website/user/profile/admin.dashboard.php');
	exit;
}
?>


<form action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>" method="post">
	<button type="submit" name="disable_enrollment" class="red full-width" tabindex="-1">
		Disable Enrollments
	</button>
</form>
