function addInput(parentDiv) {
	let newInput = document.createElement('div');
	newInput.innerHTML =
		'<label for="package">Package</label> <input type="text" name="package[]"> <label for="price">Price</label> <input type="text" name="price[]"></input>';
	document.getElementById(parentDiv).appendChild(newInput);
}
