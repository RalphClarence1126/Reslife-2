<?php
require('../../database/config.php');


ob_start();



?>


<div class="rounded-top gray padded margin-top" id="admissions">
	<h3>
		Pending Admissions
	</h3>
</div>

<div class="rounded-bottom light-gray padded">
	<h4>
		Admissions
	</h4>

	<?php
	$submissions = $mysqli->query("SELECT * FROM stds_frm_addm ORDER BY created_at ASC");

	if ($submissions) {
		while ($admissions = $submissions->fetch_assoc()) {
			$admissions_student_account_id = $admissions['stds_acc_id'];
			$admissions_student_picture = $admissions['stds_2x2_pic'];
			$admissions_student_number = $admissions['stds_std_number'];
			$admissions_student_lrn = $admissions['stds_std_lrn'];

			include('admn_submissions.user_template.php');
		}

		$submissions->free();
	}
	?>
</div>

<script>
	const admissions = document.getElementById('admissions');
	admissions.scrollIntoView(true);
</script>
