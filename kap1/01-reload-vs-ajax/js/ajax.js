document.querySelector("#btn").addEventListener("click", _ => {
  const xhr = new XMLHttpRequest();

  // open() bereitet den Request vor - send() startet ihn
  xhr.open("GET", "server/time.php");

  xhr.addEventListener("load", _ => {
    // onload heißt NICHT automatisch Erfolg -> Status prüfen!
    if(xhr.status === 200) {
      document.querySelector("#output").textContent = xhr.responseText;
    }
  });

  xhr.send();
});