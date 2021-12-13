<?php require_once('../include/templates/header.php'); ?>

<div>
	<section>
		<div class="white-container">
			<h1>
				Enroll
			</h1>
		</div>
	</section>

	<section>
		<div class="yellow-container">
			<h2>
				Online Enrollment Form
			</h2>

			<?php
			if ($_SERVER["REQUEST_METHOD"] == "POST") {

				include_once('include/notifications/is-enrolled.php');
			} else {
				include_once('include/notifications/is-not-enrolled.php');
			}
			?>
		</div>
	</section>
</div>


<?php require_once('../include/templates/footer.php'); ?>