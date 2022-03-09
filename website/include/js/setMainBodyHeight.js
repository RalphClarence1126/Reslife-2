function setMainBodyHeight() {
	const body = document.getElementById('body').getBoundingClientRect();
	const bodyHeight = body.bottom - body.top;

	const header = document.getElementById('header').getBoundingClientRect();
	const headerHeight = header.bottom - header.top;

	const mainHeight = bodyHeight - headerHeight;
	document.getElementById('main').style.height = `${mainHeight}px`;
}

// Call function on page load
setMainBodyHeight();

window.addEventListener("resize", function (event) {
	// Call function when browser resize
	setMainBodyHeight();
});

// Redundancy call function after page resize
setMainBodyHeight();
