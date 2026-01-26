// JSON laden und verarbeiten
document.querySelector("#btn").addEventListener("click", _ => {
  const xhr = new XMLHttpRequest();
  xhr.open("GET", "server/books.json");

  xhr. onload = _ => {
    // JSON-String -> JSON-Objekt
    const data = JSON.parse(xhr.responseText);
    render(data);
  };

  xhr.send();
});

function render(books) {
  const ul = document.querySelector("#list");
  ul.innerHTML = "";

  books.forEach( book => {
    const li = document.createElement("li");
    li.textContent = `${book.title} (${book.author})`;
    ul.appendChild(li);
  });
}