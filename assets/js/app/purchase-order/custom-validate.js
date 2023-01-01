function isEmpty(value) {
	return typeof value == 'string' && !value.trim() || typeof value == 'undefined' || value === null;
}

function roundToTwo(num) {
    return +(Math.round(num + "e+2")  + "e-2");
}