<?php
session_start();
if(!isset($_SESSION['login'])) {
    header("LOCATION:index.php");
    exit;
}

require "../connexion.php";

$limit = 5;
$reqcount = $bdd->query("SELECT * FROM services");
$count = $reqcount->rowCount();
$nbpage = ceil($count / $limit);

$pg = isset($_GET['page']) ? intval($_GET['page']) : 1;
$offset = ($pg - 1) * $limit;

if(isset($_GET['delete'])) {
    $id = intval($_GET['delete']);

    $verif = $bdd->prepare("SELECT nom FROM services WHERE id=?");
    $verif->execute([$id]);
    if($donVerif = $verif->fetch()) {
        $nomSupprime = $donVerif['nom'];

        $delete = $bdd->prepare("DELETE FROM services WHERE id=?");
        $delete->execute([$id]);
        $delete->closeCursor();

        $verif->closeCursor();

        header("LOCATION:services.php?successDelete=".urlencode($nomSupprime));
        exit;
    } else {
        $verif->closeCursor();
        header("LOCATION:services.php?error=notfound");
        exit;
    }
}

$successMessage = '';
if(isset($_GET['successUpdate'])) {
    $idSuccess = intval($_GET['successUpdate']);
    $reqName = $bdd->prepare("SELECT nom FROM services WHERE id=?");
    $reqName->execute([$idSuccess]);
    if($donName = $reqName->fetch()) {
        $successMessage = "Le service '".$donName['nom']."' a été mis à jour avec succès.";
    }
    $reqName->closeCursor();
}
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <link rel="apple-touch-icon" sizes="57x57" href="/images/icones/apple-touch-monochrome-57px.png">
    <link rel="apple-touch-icon" sizes="72x72" href="/images/icones/apple-touch-monochrome-72px.png">
    <link rel="apple-touch-icon" sizes="76x76" href="/images/icones/apple-touch-monochrome-76px.png">
    <link rel="apple-touch-icon" sizes="114x114" href="/images/icones/apple-touch-monochrome-114px.png">
    <link rel="apple-touch-icon" sizes="120x120" href="/images/icones/apple-touch-monochrome-120px.png">
    <link rel="apple-touch-icon" sizes="144x144" href="/images/icones/apple-touch-monochrome-144px.png">
    <link rel="apple-touch-icon" sizes="152x152" href="/images/icones/apple-touch-monochrome-152px.png">

    <link rel="icon" type="image/svg+xml" href="/images/icones/favicon-monochrome-svg.svg" media="(prefers-color-scheme: light)">
    <link rel="icon" type="image/png" sizes="32x32" href="/images/icones/favicon-monochrome-32px.png" media="(prefers-color-scheme: light)">
    <link rel="icon" type="image/png" sizes="16x16" href="/images/icones/favicon-monochrome-16px.png" media="(prefers-color-scheme: light)">

    <link rel="icon" type="image/svg+xml" href="/images/icones/favicon-monochrome-dark-svg.svg" media="(prefers-color-scheme: dark)">
    <link rel="icon" type="image/png" sizes="32x32" href="/images/icones/favicon-monochrome-dark-32px.png" media="(prefers-color-scheme: dark)">
    <link rel="icon" type="image/png" sizes="16x16" href="/images/icones/favicon-monochrome-dark-16px.png" media="(prefers-color-scheme: dark)">

    <link rel="mask-icon" href="/images/icones/safari-svg.svg" color="#000000">

    <title>Administration des services</title>
    <link rel="stylesheet" href="../bootstrap/css/bootstrap.min.css">
    <link rel="stylesheet" href="admin.css">
    <script src="../bootstrap/js/bootstrap.bundle.min.js"></script>
</head>
<body class="admin-page">

<?php include("partials/header.php"); ?>

<div class="text-center mb-3">
    <a href="dashboard.php" class="btn btn-retour">Retour</a>
</div>

<div class="zone-centrage-services">
    <div class="conteneur-services">
        <h1 class="titre-services">Services</h1>

        <div class="text-center mt-4">
            <a href="addService.php" class="btn bouton-connexion">Ajouter un service</a>
        </div>

        <?php
        if(isset($_GET['successDelete'])){
            $nomTemoignage = htmlspecialchars($_GET['successDelete']);
            echo "<div class='alerte-services alert alert-danger'>Le service '<strong>$nomTemoignage</strong>' a été supprimé avec succès.</div>";
        }
        if(isset($_GET['successAdd'])){
            $service = htmlspecialchars($_GET['successAdd']);
            echo "<div class='alerte-services alert alert-success'>Le service '<strong>$service</strong>' a été ajouté avec succès.</div>";
        }
        if(isset($_GET['successUpdate'])){
            echo "<div class='alerte-services alert alert-success'>Le service '<strong>".htmlspecialchars($_GET['successUpdate'])."</strong>' a été mis à jour avec succès.</div>";
        }
        ?>

        <table class="table table-striped">
            <thead>
                <tr>
                    <th>Nom</th>
                    <th>Description</th>
                    <th>Objectifs possibles</th>
                    <th>Durée</th>
                    <th>Prix</th>
                    <th>Date de création</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                <?php
                $req = $bdd->prepare("SELECT * FROM services ORDER BY id ASC LIMIT :offset, :limit");
                $req->bindValue(':offset', $offset, PDO::PARAM_INT);
                $req->bindValue(':limit', $limit, PDO::PARAM_INT);
                $req->execute();

                while($don = $req->fetch()) {
                    echo "<tr>";
                    echo "<td>".htmlspecialchars($don['nom'])."</td>";
                    echo "<td>".nl2br(htmlspecialchars($don['description']))."</td>";
                    echo "<td>".nl2br(htmlspecialchars($don['objectifs']))."</td>";
                    echo "<td>".$don['duree']."</td>";
                    echo "<td>".(is_numeric($don['prix']) ? $don['prix']." €" : htmlspecialchars($don['prix']))."</td>";
                    $dateObj = new DateTime($don['date']);
                    $fmt = new IntlDateFormatter('fr_FR', IntlDateFormatter::LONG, IntlDateFormatter::NONE);
                    $fmt->setPattern('d MMMM yyyy');
                    echo "<td>".$fmt->format($dateObj)."</td>";

                    echo "<td class='text-center'>";
                    echo "<a href='updateService.php?id=".$don['id']."' class='btn btn-service-modifier m-1'>Modifier</a>";
                    echo "<a href='services.php?delete=".$don['id']."' class='btn btn-service-supprimer m-1' onclick='return confirm(\"Voulez-vous vraiment supprimer ce service ?\")'>Supprimer</a>";
                    echo "</td>";
                    echo "</tr>";
                }

                $req->closeCursor();
                ?>
            </tbody>
        </table>

        <?php if($count > $limit): ?>
            <nav>
                <ul class="pagination">
                    <?php for($cpt=1;$cpt<=$nbpage;$cpt++): ?>
                        <li class="page-item <?= ($cpt==$pg)?'active':'' ?>">
                            <a class="page-link" href="services.php?page=<?= $cpt ?>"><?= $cpt ?></a>
                        </li>
                    <?php endfor; ?>
                </ul>
            </nav>
        <?php endif; ?>

    </div>
</div>

</body>
</html>