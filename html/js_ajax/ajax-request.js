window.onload = function () {
  let button = document.querySelector('button');
  button.onclick = function () {
    const xhr = new XMLHttpRequest();

    xhr.onload = function () {
      ResponseArea.innerHTML = xhr.responseText;
    }

    xhr.open('GET', 'hello.php');
    xhr.send();
  }
}

