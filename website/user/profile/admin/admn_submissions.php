<?php
require('../../database/config.php');


ob_start();


if (!empty($_POST) && isset($_POST['filter'])) {
	$_SESSION['filter_filterRange'] = $_POST['filter_range'];
	$_SESSION['filter_filterGradeLevel'] = $_POST['filter_grade_level'];
	$_SESSION['filter_filterCourse'] = $_POST['filter_course'];

	$_SESSION['filter_filterStudentStatus'] = $_POST['filter_student_status'];
	$_SESSION['filter_filterType'] = $_POST['filter_type'];
	$_SESSION['filter_filterOrder'] = $_POST['filter_order'];

	header('location: /website/user/profile/admin-dashboard.php');
	exit;
}
if (!empty($_POST) && isset($_POST['reset'])) {
	$_SESSION['filter_filterRange'] = '';
	$_SESSION['filter_filterGradeLevel'] = '';
	$_SESSION['filter_filterCourse'] = '';

	$_SESSION['filter_filterStudentStatus'] = '';
	$_SESSION['filter_filterType'] = '';
	$_SESSION['filter_filterOrder'] = '';

	header('location: /website/user/profile/admin-dashboard.php');
	exit;
}


$filter_range = (!$_SESSION['filter_filterRange']) ? 10 : $_SESSION['filter_filterRange'];
$filter_grade_level = (!$_SESSION['filter_filterGradeLevel']) ? '' : $_SESSION['filter_filterGradeLevel'];
$filter_course = (!$_SESSION['filter_filterCourse']) ? '' : $_SESSION['filter_filterCourse'];

$filter_student_status = (!$_SESSION['filter_filterStudentStatus']) ? '' : $_SESSION['filter_filterStudentStatus'];
$filter_type = (!$_SESSION['filter_filterType']) ? 'created_at' : $_SESSION['filter_filterType'];
$filter_order = (!$_SESSION['filter_filterOrder']) ? 'ASC' : $_SESSION['filter_filterOrder'];


$sql = "SELECT MAX(stds_submission_id) AS max FROM stds_frm_addm";
$rowSQL = mysqli_query($mysqli, $sql);
$row = mysqli_fetch_array($rowSQL);
$total_submissions = $row['max'];
?>


<div class="padded-top-bottom border-top unselectable" id="admissions">
	<div class="padded-left-right">
		<h4>Pending Admissions<?php echo (!$total_submissions) ? '' : ' - ' . $total_submissions; ?></h4>
	</div>
</div>
<div class="padded-top-bottom border-top unselectable">
	<div class="padded-left-right">
		<button class="full-width accordion">Filter Options</button>
		<div class="panel" style="display: none;">
			<form action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>" method="post">
				<fieldset>
					<div class="equal-container margin-top-bottom">
						<div class="equal-content padded-right">
							<select class="full-width" name="filter_range">
								<option value='<?php echo $filter_range; ?>' hidden><?php echo $filter_range; ?></option>
								<option value="10">10</option>
								<option value="20">20</option>
								<option value="50">50</option>
								<option value="100">100</option>
								<option value="<?php echo (!$total_submissions) ? '' : $total_submissions; ?>"><?php echo (!$total_submissions) ? '' : $total_submissions; ?></option>
							</select><br>
							<label for="filter_range">Range</label>
						</div>
						<div class="equal-content padded-left-right">
							<select class="full-width" name="filter_grade_level">
								<option value='<?php echo $filter_grade_level; ?>' hidden><?php echo $filter_grade_level; ?></option>
								<option value="Grade 11">Grade 11</option>
								<option value="Grade 12">Grade 12</option>
							</select><br>
							<label for="filter_grade_level">Grade Level</label>
						</div>
						<div class="equal-content padded-left">
							<select class="full-width" name="filter_course">
								<option value='<?php echo $filter_course; ?>' hidden><?php echo $filter_course; ?></option>
								<option value="STEM">STEM</option>
								<option value="ABM">ABM</option>
								<option value="HUMSS">HUMSS</option>
								<option value="TVL - ICT">TVL - ICT</option>
							</select><br>
							<label for="filter_course">Course</label>
						</div>
					</div>
					<div class="equal-container margin-top-bottom">
						<div class="equal-content padded-right">
							<select class="full-width" name="filter_student_status">
								<option value='<?php echo $filter_student_status; ?>' hidden><?php echo $filter_student_status; ?></option>
								<option value="New Student">New Student</option>
								<option value="Old Student">Old Student</option>
							</select><br>
							<label for="filter_student_status">Student Status (Old/New Student)</label>
						</div>
						<div class="equal-content padded-left-right">
							<select class="full-width" name="filter_type">
								<option value='<?php echo $filter_type; ?>' hidden><?php
																					switch ($filter_type) {
																						case 'created_at':
																							echo "Created At";
																							break;
																						case 'stds_std_number':
																							echo "Student Number";
																							break;
																						case 'stds_std_lrn':
																							echo "Student LRN";
																							break;
																					}
																					?></option>
								<option value="created_at">Created At</option>
								<option value="stds_std_number">Student Number</option>
								<option value="stds_std_lrn">Student LRN</option>
							</select><br>
							<label for="filter_type">Type</label>
						</div>
						<div class="equal-content padded-left">
							<select class="full-width" name="filter_order">
								<option value='<?php echo $filter_order; ?>' hidden><?php
																					switch ($filter_order) {
																						case 'ASC':
																							echo "Ascending";
																							break;
																						case 'DESC':
																							echo "Descending";
																							break;
																					}
																					?></option>
								<option value="ASC">Ascending</option>
								<option value="DESC">Descending</option>
							</select><br>
							<label for="filter_order">Order</label>
						</div>
					</div>
				</fieldset>

				<div class="equal-container-spaced margin-top">
					<div class="equal-content-spaced half-width padded-right">
						<div class="center padded-right">
							<button type="submit" name="filter" class="full-width" tabindex="-1">Filter</button>
						</div>
					</div>
					<div class="equal-content-spaced">
						<div class="center">
							<button type="submit" name="reset" class="red" tabindex="-1">Reset</button>
						</div>
					</div>
				</div>
			</form>
		</div>
	</div>
