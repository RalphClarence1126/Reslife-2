<?php
require('../../database/config.php');


ob_start();
?>

<div class="padded-top-bottom border-top unselectable" id="admissions">
	<div class="padded-left-right">
		<h4>Pending Enrollments</h4>
	</div>
</div>
<div class="padded-top-bottom border-top">
	<div class="padded-left-right">
		<div class='center unselectable margin-top-bottom'>
			<h6>There are no pending enrollments at the moment.</h6>
		</div>
	</div>
</div>

<script>
	const enrollments = document.getElementById('enrollments');
	enrollments.scrollIntoView(true);
</script>
