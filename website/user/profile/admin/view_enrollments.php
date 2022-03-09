<?php
require('../../database/config.php');


session_start();
ob_start();


if (!empty($_POST) && isset($_POST['show_enrollments'])) {
	$_SESSION['show_admissions'] = 0;
	$_SESSION['show_enrollments'] = 1;

	header('location: /website/user/profile/admin-dashboard.php');
	exit;
}
if (!empty($_POST) && isset($_POST['hide_enrollments'])) {
	$_SESSION['show_admissions'] = 0;
	$_SESSION['show_enrollments'] = 0;

	header('location: /website/user/profile/admin-dashboard.php');
	exit;
}


$hide_enrollments_button = '<button class="red full-width" type="submit" name="hide_enrollments" tabindex="-1">Hide Student Enrollments</button>';
$show_enrollments_button = '<button class="blue full-width" type="submit" name="show_enrollments" tabindex="-1">Show Student Enrollments</button>';
?>



<form action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>" method="post">
	<?php
	echo (!$_SESSION['show_enrollments']) ? $show_enrollments_button : $hide_enrollments_button;
	?>
</form>
