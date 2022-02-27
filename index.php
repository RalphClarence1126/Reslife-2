<?php
// Main PHP File


// phpinfo();
// exit;


session_start();
ob_start();


if (isset($_COOKIE['valid_admin']) && !empty($_COOKIE['valid_admin'])) {
	header('refresh: 2; url = /website/user/profile/admin-dashboard.php');
} else if (isset($_COOKIE['valid_student']) && !empty($_COOKIE['valid_student'])) {
	header('refresh: 2; url = /website/user/profile/student-dashboard.php');
} else {
	header('refresh: 2; url = /website/login.php');
}
?>


<!DOCTYPE html>
<html lang="en">

<head>
	<meta charset="UTF-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>Prototype Website</title>

	<link rel="shortcut icon" href="/website/include/images/rtu-seal.png" type="image/x-icon">

	<link rel="stylesheet" href="/website/include/css/style.css">
</head>

<body style="cursor: wait;">
	<div class="center" style="height: 100% !important;">
		<img src="/website/include/images/rtu-seal.png" alt="RTU Seal Logo" height="200" width="200" loading="lazy">
	</div>
</body>

</html>


<?php
ob_end_flush();
?>
