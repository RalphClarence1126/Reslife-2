<?php
require('../../database/config.php');


session_start();
ob_start();


if (!empty($_POST) && isset($_POST['disable_admission'])) {
	$mysqli->query("UPDATE g_frm_admn SET g_frm_admn_bool = 0 WHERE g_frm_admn_id = 1");

	header('location: /website/user/profile/admin-dashboard.php');
	exit;
}
if (!empty($_POST) && isset($_POST['enable_admission'])) {
	$mysqli->query("UPDATE g_frm_admn SET g_frm_admn_bool = 1 WHERE g_frm_admn_id = 1");

	header('location: /website/user/profile/admin-dashboard.php');
	exit;
}


$disable_admission_button = '<button type="submit" name="disable_admission" class="red full-width" tabindex="-1">Disable Admissions</button>';
$enable_admission_button = '<button type="submit" name="enable_admission" class="blue full-width" tabindex="-1">Enable Admissions</button>';
?>


<form action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>" method="post">
	<?php
	echo ($mysqli->query("SELECT g_frm_admn_bool FROM g_frm_admn WHERE g_frm_admn_id = 1")->fetch_object()->g_frm_admn_bool) ? $disable_admission_button : $enable_admission_button;
	?>
</form>
