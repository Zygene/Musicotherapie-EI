<?php 
session_start();
if(!isset($_SESSION['login'])) {
    header("LOCATION:index.php");
    exit;
}

if(isset($_POST['nom'])) {

    $err = 0;

    $nom = !empty($_POST['nom']) ? htmlspecialchars($_POST['nom']) : $err=1;
    $description = !empty($_POST['description']) ? htmlspecialchars($_POST['description']) : $err=2;
    $objectifs = !empty($_POST['objectifs']) ? htmlspecialchars($_POST['objectifs']) : '';
    $duree = !empty($_POST['duree']) ? htmlspecialchars($_POST['duree']) : $err=3;
    $prix = !empty($_POST['prix']) ? htmlspecialchars($_POST['prix']) : $err=4;
    $date = !empty($_POST['date']) ? htmlspecialchars($_POST['date']) : date('Y-m-d');

    if($err === 0) {

        require "../connexion.php";

        $fichierUnique = null;
        if(isset($_FILES['image']) && $_FILES['image']['error'] == 0){
            $dossier = "../images/services/";
            $fichier = basename($_FILES['image']['name']);
            $taille_maxi = 2000000;
            $taille = filesize($_FILES['image']['tmp_name']);
            $extensions = ['.png','.jpg','.jpeg'];
            $extension = strtolower(strrchr($fichier,'.'));

            if(!in_array($extension, $extensions)){
                header("LOCATION:addService.php?errorimg=1"); exit;
            }
            if($taille > $taille_maxi){
                header("LOCATION:addService.php?errorimg=2"); exit;
            }

            $fichier = strtr($fichier, 
                'ÀÁÂÃÄÅÇÈÉÊËÌÍÎÏÒÓÔÕÖÙÚÛÜÝàáâãäåçèéêëìíîïðòóôõöùúûüýÿ', 
                'AAAAAACEEEEIIIIOOOOOUUUUYaaaaaaceeeeiiiioooooouuuuyy');
            $fichier = preg_replace('/([^.a-z0-9]+)/i','-',$fichier); 
            $fichierUnique = rand().$fichier;

            if(!move_uploaded_file($_FILES['image']['tmp_name'], $dossier.$fichierUnique)){
                header("LOCATION:addService.php?errorimg=3"); exit;
            }
        }

        $insert = $bdd->prepare("
            INSERT INTO services(nom, description, objectifs, duree, prix, image, date)
            VALUES(?,?,?,?,?,?,?)
        ");
        $insert->execute([$nom, $description, $objectifs, $duree, $prix, $fichierUnique, $date]);
        $insert->closeCursor();

        header("LOCATION:services.php?successAdd=".urlencode($nom));
        exit;

    } else {
        header("LOCATION:addService.php?error=".$err);
        exit;
    }

} else {
    header("LOCATION:addService.php");
    exit;
}
?>
