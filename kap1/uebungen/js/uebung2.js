document.querySelector("#btn").addEventListener("click", _ => {
  const xhr = new XMLHttpRequest();

  xhr.open("GET", "server/text.txt");

  xhr.onload = _ => {
    if (xhr.status === 200) {
      document.querySelector("#output").textContent = xhr.responseText;
    } else if (xhr.status === 404) {
      document.querySelector("#output").textContent = "Uuups! keine Datei";
    } else if (xhr.status === 403) {
      document.querySelector("#output").textContent = "Du hast keine Bereichtigung!";
    }

  };

  xhr.send();
});