<?php
require('../../database/config.php');


session_start();
ob_start();


if (!empty($_POST) && isset($_POST['disable_enrollment'])) {
	$mysqli->query("UPDATE g_frm_enrll SET g_frm_enrll_bool = 0 WHERE g_frm_enrll_id = 1");

	header('location: /website/user/profile/admin-dashboard.php');
	exit;
}
if (!empty($_POST) && isset($_POST['enable_enrollment'])) {
	$mysqli->query("UPDATE g_frm_enrll SET g_frm_enrll_bool = 1 WHERE g_frm_enrll_id = 1");

	header('location: /website/user/profile/admin-dashboard.php');
	exit;
}


$disable_enrollment_button = '<button type="submit" name="disable_enrollment" class="red full-width" tabindex="-1">Disable Enrollments</button>';
$enable_enrollment_button = '<button type="submit" name="enable_enrollment" class="blue full-width" tabindex="-1">Enable Enrollments</button>';
?>


<form action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>" method="post">
	<?php
	echo ($mysqli->query("SELECT g_frm_enrll_bool FROM g_frm_enrll WHERE g_frm_enrll_id = 1")->fetch_object()->g_frm_enrll_bool) ? $disable_enrollment_button : $enable_enrollment_button;
	?>
</form>
