function setMainBodyWidth() {
	const body = document.getElementById('body').getBoundingClientRect();
	const bodyHeight = body.right - body.left;
	console.log(`${body.right} - ${body.left} = ${bodyHeight}`);

	const menu = document.getElementById('menu').getBoundingClientRect();
	const menuHeight = menu.right - menu.left;
	console.log(`${menu.right} - ${menu.left} = ${menuHeight}`);

	const mainWidth = bodyHeight - menuHeight;
	console.log(`${mainWidth}`);
	document.getElementById('main').style.width = `${mainWidth}px`;
}

// Call function on page load
setMainBodyWidth();

window.addEventListener("resize", function (event) {
	// Call function when browser resize
	setMainBodyWidth();
});

// Redundancy call function after page resize
setMainBodyWidth();
