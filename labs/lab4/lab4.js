$(document).ready(function() {
	$("#site").click(function(event) {
		// Empty any html already present
		$(document.body).empty();
		// Load/Parse JSON
		$.getJSON("playlist.json", function(data) {
			// Array for easy html/text management
			var items = [];
			// Starting html - playList ul and column titles
			items.push("<ul id='playlist'>");
			var headers = "<li class='song'> \
							<ul id='songInfoColumns'> \
							<li class='trackName'>" + data[0].track + "</li> \
							<li class='artist'>" + data[0].artist + "</li> \
							<li class='album'>" + data[0].album + "</li> \
							<li class='albumCover'>" + data[0].albumArt + "</li> \
							<li class='releaseDate'>" + data[0].release + "</li> \
							<li class='genre'>" + data[0].genres[0] + "</li> \
							</ul> \
							</li>";
			items.push(headers);
			// Pull data from JSON
			$.each(data, function(key, val) {
				// Already added column titles so skip item 0
				if (key=="0") {return true;}
				// Since genres are their own list, create first
				var genres = "";
				$.each(val.genres, function(i, g) {
					genres += "<li class='genreItem'>" + g + "</li>";
				});
				// Add all the song info to items
				items.push("<li class='song'> \
							   <ul class='songInfo'> \
									<li class='trackName'>" + val.track + "</li> \
									<li class='artist'>"+ val.artist + "</li> \
									<li class='album'> \
										<a href='" + val.albumLink + "'> \
											" + val.album + " \
										</a> \
									</li> \
									<li class='albumCover'> \
										<img class='albumArt' src='" + val.albumArt + "'/> \
									</li> \
									<li class='releaseDate'>" + val.release + "</li> \
									<li class='genre'> \
										<ul class='genreList'>" + genres + "</ul> \
									</li> \
								</ul> \
							</li>");
			});
			// End of file item and closing playList ul tag
			items.push("<li><div id='end'>End of file</div></li><ul>");
			// Append all the html in items
			$(document.body).append(items.join(""));
			// Color favorite green like in Lab 2
			$(".trackName:contains('Riptide')").css("color", "green");
		});
	});
});