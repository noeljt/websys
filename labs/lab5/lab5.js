$(document).ready(function() {
	var items = "<li>This is an item in the list. Click to make me disappear.</li>";		
	$("#foo").append(items.repeat(5000));

	$("#foo").click( function(e) {
		if (e.target && e.target.nodeName == "LI") {
			$(e.target).hide(400);
		}
	});
	$("#showall").click(function(e) {
		$("li").show(400);
	});

});