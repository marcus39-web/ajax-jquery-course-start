document.querySelector("#btn").addEventListener("click", _ => {
  const xhr = new XMLHttpRequest();

  xhr.open("GET", "server/text.txt");

  xhr.onload = _ => {
    document.querySelector("#output").textContent = xhr.responseText;
  };

  xhr.send();
});