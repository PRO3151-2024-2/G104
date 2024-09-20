document.getElementById('logoutButton').addEventListener('click', function () {
    localStorage.removeItem('loggedIn');
    window.location.href = 'login.html';
});