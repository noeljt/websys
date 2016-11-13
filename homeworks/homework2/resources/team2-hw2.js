$(document).ready(function() {
	(function( $ ) {
	    $.fn.hexed = function( settings ) {
	    	// Clear beggining of every game
	    	$(this).empty();
		 		// Starting values
	   		var difficulty = 5,
	   				turns = 10,
	   				round = 1,
	   				time = $.now(),
	   				total = 0;
	   				r = 0;
	   				g = 0;
	   				b = 0;
	   		// If settings are present, assign them
	   		if (settings) {
	   			if (settings.difficulty) {
	   				difficulty = settings.difficulty;
	   			}
	   			if (settings.turns) {
	   				turns = settings.turns;
	   			}
	   		}
	   		// Add Title
	   		this.append("<img src='resources/HEXXED.png'>");
	   		// Add Sliders
	   		this.append("<div class='wrapper'>\
	   					 <div class='left'>\
		   					 <p class='desc'>Difficulty</p>\
		   					 <input type='text' id='difficulty' value='0'/>\
		   				 </div>\
		   				 <div class='right'>\
		   					 <p class='desc'>Turns</p>\
		   					 <input type='text' id='turns' value='0'/>\
		   				 </div>\
		   				 </div");
	   		$("#difficulty").spinner({
	   			disabled: true,
	   			min: 0,
	   			max: 10,
	   			change: function() { // limit greater/smaller values
			        var min = $(this).spinner('option', 'min');
			        var max = $(this).spinner('option', 'max');

			        if (isNaN($(this).val())) {
			            $(this).spinner("value", min);
			        } else if ($(this).val() > max) {
			            $(this).spinner("value", max);
			        } else if ($(this).val() < min) {
			            $(this).spinner("value", min);
			        }
				}
	   		}).val(difficulty);
	   		$("#turns").spinner({
	   			disabled: true,
	   			min: 0,
	   			change: function() { // limit greater/smaller values
			        var min = $(this).spinner('option', 'min');
			        var max = $(this).spinner('option', 'max');

			        if (isNaN($(this).val())) {
			            $(this).spinner("value", min);
			        } else if ($(this).val() < min) {
			            $(this).spinner("value", min);
			        }
				}
	   		}).val(turns);
	   		// Random Color box
	   		var r = Math.floor(Math.random() * 255) + 1;
	   		var g = Math.floor(Math.random() * 255) + 1;
	   		var b = Math.floor(Math.random() * 255) + 1;
	   		this.append("<div class='wrapper'>\
	   								 <div class='left'>\
					   					 <p class='desc'>Random</p>\
					   					 <div id='Lcolor'></div>\
					   				 </div>\
					   				 <div class='right'>\
					   					 <p class='desc'>Player</p>\
					   					 <div id='Rcolor'></div>\
 					   				 </div>\
 					   				 </div>\
					   					 <div id='red'></div>\
					   					 <div id='green'></div>\
					   					 <div id='blue'></div>");
	   		$("#Lcolor").css("background-color", "rgb("+r+","+g+","+b+")");
	   		// Player color box and rgb sliders
	   		function refreshColor() {
		    	var red = $("#red").slider("value"),
		        	green = $("#green").slider("value"),
		        	blue = $("#blue").slider("value");
		      	$("#Rcolor").css("background-color","rgb("+red+","+green+","+blue+")");
		    };
		    $("#red, #green, #blue").slider({
		      orientation: "horizontal",
		      range: "min",
		      max: 255,
		      value: 127,
		      slide: refreshColor,
		      change: refreshColor
		    });
		    $("#red").slider("value",127);
		    // New game button - hidden to start
		    this.append("<div id='newGame'></div>");
	   		$("#newGame").button({
	   			label:"New Game?"
	   		}).on("click", function() {
	   			$("#hexed").hexed({
	   				difficulty: $("#difficulty").spinner("value"),
	   				turns: $("#turns").spinner("value")
	   			});
	   		}).hide();
	   		// Next button - appears after Check It
		   	this.append("<div id='next'></div>");
	   		$("#next").button({
	   			label:"Next"
	   		}).on("click", function() {
		    	// Increment round
		    	$("#turns").val(turns-round);
		    	round++;
		    	// New Random Color
		    	r = Math.floor(Math.random() * 255) + 1,
	   			g = Math.floor(Math.random() * 255) + 1,
	   			b = Math.floor(Math.random() * 255) + 1;
	   			$("#Lcolor").css("background-color", "rgb("+r+","+g+","+b+")");
	   			// Reset slider values
	   			$("#red, #green, #blue").slider("value", 127);
	   			$(this).hide();
	   			$("#check").show();
	   			// Reset time
	   			time = $.now();
	   		}).hide();
	   		// Check It! button
		   	this.append("<div id='check'></div>");
	   		$("#check").button({
	   			label:"Check It!"
	   		}).on("click", function() {
	   			// Calculate error and score
	   			var delay = $.now()-time,
   					errorRed	= Math.abs(((r-$("#red").slider(	"option","value"))/255)*100),
   					errorGreen	= Math.abs(((g-$("#green").slider(	"option","value"))/255)*100),
   					errorBlue 	= Math.abs(((b-$("#blue").slider(	"option","value"))/255)*100),
   					error = (errorRed+errorGreen+errorBlue)/3,
   					score = ((15 - difficulty - error)/(15 - difficulty))*(15000-delay);
	   			if (score<0) {score=0;} // Negative score
	   			if (delay>=15000) {score=0;} // Bug fix
	   			total += score; // Add round to total score
	   			// Report the score
	   			$("#score").empty().text("Score: " + score.toFixed(2));
	   			$("#total").empty().text("Total: " + total.toFixed(2));
	   			$("#colorSubmitted").empty().html("<h4 style='color:white'>Submitted:</h4><ul style='color:white'><li>Red: " + $("#red").slider(	"option","value").toString(16) + "</li><li>Green: " + $("#green").slider(	"option","value").toString(16) + "</li><li>Blue: " + $("#blue").slider(	"option","value").toString(16) + "</li></ul>");
	   			$("#percError").empty().html("<h4 style='color:white'>Error:</h4><ul style='color:white'><li>Red: " + Math.round(errorRed) + "%</li><li>Green: " + Math.round(errorGreen) + "%</li><li>Blue: " + Math.round(errorGreen) + "%</li></ul>");
	   			// Game over
	   			if (round==turns) {
	   				$(this).hide();
	   				$("#newGame").show();
	   				$("#difficulty, #turns").spinner("enable");
	   				$("#turns").val(turns);
	   			} else { // Next round/turn
		   			$(this).hide();
		   			$("#next").show();
		   		}
	   		});
	   		// Divs for scoring
   			this.append("<div class='wrapper'><div class='left'><div id='score'></div><div id='colorSubmitted'></div> </div><div class='right'><div id='total'></div><div id='percError'></div></div></div>");
	 			// Return self for chaining
	      return this;
	    };
	}( jQuery ));
	// Call initial game
	$("#hexed").hexed();
});