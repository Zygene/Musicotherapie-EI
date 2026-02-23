<?php
session_start();
if(!isset($_SESSION['login'])) {
    header("LOCATION:index.php");
    exit;
}

if(isset($_GET['id'])) {
    $id = htmlspecialchars($_GET['id']);
} else {
    header("LOCATION:contact.php");
    exit;
}

require "../connexion.php";
$req = $bdd->prepare("
    SELECT id, prenom, nom, email, telephone, message, 
           DATE_FORMAT(date, '%d/%m/%Y %Hh%i') as mydate 
    FROM contact 
    WHERE id=?
");
$req->execute([$id]);
if(!$don = $req->fetch()) {
    $req->closeCursor();
    header("LOCATION:contact.php");
    exit;
}
$req->closeCursor();

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

$telephone = formatTelephone($don['telephone']);
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
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

    <link rel="stylesheet" href="../bootstrap/css/bootstrap.min.css">
    <link rel="stylesheet" href="admin.css">
    <title>Message de <?= htmlspecialchars($don['prenom'] . ' ' . $don['nom']) ?></title>
    <script src="../bootstrap/js/bootstrap.bundle.min.js"></script>
</head>
<body class="admin-page">

<?php include("partials/header.php"); ?>

<div class="text-center mb-3">
    <a href="contact.php" class="btn btn-retour">Retour</a>
</div>

<div class="d-flex justify-content-center mt-4">
    <div class="conteneur-services conteneur-ajout-service" style="margin-top: 2.5vh">

        <h1 class="titre-services text-center mb-2"><?= htmlspecialchars($don['prenom'] . ' ' . $don['nom']) ?></h1>
        <h5 class="text-center text-muted mb-4">Envoyé le <?= $don['mydate'] ?></h5>

        <div class="info-contact text-center mb-4">
            <p><strong>E-mail:</strong> <?= htmlspecialchars($don['email']) ?></p>
            <p><strong>Téléphone:</strong> <?= htmlspecialchars($telephone) ?></p>
        </div>

        <div class="message-texte p-4 mb-4" style="background-color: #b0c0b023;">
            <?= nl2br(htmlspecialchars($don['message'])) ?>
        </div>

        <div class="text-center mt-4">
            <a href="mailto:<?= htmlspecialchars($don['email']) ?>" class="btn bouton-connexion mx-2">Répondre</a>
        </div>

    </div>
</div>

</body>
</html>