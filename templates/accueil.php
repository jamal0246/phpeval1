<?php 

// Affichage des messages d'erreurs de saisie envoyés depuis l'index.php par les fonctions
if(isset($_SESSION["errors"])): ?>
    <ul>
        <?php foreach($_SESSION["errors"] as $error): ?>
            <li><?= $error ?></li>
        <?php endforeach ?>
    </ul>
<?php unset($_SESSION["errors"]) ?>
<?php endif ?>


<div style="background: rgb(177, 213, 228)">
    <h2> Accueil </h2>
        <p> Bienvenue sur la page d'accueil de l'organisateur personnel. <br> 
            Ce site est fictif. <br>
            Il est réalisé dans un but de formation.<br>
        </p>

</div>
