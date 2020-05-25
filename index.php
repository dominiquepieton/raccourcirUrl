<?php
require 'functions.php';
//Verification
verif('q');
//nouveau envoi
newPost('url');
?>
<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link href="https://fonts.googleapis.com/css2?family=Poppins&display=swap" rel="stylesheet">
        <link rel="stylesheet" href="public/css/style.css">
        <link rel="icon" href="public/img/favico.png" type="image/png">
        <title>Url-raccourcisseur</title>
    </head>
    <body>
        <section class="container">
            <div class="content">
                <header>
                    <img class="logo" alt="logo du site" src="public/img/logo.png" />
                </header>
                <h1 class="txt-animation"></h1>
                <h2>Url plus court que les autres, vous serez meilleur...</h2>
                <form action="index.php" method="post">
                    <input type="url" name ="url" placeholder="url à raccourcir..." />
                    <input type="submit" value="soumettre" />
                </form>
            <?php if(isset($_GET['error']) && isset($_GET['message'])): ?>
                <div class="center">
                    <div class="error">
                        <b><?= htmlspecialchars($_GET['message']) ?></b>
                    </div>
                </div>   
            <?php elseif(isset($_GET['short'])): ?>
                <div class="center">
                <div class="error">
                        <b>URL RACCOURCIE :</b> <a class="link" href="http://localhost/raccourcirUrl/index.php?q=<?= htmlspecialchars($_GET['short']) ?>" target= _blank><?= htmlspecialchars($_GET['short']) ?></a><br>
                        <p>Votre url sera : http://localhost/raccourcirUrl/index.php?q=<?= htmlspecialchars($_GET['short']) ?>.</p>
                    </div>
                </div>
            <?php endif ?>        
            </div>
        </section>
        <section class="brands">
            <div class="content">
                <h3>les marques qui nous font confiance</h3>
                <img src="public/img/1.png" alt="logo d'entreprise" class="picture">
                <img src="public/img/2.png" alt="logo d'entreprise" class="picture">
                <img src="public/img/3.png" alt="logo d'entreprise" class="picture">
                <img src="public/img/4.png" alt="logo d'entreprise" class="picture">
            </div>
        </section>
        <footer>
            <img src="public/img/logo2.png" alt="logo du site" class="logo2">
            <p class="text">2020 © DOM</p>
            <a href="#" class="link">Contact</a>   <a href="#" class="link">À propos</a>
        </footer>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/gsap/3.2.6/gsap.min.js"></script>
        <script src="https://unpkg.com/typewriter-effect@latest/dist/core.js"></script>
        <script src="public/js/app.js"></script>         
    </body>
</html>