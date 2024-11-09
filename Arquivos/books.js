// Função para buscar os livros do arquivo PHP
async function fetchBooks() {
    try {
        const response = await fetch('getBooks.php'); // Faz a requisição para o arquivo PHP
        if (!response.ok) {
            throw new Error('Erro ao buscar dados dos livros');
        }
        const books = await response.json(); // Converte a resposta em JSON
        return books;
    } catch (error) {
        console.error('Erro:', error);
        return []; // Retorna um array vazio em caso de erro
    }
}

// Função para obter o bookId da URL
function getBookIdFromUrl() {
    const queryString = window.location.search;
    const urlParams = new URLSearchParams(queryString);
    return urlParams.get('bookId'); // Retorna o bookId da URL
}

// Função para exibir os detalhes de um livro específico
async function populateBookDetails() {
    const bookId = parseInt(getBookIdFromUrl()); // Converte o bookId da URL para número
    if (isNaN(bookId)) {
        document.getElementById('book-details').innerHTML = "<p>ID do livro inválido.</p>";
        return;
    }

    const books = await fetchBooks(); // Busca todos os livros do banco de dados

    // Encontra o livro que corresponde ao bookId
    const book = books.find(b => parseInt(b.id) === bookId);

    if (book) {
        // Atualiza o conteúdo da página com os detalhes do livro
        document.getElementById('book-title').innerText = book.titulo;
        document.getElementById('book-author').innerText = `Autor: ${book.autor}`;
        document.getElementById('book-price').innerText = `Preço: ${book.preco}`;
        document.getElementById('book-description').innerText = book.descricao;
        document.getElementById('book-cover').src = book.capa;
        document.getElementById('book-cover').src = `http://localhost/PRO3151/Lab11/${book.capa}.jpg`;  // Atribui o caminho da capa ao elemento de imagem
        document.getElementById('book-cover').alt = `${book.titulo} Cover`;
        document.getElementById('book-cover').onerror = function() {    // Verifica se a imagem falhou ao carregar e exibe uma imagem alternativa se necessário
            this.src = 'http://localhost/PRO3151/Lab11/capas/default.jpg'; // Caminho de uma imagem padrão (adicionar)
            this.alt = 'Imagem não disponível';
        };        
    } else {
        document.getElementById('book-details').innerHTML = "<p>Livro não encontrado.</p>";
    }
}

// Chama a função para exibir os detalhes quando a página é carregada
populateBookDetails();
