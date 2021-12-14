const applicationStudentGrade = document.getElementById('student-application-grade');
const applicationEnrollmentStatus = document.getElementById('student-enrollment-status');
const applicationStudentNumber = document.getElementById('student-number');

document.getElementById('student-application-grade').value = 'Default';
document.getElementById('student-enrollment-status').value = '';
document.getElementById('student-strand-preference').value = 'Default';

applicationStudentGrade.addEventListener('change', function () {
	if (applicationStudentGrade.value === 'Grade 12') {
		applicationEnrollmentStatus.disabled = false;

		document.getElementById('student-enrollment-status').value = 'Default';
	}
	else {
		document.getElementById('student-enrollment-status').value = '';

		applicationEnrollmentStatus.disabled = true;
		applicationEnrollmentStatus.value = 'New Student';
		applicationStudentNumber.disabled = true;
	}
});

applicationEnrollmentStatus.addEventListener('change', function () {
	if (applicationEnrollmentStatus.value === 'Old Student') {
		applicationStudentNumber.disabled = false;
		applicationStudentNumber.setAttribute('required', '');
		applicationStudentNumber.setAttribute('placeholder', '1234-123456');
	}
	else {
		applicationStudentNumber.disabled = true;
		applicationStudentNumber.value = '';
		applicationStudentNumber.removeAttribute('required');
		applicationStudentNumber.removeAttribute('placeholder');
	}
});
