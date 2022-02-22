function setMainBodyHieight() {
	const body = document.getElementById('body').getBoundingClientRect();
	const bodyHeight = body.bottom - body.top;

	const navBar = document.getElementById('navBar').getBoundingClientRect();
	const navHeight = navBar.bottom - navBar.top;

	const mainHeight = bodyHeight - navHeight;
	document.getElementById('mainBody').style.height = `${mainHeight}px`;
}

// Call function on page load
setMainBodyHieight();

window.addEventListener("resize", function (event) {
	// Call function when browser resiZE
	setMainBodyHieight();
});

// Redundancy call function after page resize
setMainBodyHieight();
