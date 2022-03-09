<?php
require('../../database/config.php');


session_start();
ob_start();


if (!empty($_POST) && isset($_POST['hide_admissions'])) {
	$_SESSION['show_admissions'] = 0;
	$_SESSION['show_enrollments'] = 0;

	header('location: /website/user/profile/admin-dashboard.php');
	exit;
}
if (!empty($_POST) && isset($_POST['show_admissions'])) {
	$_SESSION['show_admissions'] = 1;
	$_SESSION['show_enrollments'] = 0;

	header('location: /website/user/profile/admin-dashboard.php');
	exit;
}


$hide_admissions_button = '<button class="red full-width" type="submit" name="hide_admissions" tabindex="-1">Hide Student Admissions</button>';
$show_admissions_button = '<button class="blue full-width" type="submit" name="show_admissions" tabindex="-1">Show Student Admissions</button>';
?>



<form action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>" method="post">
	<?php
	echo (!$_SESSION['show_admissions']) ? $show_admissions_button : $hide_admissions_button;
	?>
</form>
