document.addEventListener("DOMContentLoaded", function () {
    const slide = document.getElementById("slide");
    const fleche = document.getElementById("fleche-retour");
    const contact = document.querySelector(".contact");
    const bodyAccueil = document.querySelector(".body-accueil");

    if (!slide || !bodyAccueil) return;

    // Montrer le contenu principal quand le DOM est prêt
    bodyAccueil.style.visibility = "visible";

    slide.style.transition = "transform 0.8s ease-in-out";

    // Vérifie si la slide est déjà masquée
    if (slide.style.transform === "translateY(-100vh)") {
        bodyAccueil.style.overflowY = "auto";
    } else {
        bodyAccueil.style.overflowY = "hidden";
    }

    slide.addEventListener("click", function (e) {
        if (e.target.id === "fleche-retour" || e.target.id === "contact-link") return;

        slide.style.transform = "translateY(-100vh)";
        bodyAccueil.style.overflowY = "auto";
    });

    if (fleche) {
        fleche.addEventListener("click", function(e) {
            e.stopPropagation();
            slide.style.transform = "translateY(0)";
            bodyAccueil.style.overflowY = "hidden";
        });
    }

    if (contact) {
        contact.addEventListener("click", function(e){
            e.stopPropagation();
        });
    }
});