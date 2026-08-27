const memberDetailsLinks = document.querySelectorAll('.member_details_link');
const backdrop = document.getElementById('modal-backdrop');
const modalContainer = document.getElementById('modal-container');

const modalMemberPseudo = document.getElementById('modal-member-pseudo');
const modalProfilePicture = document.getElementById('modal-profile-picture');

const defaultProfilePicture = `
    <svg xmlns="http://www.w3.org/2000/svg" width="30" height="30" fill="currentColor" class="bi bi-person"
         viewBox="0 0 16 16">
        <path
            d="M8 8a3 3 0 1 0 0-6 3 3 0 0 0 0 6m2-3a2 2 0 1 1-4 0 2 2 0 0 1 4 0m4 8c0 1-1 1-1 1H3s-1 0-1-1 1-4 6-4 6 3 6 4m-1-.004c-.001-.246-.154-.986-.832-1.664C11.516 10.68 10.289 10 8 10s-3.516.68-4.168 1.332c-.678.678-.83 1.418-.832 1.664z"/>
    </svg>`;

memberDetailsLinks.forEach(detailLink => {
    detailLink.addEventListener('click', (event) => {
        event.preventDefault();

        // Retrieve datas from the clicked link
        const pseudonyme = detailLink.getAttribute('data-pseudonyme');
        const profilePictureSrc = detailLink.getAttribute('data-profile-pic');



        // Update modal content
        // Affichage de la photo ou du SVG par défaut
        if (profilePictureSrc) {
            modalProfilePicture.innerHTML = `
                <img
                    src="${profilePictureSrc}"
                    alt="famille_jean_icc_deux_plateaux_photo_de_profil"
                    width="100"
                >
            `;
        }
        else {
            modalProfilePicture.innerHTML = defaultProfilePicture;
        }
        modalMemberPseudo.textContent = pseudonyme;


        modalContainer.style.display = 'block';
        backdrop.classList.add('active');
    });
});


backdrop.addEventListener('click', () => {
    modalContainer.style.display = 'none';
    backdrop.classList.remove('active');
});
