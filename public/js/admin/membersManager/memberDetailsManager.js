document.addEventListener('DOMContentLoaded', () => {
    const memberDetailsLinks = document.querySelectorAll('.member_details_link');
    const backdrop = document.getElementById('modal-backdrop');
    const modalContainer = document.getElementById('modal-container');
    const modalClose = document.getElementById('modalClose');

    const modalPhoto = document.getElementById('modalPhoto');
    const modalName = document.getElementById('modalName');
    const modalPseudo = document.getElementById('modalPseudo');
    const modalNom = document.getElementById('modalNom');
    const modalPrenom = document.getElementById('modalPrenom');
    const modalDate = document.getElementById('modalDate');

    memberDetailsLinks.forEach(detailLink => {
        detailLink.addEventListener('click', (event) => {
            event.preventDefault();

            const lastname = detailLink.getAttribute('data-lastname') || '';
            const firstname = detailLink.getAttribute('data-firstname') || '';
            const pseudonyme = detailLink.getAttribute('data-pseudonyme') || '';
            const profilePictureSrc = detailLink.getAttribute('data-profile-pic');
            const createdAt = detailLink.getAttribute('data-created-at') || '';

            // Injection des textes
            modalName.textContent = `${lastname} ${firstname}`.trim();
            modalPseudo.textContent = pseudonyme ? `@${pseudonyme}` : '';
            modalNom.textContent = lastname;
            modalPrenom.textContent = firstname;
            modalDate.textContent = createdAt;

            // Gestion de l'avatar (photo ou initiales)
            if (profilePictureSrc && profilePictureSrc.trim() !== '') {
                modalPhoto.innerHTML = `<img src="${profilePictureSrc}" alt="${pseudonyme}">`;
            } else {
                const initials = ((lastname ? lastname[0] : '') + (firstname ? firstname[0] : '')).toUpperCase() || 'MJ';
                modalPhoto.innerHTML = initials;
            }

            // Ouverture modale
            modalContainer.classList.add('active');
            backdrop.classList.add('active');
        });
    });

    const closeModal = () => {
        modalContainer.classList.remove('active');
        backdrop.classList.remove('active');
    };

    backdrop?.addEventListener('click', closeModal);
    modalClose?.addEventListener('click', closeModal);
});
