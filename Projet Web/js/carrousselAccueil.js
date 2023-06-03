function afficherImage(idx) {
    // Affichage du carrousel
    let images = $("#carrousel img"); // Sélection de toutes les images à l'intérieur du div "carrousel"
    let nouvelleImage = images.eq(idx); // Sélection du i-ème élément de la liste
    images.css('display', 'none'); // On cache toutes les images
    nouvelleImage.css('display', 'block'); // On affiche seulement image voulue

    // Affichage des miniatures
    let miniatures = $("#navigation img");
    let nouvelleMiniature = miniatures.eq(idx);
    miniatures.css('filter', 'grayscale(100%)'); // On affiche toutes les miniatures en gris
    nouvelleMiniature.css('filter', ''); // On enlève le filtre sur la bonne image
}

$(document).ready(function () {
    console.log("La page est chargée !");

    // On remplie dynamiquement la barre de navigation avec les images du carrousel
    $("#carrousel img").each(function (idx) {
        let imgSrc = $(this).attr("src");
        $("#navigation").append(`<img class="image-navigation" src="${imgSrc}" />`);
    })

    // On garde en mémoire l'image en cours, en commençant par la première
    let currentIdx = 0;
    afficherImage(currentIdx);

    function changerCurrentIdx(idx) {
        let nbImages = $("#carrousel img").length;
        if (idx < 0) {
            idx += nbImages;
        }
        currentIdx = idx % nbImages; // On boucle sur les images pour éviter de dépasser leur nombre
        afficherImage(currentIdx);
    }

    // Boutons de navigation
    $('#suivant').click(function () {
        changerCurrentIdx(currentIdx + 1);
    });

    $('#precedent').click(function () {
        changerCurrentIdx(currentIdx - 1);
    });

    // Navigation avec les petites images
    $(".image-navigation").click(function () {
        // On trouve l'indice de l'image en cours dans la liste
        let idx = $(".image-navigation").index($(this));
        changerCurrentIdx(idx);
    })

    // On garde en mémoire l'état du bouton de défilement
    let defilementActif = true;

    $('#defilement').click(function () {
        // On inverse l'état du défilement
        defilementActif = !defilementActif;
        if (defilementActif) {
            $(this).html("Désactiver le défilement");
        } else {
            $(this).html("Activer le défilement");
        }
    });

    // Fonction de défilement
    function defilement() {
        if (defilementActif) {
            // On ne défile que si la fonctionalité est active
            changerCurrentIdx(currentIdx + 1);
        }
        // On appelle récursivement la même fonction à l'infini, toutes les 2 secondes
        setTimeout(defilement, 2000);
    }
    // On appelle la fonction une première fois
    defilement();
});