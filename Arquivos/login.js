document.addEventListener('DOMContentLoaded', function () {
    const form = document.getElementById('loginForm');

    if (form) {
        form.addEventListener('submit', function () {
            // Código simplificado sem apagar mensagens de erro
            console.log('Formulário de login enviado.');
        });
    }
});
