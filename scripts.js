var XMLHttpRequestObject = false;

if (window.XMLHttpRequest) {
	XMLHttpRequestObject = new XMLHttpRequest();
} else if (window.ActiveXObject) {
	XMLHttpRequestObject = new ActiveXObject("Microsoft.XMLHTTP");
}

function ajax_login() {
	var obj = document.getElementById('login-form');
	var username = obj.elements[0].value;
	var password = obj.elements[1].value;

	if (XMLHttpRequestObject) {
		var loaderDiv = document.getElementById('loading');
		loaderDiv.style.display = 'block';
		XMLHttpRequestObject.open("POST", 'login.php', true);

		XMLHttpRequestObject.onreadystatechange = function() {
			if (XMLHttpRequestObject.readyState == 4) {
				if (XMLHttpRequestObject.status == 200) {
					loadContent('inc.home.php');
				} else {
					// alert("Invalid. " + XMLHttpRequestObject.responseText + "(enviou " + username + " " + password + ")");
					document.getElementById('login-form-error-msg').style.display = 'block';
				}

				loaderDiv.style.display = 'none';
			}

		}
		XMLHttpRequestObject.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");  
		XMLHttpRequestObject.send("user_email=" + username + "&user_pass=" + password);
	}
}

function getData(dataSource, divID) {
	if (XMLHttpRequestObject) {
		var obj = document.getElementById(divID);
		var loaderDiv = document.getElementById('loading');
		loaderDiv.style.display = 'block';
		XMLHttpRequestObject.open("GET", dataSource);

		XMLHttpRequestObject.onreadystatechange = function() {
			if (XMLHttpRequestObject.readyState == 4 && XMLHttpRequestObject.status == 200) {
				obj.innerHTML = XMLHttpRequestObject.responseText;
			}

			loaderDiv.style.display = 'none';
		}

		XMLHttpRequestObject.send(null);
	}
}

function loadContent(dataSource) {
	getData(dataSource, 'main');
}

function startPlayer() {
	var video_still = document.getElementById('video-still');
	var initial_still = 37;
	var final_still = 82;
	var current_still = 38;

	video_still.onclick = function() {
		// TODO call ajax to save to database along with data (and location?)
		alert("Saving frame " + current_still);
	}

	setInterval(function() {
	    video_still.src = 'stills/ishot-' + current_still + '.jpg';
	    current_still = (current_still != final_still) ? (current_still + 1) : initial_still;
	}, 500);
}