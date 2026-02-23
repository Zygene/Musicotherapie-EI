<?php
session_start();
if(!isset($_SESSION['login'])) {
    header("LOCATION:index.php");
    exit;
}

require "../connexion.php";

$limit = 5;
$reqcount = $bdd->query("SELECT * FROM temoignages");
$count = $reqcount->rowCount();
$nbpage = ceil($count / $limit);

$pg = isset($_GET['page']) ? intval($_GET['page']) : 1;
$offset = ($pg - 1) * $limit;

if(isset($_GET['delete'])) {
    $id = intval($_GET['delete']);

    $verif = $bdd->prepare("SELECT nom FROM temoignages WHERE id=?");
    $verif->execute([$id]);
    if($donVerif = $verif->fetch()) {
        $nomSupprime = $donVerif['nom'];

        $delete = $bdd->prepare("DELETE FROM temoignages WHERE id=?");
        $delete->execute([$id]);
        $delete->closeCursor();

        $verif->closeCursor();

        header("LOCATION:temoignages.php?successDelete=".urlencode($nomSupprime));
        exit;
    } else {
        $verif->closeCursor();
        header("LOCATION:temoignages.php?error=notfound");
        exit;
    }
}

if(isset($_GET['toggle'])) {
    $id = intval($_GET['toggle']);
    $req = $bdd->prepare("SELECT visible FROM temoignages WHERE id=?");
    $req->execute([$id]);
    if($don = $req->fetch()) {
        $newValue = ($don['visible'] == 1) ? 0 : 1;
        $update = $bdd->prepare("UPDATE temoignages SET visible=? WHERE id=?");
        $update->execute([$newValue, $id]);
        $update->closeCursor();
    }
    $req->closeCursor();
    header("LOCATION:temoignages.php");
    exit;
}
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
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

    <title>Administration des témoignages</title>
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
        <h1 class="titre-services">Témoignages</h1>

        <div class="text-center mt-4">
            <a href="addTemoignage.php" class="btn bouton-connexion">Ajouter un témoignage</a>
        </div>

        <?php
        if(isset($_GET['successDelete'])){
            $nomTemoignage = htmlspecialchars($_GET['successDelete']);
            echo "<div class='alerte-services alert alert-danger'>Le témoignage de <strong>$nomTemoignage</strong> a été supprimé avec succès.</div>";
        }
        if(isset($_GET['successAdd'])){
            $nomTemoignage = htmlspecialchars($_GET['successAdd']);
            echo "<div class='alerte-services alert alert-success'>Le témoignage de <strong>$nomTemoignage</strong> a été ajouté avec succès.</div>";
        }
        if(isset($_GET['successUpdate'])) {
            $idUpdate = intval($_GET['successUpdate']);
            $reqNom = $bdd->prepare("SELECT nom FROM temoignages WHERE id=?");
            $reqNom->execute([$idUpdate]);
            if($donNom = $reqNom->fetch()) {
                $nomTemoignage = htmlspecialchars($donNom['nom']);
                echo "<div class='alerte-services alert alert-success'>Le témoignage de <strong>$nomTemoignage</strong> a été modifié avec succès.</div>";
            }
            $reqNom->closeCursor();
        }
        if(isset($_GET['error'])) {
            echo "<div class='alerte-services alert alert-danger'>Une erreur est survenue (code: ".$_GET['error'].")</div>";
        }
        ?>

        <table class="table table-striped">
            <thead>
                <tr>
                    <th>Nom</th>
                    <th>Contexte</th>
                    <th>Message</th>
                    <th>Date de création</th>
                    <th>Visibilité</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
            <?php
            $req = $bdd->prepare("SELECT * FROM temoignages ORDER BY id ASC LIMIT :offset, :limit");
            $req->bindValue(':offset', $offset, PDO::PARAM_INT);
            $req->bindValue(':limit', $limit, PDO::PARAM_INT);
            $req->execute();

            while($don = $req->fetch()) {
                echo "<tr>";
                echo "<td>".htmlspecialchars($don['nom'])."</td>";
                echo "<td>".htmlspecialchars($don['contexte'])."</td>";
                echo "<td>".nl2br(htmlspecialchars($don['texte']))."</td>";

                $fmt = new IntlDateFormatter('fr_FR', IntlDateFormatter::LONG, IntlDateFormatter::NONE);
                $fmt->setPattern('d MMMM yyyy');
                $dateObj = new DateTime($don['date']);
                echo "<td>".$fmt->format($dateObj)."</td>";

                echo "<td>";
                if($don['visible']) {
                    echo "<span class='badge bg-success'>Visible</span><br>";
                    echo "<a href='temoignages.php?toggle=".$don['id']."' class='btn btn-sm btn-outline-danger mt-1'>Masquer</a>";
                } else {
                    echo "<span class='badge bg-danger'>Masqué</span><br>";
                    echo "<a href='temoignages.php?toggle=".$don['id']."' class='btn btn-sm btn-outline-success mt-1'>Afficher</a>";
                }
                echo "</td>";

                echo "<td class='text-center'>";
                echo "<a href='updateTemoignage.php?id=".$don['id']."' class='btn btn-service-modifier m-1'>Modifier</a>";
                echo "<a href='temoignages.php?delete=".$don['id']."' class='btn btn-service-supprimer m-1' onclick='return confirm(\"Voulez-vous vraiment supprimer ce témoignage ?\")'>Supprimer</a>";
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
                            <a class="page-link" href="temoignages.php?page=<?= $cpt ?>"><?= $cpt ?></a>
                        </li>
                    <?php endfor; ?>
                </ul>
            </nav>
        <?php endif; ?>

    </div>
</div>

</body>
</html>