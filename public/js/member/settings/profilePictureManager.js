const uploadBtn = document.querySelector('.upload-btn');
const removeBtn = document.getElementById('remove-btn');
const inputFile = document.getElementById('profile_picture_profilePicture');

const avatarPreview = document.getElementById('avatar-preview');
const avatarFallback = document.getElementById('avatar-fallback');

const defaultInfo = document.getElementById('default-info');
const fileInfo = document.getElementById('file-info');
const fileName = document.getElementById('file-name');
const fileSize = document.getElementById('file-size');

// Sauvegarde de l'image de profil d'origine si elle existe
const initialSrc = avatarPreview.getAttribute('src');
const hasInitialImage = initialSrc !== '';

// Déclenche le clic sur l'input file
uploadBtn.addEventListener('click', () => inputFile.click());

// Détecte le choix du fichier
inputFile.addEventListener('change', (e) => {
    const file = e.target.files[0];

    if (file) {
        // Génération de la prévisualisation
        avatarPreview.src = URL.createObjectURL(file);
        avatarPreview.style.display = 'block';
        if (avatarFallback) avatarFallback.style.display = 'none';

        // Affichage du nom et de la taille formatée
        fileName.textContent = file.name;
        fileSize.textContent = (file.size / (1024 * 1024)).toFixed(2) + ' Mo';

        defaultInfo.style.display = 'none';
        fileInfo.style.display = 'block';

        // Affichage du bouton retirer
        removeBtn.style.display = 'inline-flex';
    }
});

// Action du bouton "Retirer la photo"
removeBtn.addEventListener('click', () => {
    // Vider le champ fichier
    inputFile.value = '';

    // Réinitialiser la vue
    if (hasInitialImage) {
        avatarPreview.src = initialSrc;
        avatarPreview.style.display = 'block';
        if (avatarFallback) avatarFallback.style.display = 'none';
    }
    else {
        avatarPreview.src = '';
        avatarPreview.style.display = 'none';
        if (avatarFallback) avatarFallback.style.display = 'block';
    }

    defaultInfo.style.display = 'block';
    fileInfo.style.display = 'none';
    removeBtn.style.display = 'none';
});
