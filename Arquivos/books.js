const books = [
    {
        title: "Por Que Fazemos o Que Fazemos?",
        author: "Mario Sergio Cortella",
        link: "book1.html"
    },
    {
        title: "Crer ou Não Crer",
        author: "Leandro Karnal",
        link: "book2.html"
    },
    {
        title: "Filosofia Para Corajosos",
        author: "Luiz Felipe Pondé",
        link: "book3.html"
    },
    {
        title: "O sofrimento é opcional",
        author: "Monja Coen",
        link: "book4.html"
    },
    {
        title: "A Mentalidade Mamba",
        author: "Kobe Bryant",
        link: "book5.html"
    }
];

function populateTable() {
    const table = document.querySelector("table");

    books.forEach(book => {
        const row = table.insertRow();
        row.innerHTML = `
            <td><a href="${book.link}">${book.title}</a></td>
            <td>${book.author}</td>
        `;
    });
}
