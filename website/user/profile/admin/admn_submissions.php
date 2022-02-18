<?php
require('../../database/config.php');


ob_start();



?>


<div class="padded-top-bottom border-top unselectable" id="admissions">
	<div class="padded-left-right">
		<h4>Pending Admissions</h4>
	</div>
</div>
<div class="padded-top-bottom border-top">
	<div class="padded-left-right">
		<?php
		$submissions = $mysqli->query("SELECT * FROM stds_frm_addm ORDER BY created_at ASC");

		if (mysqli_num_rows($submissions) > 0) {
			while ($admissions = $submissions->fetch_assoc()) {
				$admissions_student_account_id = $admissions['stds_acc_id'];
				$admissions_student_picture = $admissions['stds_2x2_pic'];
				$admissions_student_number = $admissions['stds_std_number'];
				$admissions_student_lrn = $admissions['stds_std_lrn'];

				include('admn_submissions.user_template.php');
			}

			$submissions->free();
		} else {
			echo "<div class='center unselectable margin-top-bottom'><h6>There are no pending admissions at the moment.</h6></div>";
		}
		?>
	</div>
</div>

<script>
	const admissions = document.getElementById('admissions');
	admissions.scrollIntoView(true);
</script>
