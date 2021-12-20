function verifyReset() {
	if (confirm("Are you sure to reset your enrollment form?")) {
		let inputArray = document.getElementsByTagName("input");
		for (let i = 0; i < inputArray.length; i++) {
			inputArray[i].value = '';
		}

		let selectArray = document.getElementsByTagName("select");
		for (let i = 0; i < selectArray.length; i++) {
			selectArray[i].value = '';
		}

		document.getElementById('student-application-grade').value = 'Default';

		document.getElementById('student-enrollment-status').value = '';
		document.getElementById('student-enrollment-status').disabled = true;

		document.getElementById('student-number').removeAttribute('placeholder');
		document.getElementById('student-number').disabled = true;

		document.getElementById('student-strand-preference').value = 'Default';

		document.getElementById("reset").value = "Reset Form";
	}
}


const inputStudentBirthYear = document.getElementById('student-birthdate-year');
const inputStudentBirthAge = document.getElementById('student-age');
let getStudentBirthYear, getStudentBirthAge;

function validateYearAndAge(studentBirthYear, studentBirthAge) {
	const getSystemDate = new Date, currentYear = getSystemDate.getFullYear().toString();
	const expectedStudentAge = currentYear - studentBirthYear;
	if ((expectedStudentAge - studentBirthAge) > 100) return;
	if (studentBirthAge < expectedStudentAge) {
		return alert(`Your age does not match your birthday.\nPlease add +${expectedStudentAge - studentBirthAge} to your input age.\n\nExpected age input: ${expectedStudentAge}`);
	} else if (studentBirthAge > expectedStudentAge) {
		return alert(`Your age does not match your birthday.\nPlease subtract -${studentBirthAge - expectedStudentAge} to your input age.\n\nExpected age input: ${expectedStudentAge}`);
	} else {
		return;
	}
}

inputStudentBirthYear.addEventListener('focusout', function () {
	getStudentBirthYear = inputStudentBirthYear.value.toString();
	getStudentBirthAge = inputStudentBirthAge.value.toString();
	if (!getStudentBirthAge) {
		return;
	} else {
		if (!getStudentBirthYear) return;
		return validateYearAndAge(getStudentBirthYear, getStudentBirthAge);
	}
});
inputStudentBirthAge.addEventListener('focusout', function () {
	getStudentBirthYear = inputStudentBirthYear.value.toString();
	getStudentBirthAge = inputStudentBirthAge.value.toString();
	if (!getStudentBirthYear) {
		return;
	} else {
		if (!getStudentBirthAge) return;
		return validateYearAndAge(getStudentBirthYear, getStudentBirthAge);
	}
});


const getEnrollmentForm = document.getElementById('student-enrollment-form');
getEnrollmentForm.addEventListener('keypress', function (event) {
	if (event.getModifierState('CapsLock')) {
		alert('You have capslock on.\n\nThe enrollment form will automatically all caps your input.')
	}
	if (event.key === 'Enter') {
		event.preventDefault();
	}
});
