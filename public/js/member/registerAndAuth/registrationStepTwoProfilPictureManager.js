document.addEventListener('DOMContentLoaded', () => {
    const inputFile = document.getElementById('registration_step_two_profilePicture');
    const uploadZone = document.querySelector('.js-upload-zone');
    const previewZone = document.querySelector('.js-preview-zone');
    const previewImg = document.querySelector('.js-preview-img');
    const fileNameEl = document.querySelector('.js-file-name');
    const fileSizeEl = document.querySelector('.js-file-size');
    const btnRemove = document.querySelector('.js-btn-remove');

    if (!inputFile || !uploadZone || !previewZone) return;

    // Déclenche l'ouverture de la boîte de dialogue de fichier
    uploadZone.addEventListener('click', () => {
        inputFile.click();
    });

    // Fonction de formatage de la taille du fichier
    function formatFileSize(bytes) {
        if (bytes === 0) return '0 Octets';
        const k = 1024;
        const sizes = ['Octets', 'Ko', 'Mo', 'Go'];
        const i = Math.floor(Math.log(bytes) / Math.log(k));
        return parseFloat((bytes / Math.pow(k, i)).toFixed(2)) + ' ' + sizes[i];
    }

    // Gestion du changement de fichier
    inputFile.addEventListener('change', (event) => {
        const file = event.target.files[0];

        if (file) {
            const reader = new FileReader();

            reader.onload = (e) => {
                previewImg.src = e.target.result;
                fileNameEl.textContent = file.name;
                fileSizeEl.textContent = formatFileSize(file.size);

                // Afficher la prévisualisation et masquer la zone d'upload
                uploadZone.style.display = 'none';
                previewZone.style.display = 'flex';
            };

            reader.readAsDataURL(file);
        }
    });

    // Gestion de la suppression de la photo
    btnRemove.addEventListener('click', (e) => {
        e.stopPropagation(); // Évite tout clic involontaire

        // Réinitialisation de l'input HTML file
        inputFile.value = '';

        // Réinitialisation de l'image
        previewImg.src = '';
        fileNameEl.textContent = '';
        fileSizeEl.textContent = '';

        // Masquer la zone de prévisualisation et afficher la zone d'upload
        previewZone.style.display = 'none';
        uploadZone.style.display = 'flex';
    });
});
