<?php require_once('../include/templates/header.php'); ?>

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
				include_once('../include/notifications/is-mobile.html');
			} else {
				include_once('../include/notifications/is-not-mobile.html');
			}
			?>
		</div>
	</section>

	<section>
		<div class="yellow-container">
			<h2>
				Online Enrollment Form
			</h2>


			<h3>
				NOTE: All those marked with a red asterisk<span style="color: rgb(255, 55, 55);">*</span> is required and should be answered.
			</h3>

			<div>
				<?php require_once('include/enrollment-form.html'); ?>
			</div>
		</div>
	</section>
</div>

<?php require_once('../include/templates/footer.php'); ?>