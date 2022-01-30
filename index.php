<?php
// Main PHP File

session_start();

// Check if user is already logged in
if (isset($_SESSION['valid']) && !empty($_SESSION['valid'])) {

	// Redirect to profile page
	// header('location: /website/user/profile/student.php');
	// exit;
	header('refresh: 2; url = /website/user/profile/student.php');
} else {

	// Default redirect
	// header('location: /website/login.php');
	// exit;
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

<body>
	<div class="full-height center fade-in">
		<img src="/website/include/images/rtu-seal.png" alt="RTU Seal Logo" height="200" width="200" loading="lazy">
	</div>
</body>

</html>