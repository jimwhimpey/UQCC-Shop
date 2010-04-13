// Count object properties
function countProperties(obj) {
				var count = 0;
	for (var prop in obj) {
        if (obj.hasOwnProperty(prop))
                ++count;
    }
    return count;
}