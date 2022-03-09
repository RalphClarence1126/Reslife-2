<?php
require('../../database/config.php');


ob_start();


if (!empty($_POST) && isset($_POST['page_next'])) {
	$_SESSION['page_number'] += 1;

	header('location: /website/user/profile/admin-dashboard.php');
	exit;
}
if (!empty($_POST) && isset($_POST['page_back'])) {
	$_SESSION['page_number'] -= 1;

	header('location: /website/user/profile/admin-dashboard.php');
	exit;
}
?>


<div class="margin-top">
	<div class="equal-container">
		<div class="equal-content margin-right unselectable">
			<?php
			$total_page = ($_SESSION['pagination_check'] == 0) ? $_SESSION['pagination_number'] : (($_SESSION['pagination_check'] != 0) ? $_SESSION['pagination_number'] += 1 : $_SESSION['pagination_number']);

			$current_page = $_SESSION['page_number'] + 1;
			?>

			<h6>Showing page <?php echo $current_page; ?> of <?php echo $total_page; ?></h6>
		</div>
		<div class="equal-content margin-left">
			<form class="center full-width full-height" action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>" method="post">
				<div class="full-height equal-container">
					<div class="center equal-content margin-right">
						<?php echo ($current_page == 1) ? '' : '<button type="submit" name="page_back" class="full-width" tabindex="-1">Back</button>'; ?>
					</div>
					<div class="center equal-content margin-left">
						<?php echo ($current_page == $total_page) ? '' : '<button type="submit" name="page_next" class="full-width" tabindex="-1">Next</button>'; ?>
					</div>
				</div>
			</form>
		</div>
	</div>
</div>
