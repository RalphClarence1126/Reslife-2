<?php require('../include/templates/header.php'); ?>

<div>
	<section>
		<div class="white-container">
			<h1>
				Enroll
			</h1>

			<?php
			function isMobileDevice()
			{
				return preg_match(
					"/(android|avantgo|blackberry|bolt|boost|cricket|docomo|fone|hiptop|mini|mobi|palm|phone|pie|tablet|up\.browser|up\.link|webos|wos)/i",
					$_SERVER["HTTP_USER_AGENT"]
				);
			}

			if (isMobileDevice()) {
				include_once('../include/notifications/is-mobile.php');
			} else {
				include_once('../include/notifications/is-not-mobile.php');
			}
			?>
		</div>
	</section>

	<section>
		<div class="yellow-container">
			<h2>
				Online Enrollment Form
			</h2>

			<div>
				<?php require_once('include/enrollment-form.php'); ?>
			</div>
		</div>
	</section>
</div>

<?php require('../include/templates/footer.php'); ?>