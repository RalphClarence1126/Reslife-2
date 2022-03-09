<?php
require('../../database/config.php');


ob_start();


if (!empty($_POST) && isset($_POST['filter'])) {
	$_SESSION['filter'] = 1;

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
	$_SESSION['filter'] = 0;

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
?>


<div class="padded-top-bottom border-top unselectable">
	<div class="padded-left-right">
		<div class="padded-top-bottom accordion">
			<button class="full-width">Filter Options</button>
		</div>
		<div class="panel" style="display: <?php echo ($_SESSION['filter']) ? 'block' : 'none'; ?>;">
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
								<option value="200">200</option>
								<option value="500">500</option>
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

				<div class="equal-container-spaced padded-top-bottom">
					<div class="equal-content-spaced half-width padded-right">
						<div class="center padded-right">
							<button type="submit" name="filter" class="blue full-width" tabindex="-1">Filter</button>
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
<div class="padded-top-bottom border-top unselectable" id="enrollments">
	<div class="padded-left-right">
		<h4>Waiting Enrollments</h4>
	</div>
</div>
<div class="padded-top-bottom border-top">
	<div class="padded-left-right">
		<div class='center unselectable padded-top-bottom'>
			<h6>There are no waiting enrollments at the moment.</h6>
		</div>
	</div>
</div>
<div class="padded-top-bottom border-top unselectable" id="enrollments">
	<div class="padded-left-right">
		<h4>Pending Enrollments</h4>
	</div>
</div>
<div class="padded-top-bottom border-top">
	<div class="padded-left-right">
		<div class='center unselectable padded-top-bottom'>
			<h6>There are no pending enrollments at the moment.</h6>
		</div>
	</div>
</div>

<script>
	const enrollments = document.getElementById('enrollments');
	enrollments.scrollIntoView(true);


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
