<?php
session_start();
if(!isset($_SESSION['login'])) {
    header("LOCATION:index.php");
    exit;
}

require "../connexion.php";

function formatTelephone($telephone) {
    $telephone = preg_replace('/\s+/', '', $telephone);

    if (preg_match('/^(\+32|\+33|\+352)(\d+)$/', $telephone, $matches)) {
        $prefix = $matches[1];
        $number = $matches[2];

        if (($prefix === '+33' || $prefix === '+32') && substr($number,0,1) === '0') {
            $number = substr($number,1);
        }

        switch ($prefix) {
            case '+32':
                $number = preg_replace('/(\d{3})(\d{2})(\d{2})(\d{0,2})/', '$1 $2 $3 $4', $number);
                break;
            case '+33':
                $number = preg_replace('/(\d{1})(\d{2})(\d{2})(\d{2})(\d{0,2})/', '$1 $2 $3 $4 $5', $number);
                break;
            case '+352':
                $number = preg_replace('/(\d{3})(\d{2})(\d{2})(\d{0,2})/', '$1 $2 $3 $4', $number);
                break;
            default:
                $number = trim(chunk_split($number, 2, ' '));
        }

        return $prefix . ' ' . trim($number);
    }

    return $telephone;
}

if(isset($_GET['delete'])) {
    $idDelete = intval($_GET['delete']);

    $verif = $bdd->prepare("SELECT prenom, nom FROM contact WHERE id=?");
    $verif->execute([$idDelete]);

    if(!$donVerif = $verif->fetch()) {
        $verif->closeCursor();
        header("LOCATION:contact.php");
        exit;
    }

    $prenom = urlencode($donVerif['prenom']);
    $nom    = urlencode($donVerif['nom']);
    $verif->closeCursor();

    $delete = $bdd->prepare("DELETE FROM contact WHERE id=?");
    $delete->execute([$idDelete]);
    $delete->closeCursor();

    header("LOCATION:contact.php?delsuccess=1&prenom=$prenom&nom=$nom");
    exit;
}

$req = $bdd->query("SELECT id, prenom, nom, telephone, email, date FROM contact ORDER BY date DESC");
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Administration des contacts</title>
    <link rel="stylesheet" href="../bootstrap/css/bootstrap.min.css">

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
        <h1 class="titre-services">Messages</h1>

        <?php 
        if(isset($_GET['delsuccess']) && isset($_GET['prenom']) && isset($_GET['nom'])) {
            $prenom = htmlspecialchars($_GET['prenom']);
            $nom    = htmlspecialchars($_GET['nom']);
            echo "<div class='alerte-services alert alert-danger'>
                    Vous avez supprimé le message de <strong>$prenom $nom</strong>.
                  </div>";
        }
        ?>

        <table class="table table-striped">
            <thead>
                <tr>
                    <th>Prénom</th>
                    <th>Nom</th>
                    <th>E-mail</th>
                    <th>Téléphone</th>
                    <th>Date</th>
                    <th class="text-center">Action</th>
                </tr>
            </thead>
            <tbody>
            <?php while($don = $req->fetch()): ?>
                <tr>
                    <td><?= htmlspecialchars($don['prenom']) ?></td>
                    <td><?= htmlspecialchars($don['nom']) ?></td>
                    <td><?= htmlspecialchars($don['email']) ?></td>
                    <td><?= formatTelephone($don['telephone']) ?></td>
                    <?php 
                    $dateObj = new DateTime($don['date']);
                    $fmt = new IntlDateFormatter('fr_FR', IntlDateFormatter::LONG, IntlDateFormatter::NONE);
                    $fmt->setPattern('d MMMM yyyy - HH:mm');
                    ?>
                    <td><?= $fmt->format($dateObj) ?></td>
                    <td class="text-center">
                        <a href="message.php?id=<?= $don['id'] ?>" class="btn btn-service-modifier m-1">Afficher</a>
                        <a href="contact.php?delete=<?= $don['id'] ?>" 
                           class="btn btn-service-supprimer m-1"
                           onclick="return confirm('Voulez-vous vraiment supprimer ce message ?')">Supprimer</a>
                    </td>
                </tr>
            <?php endwhile; ?>
            </tbody>
        </table>

    </div>
</div>

</body>
</html>