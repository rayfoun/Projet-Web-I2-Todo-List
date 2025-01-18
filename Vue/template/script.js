document.addEventListener('DOMContentLoaded', () => {
    const showFormButton = document.getElementById('bottone5');
    const formContainer = document.getElementById('taskForm');
    const body = document.body;

    // Afficher le formulaire et décaler le contenu
    showFormButton.addEventListener('click', () => {
        formContainer.classList.toggle('active'); // Affiche le formulaire
        body.classList.toggle('slide-left'); // Décale le contenu
    });
});
