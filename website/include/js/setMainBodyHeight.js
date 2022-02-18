function setMainBodyHieight() {
	const bodyHeight = document.getElementById('body').offsetHeight;

	const navHeight = document.getElementById('navBar').offsetHeight;

	const mainHeight = bodyHeight - navHeight;
	document.getElementById('mainBody').style.height = `${mainHeight}px`;
}

setMainBodyHieight();

window.addEventListener("resize", function (event) {
	setMainBodyHieight();
});
