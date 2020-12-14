<?php
// var_dump($_POST); aide au développement, permet un contrôle : réception des données envoyées par ailleurs

?>

<div id="content" style="background: rgb(177, 213, 228);">
    <h3> Inscrivez-vous</h3>

        <form action="index.php?page=ajoutinscrit" method="POST" >
            <label for="pseudo"> Votre pseudo </label>
            <input type="text" id="pseudo" name="pseudo" placeholder="saisir votre pseudo">
            <label for="motpass"> Votre mot de passe </label>
            <input type="text" id="motpasse" name="motpass" placeholder="saisir votre mot de passe">
            <label for="confmotpasse"> Confirmer votre mot de passe </label>
            <input type="text" id="confmotpasse" name="confmotpasse" placeholder="saisir votre mot de passe">
            <input type="submit" id="envoyer" name="envoyer">
        </form>

</div>
