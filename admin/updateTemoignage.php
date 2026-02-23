<?php
session_start();
if(!isset($_SESSION['login'])) {
    header("LOCATION:index.php");
    exit;
}

if(isset($_GET['id'])) {
    $id = intval($_GET['id']);
} else {
    header("LOCATION:temoignages.php");
    exit;
}

require "../connexion.php";

$req = $bdd->prepare("SELECT * FROM temoignages WHERE id=?");
$req->execute([$id]);
if(!$don = $req->fetch()) {
    $req->closeCursor();
    header("LOCATION:temoignages.php");
    exit;
}
$req->closeCursor();
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <link rel="apple-touch-icon" sizes="57x57" href="images/icones/apple-touch-monochrome-57px.png">
    <link rel="apple-touch-icon" sizes="72x72" href="images/icones/apple-touch-monochrome-72px.png">
    <link rel="apple-touch-icon" sizes="76x76" href="images/icones/apple-touch-monochrome-76px.png">
    <link rel="apple-touch-icon" sizes="114x114" href="images/icones/apple-touch-monochrome-114px.png">
    <link rel="apple-touch-icon" sizes="120x120" href="images/icones/apple-touch-monochrome-120px.png">
    <link rel="apple-touch-icon" sizes="144x144" href="images/icones/apple-touch-monochrome-144px.png">
    <link rel="apple-touch-icon" sizes="152x152" href="images/icones/apple-touch-monochrome-152px.png">

    <link rel="icon" type="image/svg+xml" href="images/icones/favicon-monochrome-svg.svg" media="(prefers-color-scheme: light)">
    <link rel="icon" type="image/png" sizes="32x32" href="images/icones/favicon-monochrome-32px.png" media="(prefers-color-scheme: light)">
    <link rel="icon" type="image/png" sizes="16x16" href="images/icones/favicon-monochrome-16px.png" media="(prefers-color-scheme: light)">

    <link rel="icon" type="image/svg+xml" href="images/icones/favicon-monochrome-dark-svg.svg" media="(prefers-color-scheme: dark)">
    <link rel="icon" type="image/png" sizes="32x32" href="images/icones/favicon-monochrome-dark-32px.png" media="(prefers-color-scheme: dark)">
    <link rel="icon" type="image/png" sizes="16x16" href="images/icones/favicon-monochrome-dark-16px.png" media="(prefers-color-scheme: dark)">

    <link rel="mask-icon" href="images/icones/safari-svg.svg" color="#000000">

    <link rel="stylesheet" href="../bootstrap/css/bootstrap.min.css">
    <link rel="stylesheet" href="admin.css">
    <title>Modifier le témoignage</title>
    <script src="../bootstrap/js/bootstrap.bundle.min.js"></script>
</head>
<body class="admin-page">

<?php include("partials/header.php"); ?>

<div class="text-center mb-3">
    <a href="temoignages.php" class="btn btn-retour">Retour</a>
</div>

<div class="zone-centrage-services">
    <div class="conteneur-services conteneur-ajout-service">
        <h1 class="titre-services">Modifier le témoignage de <?= htmlspecialchars($don['nom']) ?></h1>

        <?php
        if(isset($_GET['error'])) {
            echo "<div class='alerte-services alert alert-danger my-3'>Une erreur est survenue (code: ".$_GET['error'].")</div>";
        }
        if(!empty($successMessage)) {
            echo "<div class='alerte-services alert alert-success my-3'>$successMessage</div>";
        }
        ?>

        <form action="treatmentUpdateTemoignage.php?id=<?= $id ?>" method="POST" class="mt-4">

            <div class="form-group mb-3">
                <label for="nom">Nom du client</label>
                <input type="text" id="nom" name="nom" class="form-control champ-texte" value="<?= htmlspecialchars($don['nom']) ?>" required>
            </div>

            <div class="form-group mb-3">
                <label for="contexte">Contexte</label>
                <input type="text" id="contexte" name="contexte" class="form-control champ-texte" value="<?= htmlspecialchars($don['contexte']) ?>" required>
            </div>

            <div class="form-group mb-3">
                <label for="texte">Témoignage</label>
                <textarea id="texte" name="texte" class="form-control champ-texte" rows="5" required><?= htmlspecialchars($don['texte']) ?></textarea>
            </div>

            <div class="form-group mb-3">
                <label for="date">Date</label>
                <input type="date" id="date" name="date" class="form-control champ-texte" value="<?= htmlspecialchars($don['date']) ?>" required>
            </div>

            <div class="text-center mt-4">
                <button type="submit" class="btn bouton-connexion">Modifier le témoignage</button>
            </div>

        </form>
    </div>
</div>

</body>
</html>