function getXMLHttpRequest() {
    var xhr = null;
     
    if (window.XMLHttpRequest || window.ActiveXObject) {
        if (window.ActiveXObject) {
            try {
                xhr = new ActiveXObject("Msxml2.XMLHTTP");
            } catch(e) {
                xhr = new ActiveXObject("Microsoft.XMLHTTP");
            }
        } else {
            xhr = new XMLHttpRequest();
        }
    } else {
        alert("Votre navigateur ne supporte pas l'objet XMLHTTPRequest...");
        return null;
    }
     
    return xhr;
}

function request(callback) {
    var xhr = getXMLHttpRequest();
     
    xhr.onreadystatechange = function() {
        if (xhr.readyState == 4 && (xhr.status == 200 || xhr.status == 0)) {
            
			callback(xhr.responseText);
            
        }
    };
 var action  = encodeURIComponent('new');
   xhr.open("GET", "./script/get-message.php?action=" + action, true);
    xhr.send(null);
     
    
}
 
function readData(sData) {    
    if (sData.length > 0) {
	document.getElementById('cadre_chat').innerHTML = sData;
	}
	else {
	document.getElementById('cadre_chat').innerHTML = '<center><b>Pas de messages pour le moment.</b></center>';
	}
}
setInterval('request(readData)',500);
function request_status(callback) {
    var xhr = getXMLHttpRequest();
     
    xhr.onreadystatechange = function() {
        if (xhr.readyState == 4 && (xhr.status == 200 || xhr.status == 0)) {
            callback(xhr.responseText);
        }
    };
 
   
     
    xhr.open("GET", "./script/get-status.php", true);
    xhr.send(null);
}
 
function readData_status(sData) {
    document.getElementById('membres_connectes').innerHTML = sData;
}
setInterval('request_status(readData_status)',700);
function post() {
  var xhr = getXMLHttpRequest();
     
    xhr.onreadystatechange = function() {
        if (xhr.readyState == 4 && (xhr.status == 200 || xhr.status == 0)) {
            callback(xhr.responseText);
         write(msg);
        }
    };
    var msg = encodeURIComponent(document.getElementById("message").value);
      xhr.open("GET", "./script/post.php?message=" + msg, true);
      xhr.send(null);
	  
      document.getElementById("message").value = '';
      }
      
function set_status() {
  var xhr = getXMLHttpRequest();
     
    xhr.onreadystatechange = function() {
        if (xhr.readyState == 4 && (xhr.status == 200 || xhr.status == 0)) {
            callback(xhr.responseText);
            ;
        }
    };
    var status = encodeURIComponent(document.getElementById("status").value);
      xhr.open("GET", "./script/set_status.php?status=" + status, true);
      xhr.send(null);
      }
function ancien_msg(callback) {
	var xhr = getXMLHttpRequest();
	xhr.onreadystatechange = function() {
        if (xhr.readyState == 4 && (xhr.status == 200 || xhr.status == 0)) {
           callback(xhr.responseText);
		   }
    };
		var action  = encodeURIComponent('anc');
		xhr.open("GET", "./script/get-message.php?action=" + action, true);
		xhr.send(null);
     }
function echoMsg(sData) {
	document.getElementById('ancMsg').style.visibility = 'visible';
	if (sData.length > 0) {
	document.getElementById('ancMsg').innerHTML += sData;
	var lien = document.getElementById('aMsg');
	var href = lien.getAttribute('onClick');
	lien.setAttribute('onClick', 'javascript:hideAncMsg()');
	document.getElementById('aMsg').innerHTML = 'Cacher les anciens messages';
	}
	else {
	document.getElementById('ancMsg').innerHTML += '<b><center>Pas d\'ancien messages pour le moment.</center></b>';
	var lien = document.getElementById('aMsg');
	var href = lien.getAttribute('onClick');
	lien.setAttribute('onClick', 'javascript:hideAncMsg()');
	document.getElementById('aMsg').innerHTML = 'Cacher les anciens messages';
	}
	}
function hideAncMsg() {
	var container = document.getElementById('ancMsg');
	container.innerHTML = '';
	container.style.visibility = 'hidden';
	var lien = document.getElementById('aMsg');
	var href = lien.getAttribute('onClick');
	lien.setAttribute('onClick', 'javascript:ancien_msg(echoMsg)');
	document.getElementById('aMsg').innerHTML = 'Afficher les anciens messages';
	}
