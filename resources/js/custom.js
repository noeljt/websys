// Calculate time to graduation
var start 			= new Date(2014, 8-1, 25), // August 25, 2014
		today 			= new Date();
		graduation 	= new Date(2018, 5-1, 20), // May 20, 2018
		diff 				= 100 - ((graduation - today) / (graduation - start) * 100);
// Add percentage to title over progress bar
$("#grad_title").append(": " + Math.round(diff) + "% of the way there!");
// Initialize progressbar for scroll reveal to work
$("#progressBar").progressbar({
  value: 1
});
// customize config to grow progressbar AFTER it appears
var config = {
	reset: false,
	afterReveal: function(el) {
    $("#progressBar > .ui-progressbar-value").animate({
        width: diff + "%"
    }, 'slow');
	}
};
// Initialize scroll reveal
window.sr = new ScrollReveal(config);
// Make progressbar value appear on viewport
sr.reveal("#progressBar > .ui-progressbar-value");