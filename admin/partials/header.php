<nav class="navbar navbar-expand-lg navbar-admin">
  <div class="container-fluid">

    <a class="navbar-brand" href="../index.php">Retour au site</a>

    <button class="navbar-toggler" type="button" data-bs-toggle="collapse"
            data-bs-target="#navbarNavDropdown" aria-controls="navbarNavDropdown"
            aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>

    <div class="collapse navbar-collapse" id="navbarNavDropdown">

      <ul class="navbar-nav">
        <li class="nav-item">
          <a class="nav-link" href="image.php">Image de profil</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="services.php">Services</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="temoignages.php">Témoignages</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="contact.php">Messages</a>
        </li>
      </ul>

      <ul class="navbar-nav ms-auto">
        <li class="nav-item dropdown">
          <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
            <?= $_SESSION['login'] ?>
          </a>
          <ul class="dropdown-menu dropdown-menu-end">
            <li><a class="dropdown-item" href="dashboard.php?deco=ok">Déconnexion</a></li>
          </ul>
        </li>
      </ul>
    </div>
  </div>
</nav>