<header class="header">
    <div class="wrapper">

        <div class="header-left">
            <a href="index.php?no_slide=1" class="header-left" id="logo-home">
                <img src="images/general/Logo-LenaRousseau.svg" alt="Logo Léna Rousseau" class="logo">
                <span class="nom">Léna Rousseau</span>
            </a>
        </div>

        <div class="hamburger">
            <span></span>
            <span></span>
            <span></span>
        </div>

        <nav class="header-navigation">
            <a href="aPropos.php" class="<?= $page == 'apropos' ? 'active' : '' ?>">À propos</a>
            <span class="separator"></span>

            <a href="informations.php" class="<?= $page == 'informations' ? 'active' : '' ?>">Informations</a>
            <span class="separator"></span>

            <a href="services.php" class="<?= $page == 'services' ? 'active' : '' ?>">Services</a>
            <span class="separator"></span>

            <a href="contact.php" class="<?= $page == 'contact' ? 'active' : '' ?>">Me contacter</a>
        </nav>

    </div>
</header>

<div class="bande-titre bande-<?= $bandeCouleur ?>">
    <div class="wrapper">
        <h1><?= $bandeTitre ?></h1>
    </div>
</div>

<script>
document.addEventListener('DOMContentLoaded', () => {
  const hamburger = document.querySelector('.hamburger');
  const nav = document.querySelector('.header-navigation');

  if (hamburger && nav) {
    hamburger.addEventListener('click', () => {
      nav.classList.toggle('open');
      hamburger.classList.toggle('active');
    });
  }
});
</script>