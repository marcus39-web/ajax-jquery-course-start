document.querySelector("#btn").addEventListener("click", _ => {
  const xhr = new XMLHttpRequest();
  let output = document.querySelector("#output");

  xhr.open("GET", "server/texte.txt");

  xhr.onload = _ => {
    if (xhr.status === 200) {
      output.textContent = xhr.responseText;
    } else {
      if (xhr.status === 404) {
        output.innerHTML = "Uuups! keine Datei<br>";
      } else if (xhr.status === 403) {
        output.innerHTML = "Du hast keine Berechtigung!<br>";
      }

      output.innerHTML += "Fehler: Status " + xhr.status;      
    }

  };

  xhr.send();
});