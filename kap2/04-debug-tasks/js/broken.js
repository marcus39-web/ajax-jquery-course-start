// TODO: Warum funktioniert das nicht?

const xhr = new XMLHttpRequest();
xhr.open("GET", "server/data.jso"); // Tippfehler!
xhr.onload = () => {
  const data = JSON.parse(xhr.responseText);
  console.log(data);
};
xhr.send();