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
        alert("Votre navigateur est obsolète, veuillez en changer.");
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
 
   
     
    xhr.open("GET", "get-message.php", true);
    xhr.send(null);
}
 
function readData(sData) {
    document.getElementById('cadre_chat').innerHTML = sData;
}
setInterval('request(readData)',500);
function request_status(callback) {
    var xhr = getXMLHttpRequest();
     
    xhr.onreadystatechange = function() {
        if (xhr.readyState == 4 && (xhr.status == 200 || xhr.status == 0)) {
            callback(xhr.responseText);
        }
    };
 
   
     
    xhr.open("GET", "get-status.php", true);
    xhr.send(null);
}
 
function readData_status(sData) {
    document.getElementById('membres_connectes').innerHTML = sData;
}
setInterval('request_status(readData_status)',1000);
function post() {
  var xhr = getXMLHttpRequest();
     
    xhr.onreadystatechange = function() {
        if (xhr.readyState == 4 && (xhr.status == 200 || xhr.status == 0)) {
            callback(xhr.responseText);
         
        }
    };
    var msg = encodeURIComponent(document.getElementById("message").value);
      xhr.open("GET", "post.php?message=" + msg, true);
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
      xhr.open("GET", "set_status.php?status=" + status, true);
      xhr.send(null);
      }