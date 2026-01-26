// Achtung absichtlich Feher eingebaut
document.querySelector("#btn").onclick = _ => {
  const xhr = new XMLHttpRequest();

  xhr.open("GET", "server/not-existing.php");

  xhr.onload = _ => {
    document.querySelector("#output").textContent = "HTTP-Status: " + xhr.status;
  }

  xhr.send();
}