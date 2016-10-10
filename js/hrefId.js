$('a.local').each(
    function () {
		// get the href attribute
		var href = $(this).attr('href');
		// does it have a href?
		if (href) {
			var lastSlash = window.location.toString().lastIndexOf("/");
			var new_href = window.location.toString().substr(0, lastSlash + 1) + href;
			$(this).attr('href', new_href);
		}
	});