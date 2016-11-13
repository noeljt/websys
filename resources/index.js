var data = new XMLHttpRequest();
data.onreadystatechange = function() {
	if (this.readyState == 4 && this.status == 200) {
		loadData(this);
	}
}
data.open("GET", "resources/data.xml", true);
data.send();

function loadData(data) {
	var xmlDoc = data.responseXML;
	var xml = xmlDoc.documentElement.childNodes;
	var labs = xmlDoc.getElementsByTagName("lab");
	// var hws = xmlDoc.getElementsByTagName("hw");
	var html = [];
	for (i=0;i<labs.length;i++) {
		var name, desc, url;
		name = labs[i].getElementsByTagName("name")[0].childNodes[0].nodeValue;
		desc = labs[i].getElementsByTagName("desc")[0].childNodes[0].nodeValue;
		url = labs[i].getElementsByTagName("url")[0].childNodes[0].nodeValue;
		html.push("<div class='col-md-6'><div class='portfolio-item'><a href='"+url+"'>"+name+"</a>"+desc+"</div></div>");
	}
	// for (i=0;i<hws.length;i++) {
	// 	var name, desc, url;
	// 	name = hws[i].getElementsByTagName("name")[0].childNodes[0].nodeValue;
	// 	desc = hws[i].getElementsByTagName("desc")[0].childNodes[0].nodeValue;
	// 	url = hws[i].getElementsByTagName("url")[0].childNodes[0].nodeValue;
	// 	html.push("<li class='hw'><h1><a href='"+url+"'>"+name+"</a></h1><h2>"+desc+"</h2></li>");
	// }

	$("#labs").append(html.join(""));
}
