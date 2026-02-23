<?php
    require "connexion.php";
    $page = 'contact';
    $bandeTitre = "Entrons en contact";
    $bandeCouleur = "bleu";
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <link rel="apple-touch-icon" sizes="57x57" href="/images/icones/apple-touch-57px.png">
    <link rel="apple-touch-icon" sizes="72x72" href="/images/icones/apple-touch-72px.png">
    <link rel="apple-touch-icon" sizes="76x76" href="/images/icones/apple-touch-76px.png">
    <link rel="apple-touch-icon" sizes="114x114" href="/images/icones/apple-touch-114px.png">
    <link rel="apple-touch-icon" sizes="120x120" href="/images/icones/apple-touch-120px.png">
    <link rel="apple-touch-icon" sizes="144x144" href="/images/icones/apple-touch-144px.png">
    <link rel="apple-touch-icon" sizes="152x152" href="/images/icones/apple-touch-152px.png">

    <link rel="icon" type="image/svg+xml" href="/images/icones/favicon-svg.svg" media="(prefers-color-scheme: light)">
    <link rel="icon" type="image/png" sizes="32x32" href="/images/icones/favicon-32px.png" media="(prefers-color-scheme: light)">
    <link rel="icon" type="image/png" sizes="16x16" href="/images/icones/favicon-16px.png" media="(prefers-color-scheme: light)">

    <link rel="icon" type="image/svg+xml" href="/images/icones/favicon-dark-svg.svg" media="(prefers-color-scheme: dark)">
    <link rel="icon" type="image/png" sizes="32x32" href="/images/icones/favicon-dark-32px.png" media="(prefers-color-scheme: dark)">
    <link rel="icon" type="image/png" sizes="16x16" href="/images/icones/favicon-dark-16px.png" media="(prefers-color-scheme: dark)">

    <link rel="mask-icon" href="/images/icones/safari-svg.svg" color="#000000">

    <link rel="stylesheet" href="style.css?v=<?php echo time(); ?>">
    <title>Léna Rousseau - Me contacter</title>
</head>
<body>

    <?php include 'header.php'; ?>

    <div class="contact-page">

        <div class="contact-titre">
            <h1>Chaque accompagnement commence par un échange.</h1>
            <h1>Ce premier message est une première note.</h1>
        </div>

        <div class="contact-container">

            <div class="contact-form">

                <div id="form-message" class="form-message"></div>

                <form id="my-form" method="POST" action="traitement.php">

                    <div class="form-aligne">

                        <div class="form-group">
                            <label for="prenom">Prénom</label>
                            <input type="text" id="prenom" name="prenom">
                        </div>

                        <div class="form-group">
                            <label for="nom">Nom</label>
                            <input type="text" id="nom" name="nom">
                        </div>

                    </div>

                    <div class="form-group">
                        <label for="email">Email</label>
                        <input type="email" id="email" name="email">
                    </div>

                    <div class="form-group telephone-group">
                        <label for="telephone">Téléphone</label>

                        <div class="telephone-wrapper">
                            <select id="prefix" name="prefix">
                                <option value="+32">BE +32</option>
                                <option value="+33">FR +33</option>
                                <option value="+352">CH +352</option>
                            </select>

                            <input type="text" id="telephone" name="telephone">
                        </div>
                    </div>

                    <div class="form-group">
                        <label for="message">Message</label>
                        <textarea id="message" name="message" rows="15"></textarea>
                    </div>

                    <div class="form-submit" style="position: relative;">
                        <div id="success-bubble" class="success-bubble"></div>
                        <button type="submit">Envoyer</button>
                    </div>

                </form>
            </div>


            <div class="contact-info">

                <div class="info-top">

                    <div class="info-bloc">

                        <div class="info-item">
                            <span class="symbole-mail"></span>
                            <div>
                                <h2>Coordonnées</h2>
                                <p>+32 (0)473 45 64 14</p>
                                <p>lena.rousseau@gmail.com</p>
                            </div>
                        </div>

                        <div class="info-item">
                            <span class="symbole-localisation"></span>
                            <div>
                                <h2>Localisation</h2>
                                <p>Rue des Alliés 18</p>
                                <p>7080 Frameries - Belgique</p>
                            </div>
                        </div>

                    </div>

                    <div class="info-image">
                        <img src="images/general/Plante1-mixed.svg" alt="Plante">
                    </div>

                </div>

                <div class="map">
                    <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d2542.652199589669!2d3.892058676949266!3d50.41031909025201!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x47c25a54503f46df%3A0xf3166c05a33c285e!2sRue%20des%20Alli%C3%A9s%2018%2C%207080%20Frameries!5e0!3m2!1sfr!2sbe!4v1771605615102!5m2!1sfr!2sbe" width="600" height="350" style="border:0;" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>
                </div>

            </div>

        </div>
    </div>

    <script src="valid.js"></script>

    <?php include 'footer.php'; ?>

</body>
</html>