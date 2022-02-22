<?php
// Main PHP File


session_start();
ob_start();


if (!empty($_POST) && isset($_POST['return'])) {
	header('location: /website/index.php');
	exit;
}
?>


<!DOCTYPE html>
<html lang="en">

<head>
	<meta charset="UTF-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>404 Error</title>

	<link rel="shortcut icon" href="/website/include/images/rtu-seal.png" type="image/x-icon">

	<link rel="stylesheet" href="/website/include/css/style.css">
</head>

<body>
	<div class="full-height center unselectable">
		<div class="equal-container-spaced fit-width rounded bordered">
			<div class="padded equal-content-spaced">
				<div class="full-height center">
					<a class="center" href="/index.php"><img src="/website/include/images/rtu-seal.png" alt="RTU Seal Logo" height="150" width="150" loading="lazy"></a>
				</div>
			</div>
			<div class="padded-left-right equal-content-spaced">
				<div class="full-height center">
					<div>
						<h2>404 Error</h2>

						<h4>That page you're looking for does not exist.</h4>

						<form action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>" method="post">
							<button type="submit" name="return" class="full-width" tabindex="-1">Return to main page</button>
						</form>
					</div>
				</div>
			</div>
		</div>
	</div>
</body>

</html>


<?php
ob_end_flush();
?>
