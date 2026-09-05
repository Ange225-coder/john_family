/**
 * TODO: ce fichier devra etre supprimer apres que tous les href dans member space seront rempli
 */

const emptyLink = document.querySelectorAll('.empty-link');

emptyLink.forEach(link => {
    link.addEventListener('click', (event) => {
        event.preventDefault();

        Swal.fire({
            title: "Option indisponible",
            text: "Contacter le développeur pour la rendre disponible",
            icon: "info"
        });
    });
});
