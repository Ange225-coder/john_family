document.addEventListener('DOMContentLoaded', () => {
    const toggleBtn = document.querySelector('.js-toggle-password');
    if (!toggleBtn) return;

    const passwordWrapper = toggleBtn.closest('.field-password-wrapper');
    const passwordInput = passwordWrapper.querySelector('input');
    const eyeIcon = toggleBtn.querySelector('.js-eye-icon');

    toggleBtn.addEventListener('click', () => {
        const isPassword = passwordInput.getAttribute('type') === 'password';

        // Bascule le type de l'input
        passwordInput.setAttribute('type', isPassword ? 'text' : 'password');
        toggleBtn.setAttribute('aria-pressed', isPassword);
        toggleBtn.setAttribute('aria-label', isPassword ? 'Masquer le mot de passe' : 'Afficher le mot de passe');

        // Mise à jour de l'icône SVG
        if (isPassword) {
            // Icône œil barré (Masquer)
            eyeIcon.innerHTML = `
                        <path d="M17.94 17.94A10.07 10.07 0 0 1 12 20c-7 0-11-8-11-8a18.45 18.45 0 0 1 5.06-5.94M9.9 4.24A9.12 9.12 0 0 1 12 4c7 0 11 8 11 8a18.5 18.5 0 0 1-2.16 3.19m-6.72-1.07a3 3 0 1 1-4.24-4.24"/>
                        <line x1="1" y1="1" x2="23" y2="23"/>
                    `;
        }
        else {
            // Icône œil normal (Afficher)
            eyeIcon.innerHTML = `
                        <path d="M1 12s4-8 11-8 11 8 11 8-4 8-11 8-11-8-11-8z"/>
                        <circle cx="12" cy="12" r="3"/>
                    `;
        }
    });
});
