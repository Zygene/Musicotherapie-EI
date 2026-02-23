<?php
session_start();
if(!isset($_SESSION['login'])){
    header("LOCATION:index.php");
    exit;
}

if(!isset($_GET['image'])){
    die("Aucune image fournie");
}

$imageName = basename($_GET['image']);
$imagePath = "../images/".$imageName;

if(!file_exists($imagePath)){
    die("Fichier introuvable");
}

$info = getimagesize($imagePath);
if(!$info){
    die("Impossible de lire l'image");
}

$width_orig = $info[0];
$height_orig = $info[1];
$type = $info[2]; 

$maxWidth = 1000;

if($width_orig > $maxWidth){
    $ratio = $maxWidth / $width_orig;
    $newWidth = $maxWidth;
    $newHeight = round($height_orig * $ratio);
} else {
    $newWidth = $width_orig;
    $newHeight = $height_orig;
}

switch($type){
    case IMAGETYPE_JPEG:
        $source = imagecreatefromjpeg($imagePath);
        break;
    case IMAGETYPE_PNG:
        $source = imagecreatefrompng($imagePath);
        break;
    default:
        die("Format d'image non supporté");
}

$destination = imagecreatetruecolor($newWidth, $newHeight);

if($type == IMAGETYPE_PNG){
    imagealphablending($destination, false);
    imagesavealpha($destination, true);
}

imagecopyresampled($destination, $source, 0,0,0,0, $newWidth, $newHeight, $width_orig, $height_orig);

$miniPath = "../images/mini_".$imageName;
if($type == IMAGETYPE_JPEG){
    imagejpeg($destination, $miniPath, 90);
} elseif($type == IMAGETYPE_PNG){
    imagepng($destination, $miniPath, 6);
}

imagedestroy($source);
imagedestroy($destination);

if(isset($_GET['update'])){
    header("LOCATION:services.php?updatesuccess=".$_GET['update']);
} else {
    header("LOCATION:services.php?addsuccess=ok");
}
exit;
?>
