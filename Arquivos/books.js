const books = [
  {
      title: "Por Que Fazemos o Que Fazemos?",
      author: "Mario Sergio Cortella",
      price: "R$40,00",
      image: "Livro1.jpg",
      description: "Por que fazemos o que fazemos? de Mario Sergio Cortella aborda a busca por propósito e significado no trabalho e na vida...",
  },
  {
      title: "Crer ou Não Crer",
      author: "Leandro Karnal",
      price: "R$30,00",
      image: "Livro2.jpg",
      description: "Crer ou Não Crer de Leandro Karnal. Em uma conversa franca entre Leandro Karnal e o padre Fábio de Melo...",
  },
  {
      title: "Filosofia Para Corajosos",
      author: "Luiz Felipe Pondé",
      price: "R$40,00",
      image: "Livro3.jpg",
      description: "Filosofia Para Corajosos de Luiz Felipe Pondé. Pondé aborda a filosofia de forma provocativa e acessível...",
  },
  {
      title: "O Sofrimento é Opcional",
      author: "Monja Coen",
      price: "R$40,00",
      image: "Livro4.jpg",
      description: "O Sofrimento é Opcional de Monja Coen. Este livro traz ensinamentos da Monja Coen sobre a importância de encontrar paz...",
  },
  {
      title: "A Mentalidade Mamba",
      author: "Kobe Bryant",
      price: "R$140,00",
      image: "Livro5.jpg",
      description: "A Mentalidade Mamba de Kobe Bryant: Um livro inspirador em que Kobe Bryant compartilha sua mentalidade...",
  }
];

// Función para poblar la tabla en index.html
function populateTable() {
  const table = document.querySelector('table');
  table.innerHTML = `
      <tr>
          <th>Book</th>
          <th>Author</th>
          <th>Price</th>
      </tr>
  `;

  books.forEach((book, index) => {
      const row = `
          <tr>
              <td><a href="book.html?bookIndex=${index}">${book.title}</a></td>
              <td>${book.author}</td>
              <td>${book.price}</td>
          </tr>
      `;
      table.innerHTML += row;
  });
}

function getBookIndexFromUrl() {
  const queryString = window.location.search;
  const urlParams = new URLSearchParams(queryString);
  return parseInt(urlParams.get('bookIndex'));
}

// Función para poblar los detalles del libro en book.html
function populateBookDetails() {
  const bookIndex = getBookIndexFromUrl();
  if (isNaN(bookIndex) || bookIndex < 0 || bookIndex >= books.length) {
      document.getElementById('book-details').innerHTML = "<p>Book not found.</p>";
  } else {
      const book = books[bookIndex];
      const bookDetails = `
          <div class="book-item">
              <h2>${book.title}</h2>
              <img id="book-cover" src="${book.image}" alt="${book.title} Cover" style="max-width: 500px; height: auto; margin-bottom: 20px;">
              <p><strong>Author:</strong> ${book.author}</p>
              <p><strong>Price:</strong> ${book.price}</p>
              <p><strong>Description:</strong> ${book.description}</p>
          </div>
      `;
      document.getElementById('book-details').innerHTML = bookDetails;
  }
}

