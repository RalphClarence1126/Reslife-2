const systemDate = new Date;
const currentDate = systemDate.getFullYear().toString();

const inputStudentBirthYear = document.getElementById('student-birthdate-year');
const inputStudentBirthAge = document.getElementById('student-age');

let getStudentBirthYear, getStudentBirthAge;

let timeout = null;
inputStudentBirthYear.addEventListener('keyup', function () {
	clearTimeout(timeout);
	timeout = setTimeout(() => {
		getStudentBirthYear = inputStudentBirthYear.value.toString();
		getStudentBirthAge = inputStudentBirthAge.value.toString();
		if (!getStudentBirthAge) {
			return;
		} else {
			const expectedUserAge = currentDate - getStudentBirthYear;
			if (!getStudentBirthYear) return;
			if ((expectedUserAge - getStudentBirthAge) > 100) return;
			if (getStudentBirthAge < expectedUserAge) {
				return alert(`Your age does not match your birthday.\nPlease add +${expectedUserAge - getStudentBirthAge} to your input age.\n\nExpected age input: ${expectedUserAge}`);
			} else if (getStudentBirthAge > expectedUserAge) {
				return alert(`Your age does not match your birthday.\nPlease subtract -${getStudentBirthAge - expectedUserAge} to your input age.\n\nExpected age input: ${expectedUserAge}`);
			} else {
				return;
			}
		}
	}, 1000);
});

inputStudentBirthAge.addEventListener('keyup', function () {
	clearTimeout(timeout);
	timeout = setTimeout(() => {
		getStudentBirthYear = inputStudentBirthYear.value.toString();
		getStudentBirthAge = inputStudentBirthAge.value.toString();
		if (!getStudentBirthYear) {
			return;
		} else {
			const expectedUserAge = currentDate - getStudentBirthYear;
			if (!getStudentBirthAge) return;
			if ((expectedUserAge - getStudentBirthAge) > 100) return;
			if (getStudentBirthAge < expectedUserAge) {
				return alert(`Your age does not match your birthday.\nPlease add +${expectedUserAge - getStudentBirthAge} to your input age.\n\nExpected age input: ${expectedUserAge}`);
			} else if (getStudentBirthAge > expectedUserAge) {
				return alert(`Your age does not match your birthday.\nPlease subtract -${getStudentBirthAge - expectedUserAge} to your input age.\n\nExpected age input: ${expectedUserAge}`);
			} else {
				return;
			}
		}
	}, 1000);
});
