<?php
// var_dump($_POST); aide au développement, permet un contrôle : réception des données envoyées par ailleurs

?>

<div id="content" style="background: rgb(177, 213, 228);">
    <h3> Inscrivez-vous</h3>

        <form action="index.php?page=ajoutinscrit" method="POST">
            <label for="id_utilisateur"> id_utilisateur </label>
            <input type="text" id="id_utilisateur" name="id_utilisateur" placeholder="saisir votre id_utilisateur">
            <label for="pseudo"> Votre pseudo </label>
            <input type="text" id="pseudo" name="pseudo" placeholder="saisir votre pseudo">
            <label for="motpasse"> Votre mot de passe </label>
            <input type="text" id="motpasse" name="motpasse" placeholder="saisir votre mot de passe">
            <button type="submit" id="envoyer" name="envoyer">Envoyer </button>
        </form>

</div>