</div>
<div class="padded-top-bottom border-top">
	<div class="padded-left-right">
		<?php
		// TO DO: Refactor
		if ($filter_grade_level && $filter_course && $filter_student_status) {
			$where_filter = "WHERE stds_grade_level = '$filter_grade_level' AND stds_admission_strand = '$filter_course' AND stds_student_status = '$filter_student_status'";
		}

		if (!$filter_grade_level && $filter_course && $filter_student_status) {
			$where_filter = "WHERE stds_admission_strand = '$filter_course' AND stds_student_status = '$filter_student_status'";
		}
		if ($filter_grade_level && !$filter_course && $filter_student_status) {
			$where_filter = "WHERE stds_grade_level = '$filter_grade_level' AND stds_student_status = '$filter_student_status'";
		}
		if ($filter_grade_level && $filter_course && !$filter_student_status) {
			$where_filter = "WHERE stds_grade_level = '$filter_grade_level' AND stds_admission_strand = '$filter_course'";
		}

		if ($filter_grade_level && !$filter_course && !$filter_student_status) {
			$where_filter = "WHERE stds_grade_level = '$filter_grade_level'";
		}

		if (!$filter_grade_level && $filter_course && !$filter_student_status) {
			$where_filter = "stds_admission_strand = '$filter_course'";
		}

		if (!$filter_grade_level && !$filter_course && $filter_student_status) {
			$where_filter = "stds_student_status = '$filter_student_status'";
		}

		if (!$filter_grade_level && !$filter_course && !$filter_student_status) {
			$where_filter = "";
		}


		$sql = "SELECT * FROM stds_frm_addm $where_filter ORDER BY $filter_type $filter_order";
		// echo $sql;

		$submissions = mysqli_query($mysqli, $sql);

		$index_range = 0;
		if ($submissions) {
			if (mysqli_num_rows($submissions) > 0) {
				while ($admissions = $submissions->fetch_assoc()) {
					$admissions_student_account_id = $admissions['stds_acc_id'];
					$admissions_student_picture = $admissions['stds_2x2_pic'];
					$admissions_student_number = $admissions['stds_std_number'];
					$admissions_student_lrn = $admissions['stds_std_lrn'];

					if ($index_range < $filter_range) {
						include('admn_submissions.user_template.php');
					}

					$index_range++;
				}

				$submissions->free();
			} else {
				echo "<div class='center unselectable margin-top-bottom'><h6>There are no pending admissions at the moment.</h6></div>";
			}
		} else {
			echo "<div class='center unselectable margin-top-bottom'><h6>Failed sorting submissions.</h6></div>";
		}
		?>
	</div>
</div>

<script>
	const admissions = document.getElementById('admissions');
	admissions.scrollIntoView(true);


	const accordions = document.getElementsByClassName("accordion");
	for (let index = 0; index < accordions.length; index++) {
		accordions[index].addEventListener("click", function() {
			const panel = this.nextElementSibling;
			if (panel.style.display === "block") {
				panel.style.display = "none";
			} else {
				panel.style.display = "block";
			}
		});
	}
</script>
