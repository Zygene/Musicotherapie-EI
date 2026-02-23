<?php
    session_start();
    require "../connexion.php";

    if(isset($_SESSION['login']))
    {
        header("LOCATION:dashboard.php");
    }

    // formulaire déjà envoyé ou non
    if(isset($_POST['login']) && isset($_POST['password']))
    {
        // si vide ou non
       if(empty($_POST['login']) OR empty($_POST['password']))
       {
        $error = "Veuillez remplir le formulaire correctement";
       }else{
            // traitement du login et mot passe
            $login = htmlspecialchars($_POST['login']);
            $req = $bdd->prepare("SELECT * FROM identifiant WHERE login=?");
            $req->execute([$login]);
            if($don = $req->fetch())
            {
                // login existe
                // vérifier mot de passe
                if(password_verify($_POST['password'],$don['password']))
                {
                    // ok connexion
                    $_SESSION['login'] = $don['login'];
                    $req->closeCursor();
                    header("LOCATION:dashboard.php");
                }else{
                    // mot de passe incorrect
                    $error = "Identifiant ou mot de passe incorrect.";
                }
            }else{
                // login n'existe pas
                $error = "Identifiant ou mot de passe incorrect.";
            }
            $req->closeCursor();
       }
    }

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
<title>Connexion Admin</title>

</head>
<body class="admin-page admin-login">

<div class="formulaire-admin">
    <h1 class="titre-formulaire">Connexion Admin</h1>

    <?php
        if(isset($error)) {
            echo "<div class='alert alert-danger alerte-erreur'>".$error."</div>";
        }
    ?>

    <form action="index.php" method="POST">
        <div class="mb-4">
            <label for="identifiant">Identifiant</label>
            <input type="text" id="identifiant" name="login" class="form-control champ-texte" required>
        </div>

        <div class="mb-4">
            <label for="motdepasse">Mot de passe</label>
            <input type="password" id="motdepasse" name="password" class="form-control champ-texte" required>
        </div>

        <div class="text-center mt-3">
            <button type="submit" class="btn bouton-connexion btn-lg">Connexion</button>
        </div>

        <div class="text-center">
            <a href="../index.php" class="lien-retour">← Retour au site</a>
        </div>
    </form>
</div>

</body>
</html>