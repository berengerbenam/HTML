setTimeout(start, 000);
var counter = 0;
var intervalId =null;
function action() 
{
clearInterval(intervalId);
document.getElementById('bip').innerHTML = "TERMINE!";
}
function clearCounter() {
document.getElementById('bip').innerHTML = '';
}
function bip() 
{
document.getElementById('bip').innerHTML = counter + " %";
counter++;
if (counter == 101) {
    clearInterval(intervalId);
    document.getElementById('button').style.visibility="visible";
    document.getElementById('button').innerHTML = 'Accéder au chat !';
    var button = document.getElementById('button');
    var onClick = button.getAttribute('onClick');
    button.setAttribute('onClick', 'goChat()');
    setTimeout(clearCounter, 10000);
    document.getElementById('ab').innerHTML = 'Chargement terminé !';
        }
}
function start()
{
var random = Math.floor ( Math.random() * 101 );
intervalId = setInterval(bip, random);

var counter = 0;
}
function goChat() {
window.location = "./../chat.php";
}
