var XMLHttpRequestObject = false;

if (window.XMLHttpRequest) {
	XMLHttpRequestObject = new XMLHttpRequest();
} else if (window.ActiveXObject) {
	XMLHttpRequestObject = new ActiveXObject("Microsoft.XMLHTTP");
}

function ajax_signin() {
	var obj = document.getElementById('signin-form');
	var username = obj.elements[0].value;
	var password = obj.elements[1].value;

	if (XMLHttpRequestObject) {
		var loaderDiv = document.getElementById('loading');
		loaderDiv.style.display = 'block';
		XMLHttpRequestObject.open("POST", 'signin.php', true);

		XMLHttpRequestObject.onreadystatechange = function() {
			if (XMLHttpRequestObject.readyState == 4) {
				if (XMLHttpRequestObject.status == 200) {
					// Login successful
					window.location.href = './';
				} else {
					// Login error
					// alert("Invalid. " + XMLHttpRequestObject.responseText + "(enviou " + username + " " + password + ")");
					document.getElementById('form-error-msg').style.display = 'block';
				}

				loaderDiv.style.display = 'none';
			}

		}
		XMLHttpRequestObject.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");  
		XMLHttpRequestObject.send("user_email=" + username + "&user_pass=" + password);
	}
}

function ajax_signup() {
	var obj = document.getElementById('signup-form');
	var username = obj.elements[0].value;
	var password = obj.elements[1].value;

	if (XMLHttpRequestObject) {
		var loaderDiv = document.getElementById('loading');
		loaderDiv.style.display = 'block';
		XMLHttpRequestObject.open("POST", 'signup.php', true);

		XMLHttpRequestObject.onreadystatechange = function() {
			var formMsg = document.getElementById('form-error-msg');
			if (XMLHttpRequestObject.readyState == 4) {
				if (XMLHttpRequestObject.status == 200) {
					// Signup successful
					formMsg.style.display = 'none';
					window.location.href = './';
				} else {
					// Signup error
					// alert("Invalid. " + XMLHttpRequestObject.responseText + "(enviou " + username + ")");
					formMsg.innerHTML = XMLHttpRequestObject.responseText;
					formMsg.style.display = 'block';
				}

				loaderDiv.style.display = 'none';
			}

		}
		XMLHttpRequestObject.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");  
		XMLHttpRequestObject.send("user_email=" + username + "&user_pass=" + password);
	}
}

function ajax_validate_signup() {
	var obj = document.getElementById('signup-form');
	var username = obj.elements[0].value;
	var button = document.getElementById('submit-button');

	if (XMLHttpRequestObject) {
		XMLHttpRequestObject.open("POST", 'signup_ajax_validator.php', true);

		XMLHttpRequestObject.onreadystatechange = function() {
			var formMsg = document.getElementById('form-error-msg');
			if (XMLHttpRequestObject.readyState == 4) {
				if (XMLHttpRequestObject.status == 200) {
					// Validated successfully
					formMsg.style.display = 'none';
					obj.elements[0].className = 'valid';
					button.disabled = false;
				} else {
					// Not validated 
					// alert("Invalid. " + XMLHttpRequestObject.responseText + "(enviou " + username + ")");
					formMsg.innerHTML = XMLHttpRequestObject.responseText;
					formMsg.style.display = 'block';
					obj.elements[0].className = 'invalid';
					button.disabled = true;
				}
			}

		}
		XMLHttpRequestObject.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");  
		XMLHttpRequestObject.send("user_email=" + username);
	}
}

function save_picture(picture) {	
	if (XMLHttpRequestObject) {
		var loaderDiv = document.getElementById('loading');
		loaderDiv.style.display = 'block';
		XMLHttpRequestObject.open("POST", 'save_shot.php', true);

		XMLHttpRequestObject.onreadystatechange = function() {
			if (XMLHttpRequestObject.readyState == 4) {
				if (XMLHttpRequestObject.status == 200) {
					alert('Saved to database!');
				} else {
					alert('Error ' + XMLHttpRequestObject.status);
				}

				loaderDiv.style.display = 'none';
			}

		}
		XMLHttpRequestObject.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");  
		XMLHttpRequestObject.send("picture=" + picture);
	}
}

function getData(dataSource, divID) {
	if (XMLHttpRequestObject) {
		var obj = document.getElementById(divID);
		var loaderDiv = document.getElementById('loading');
		loaderDiv.style.display = 'block';
		XMLHttpRequestObject.open("GET", "inc." + dataSource + ".php");

		XMLHttpRequestObject.onreadystatechange = function() {
			if (XMLHttpRequestObject.readyState == 4) {
				if (XMLHttpRequestObject.status == 200) {
					obj.innerHTML = XMLHttpRequestObject.responseText;
					if (dataSource == 'player') startPlayer();
				} else {
					obj.innerHTML = '<div class="error-message">Error ' + XMLHttpRequestObject.status + '</div>';
				}
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
		save_picture(document.getElementById('video-still').src);
	}

	setInterval(function() {
	    video_still.src = 'stills/ishot-' + current_still + '.jpg';
	    current_still = (current_still != final_still) ? (current_still + 1) : initial_still;
	}, 500);
}

window.onload = window.onpopstate = function(event) {
	// alert("location: " + document.location + ", state: " + JSON.stringify(event.state));
	var page = document.location.href.split("#");
	// alert(page);
	if (typeof page[1] === 'undefined' || page[1] == '') {
		document.getElementById('back-button').style.display = 'none';
		loadContent('home');
	} else {
		if (page[1] != 'signup' && page[1] != 'signin') {
			document.getElementById('back-button').style.display = 'block';
		} else {
			document.getElementById('back-button').style.display = 'none';
		}

		loadContent(page[1]);
	}
};
