document.addEventListener('DOMContentLoaded', function () {
    const spinner = document.getElementById('page-spinner');

    // Masquer quand tout est chargé
    window.addEventListener('load', function () {
        spinner.style.display = 'none';
    });

    // Masquer aussi quand on revient en arrière (bfcache)
    window.addEventListener('pageshow', function (event) {
        spinner.style.display = 'none';
    });

    // Ré-afficher au clic sur un lien
    document.querySelectorAll('a[href]').forEach(function (link) {
        link.addEventListener('click', function (event) {
            const href = link.getAttribute('href');

            if (!href || href.startsWith('#') || href.startsWith('mailto')) return;

            // 2. ⚠️ IGNORER si l'utilisateur utilise des touches modificatrices (Ctrl, Cmd, Shift) ou le clic du milieu
            if (event.ctrlKey || event.metaKey || event.shiftKey || event.button === 1) {
                return;
            }

            // 3. ⚠️ IGNORER si le lien possède un attribut target="_blank"
            if (link.getAttribute('target') === '_blank') {
                return;
            }

            spinner.style.display = 'flex';
        });
    });
});