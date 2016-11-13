document.body.onload=function() { //part 3: add quote at the end of <body>
	var node = document.getElementsByClassName("quote")[0].cloneNode();
	node.innerHTML = "The quality of mercy is not strain'd..."
	document.body.appendChild(node);

	var element = document.documentElement;
	document.getElementById("info").innerHTML = getDom(element, 0);
}

function getDom(element, depth) {
	if (element.nodeType!=1) { //don't print text or lack thereof
		return "";
	}
	txt = '';
	for (var i=0;i<depth;i++) { //add dashes based on depth
		txt += '-';
	}
	txt += element.tagName+"\n"; //add element tag with newline
	for (var n=0;n<element.childNodes.length;n++) { //loop through children/nested elements
		txt += getDom(element.childNodes[n], depth+1);
	}

	element.onclick=function() {alert(element.tagName);}; //part 2: add onclick events for each DO

	if (element.tagName=="DIV") { //part 3: add mouseover/out events
		element.onmouseover=function() {
			element.style.backgroundColor = "red";
			element.style.position = "relative";
			element.style.left= "10px";
		}
		element.onmouseout=function() {
			element.style.backgroundColor = "white";
			element.style.left = "0"
		}
	}
	return txt;
}
