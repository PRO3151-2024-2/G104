document.getElementById('loginForm').addEventListener('submit', function (event) {
    event.preventDefault();

    const validUsername = 'admin';
    const validPassword = '1234';

    const username = document.getElementById('username').value;
    const password = document.getElementById('password').value;

    if (username === validUsername && password === validPassword) {
        localStorage.setItem('loggedIn', 'true');
        window.location.href = 'internal.html';
    } else {
        document.getElementById('errorMessage').textContent = 'Usuário ou senha incorretos.';
    }
});