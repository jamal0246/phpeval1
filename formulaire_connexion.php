<?php
// var_dump($_POST); aide au développement, permet un contrôle : réception des données envoyées par ailleurs

//echo "Je récupère le contenu de mon fichier utilisateurs.json :<br>";
$contenu = (file_exists("datas/utilisateurs.json"))? file_get_contents("datas/utilisateurs.json") : "";
//var_dump($contenu);

//echo "Je décode mon JSON en structure PHP (tableau associatif) :<br>";
$utilisateurs = json_decode($contenu);
//var_dump($utilisateurses);

// Je vérifie si ma structure est un tableau puis je l'affiche sinon je le crée
$utilisateurs = (is_array($utilisateurs))? $utilisateurs : [];

// Je compte le nombre d'entrée dans mon tableau pour en déduire la dernière clé (nombre d'entrée -1)
//$len=count($utilisateurs);
//var_dump($len);

// Je vérifie s'il existe au moin une clé et je retourne la valeur $len (n° de la clé prochaine créée) 
//sinon jaffecte la valeur 0 à la variable pour son utilisation dans le formulaire ci-dessous 
// id_session est créé avec la varialble "$idcle" et envoyé par le formulaire vers la fonction insert_user() dans index.php
// Je compte le nombre d'entrée dans mon tableau pour en déduire la dernière clé (nombre d'entrée -1)
$len=count($utilisateurs);
//var_dump($len);

// Je vérifie s'il existe au moin une clé et je retourne la valeur $len (n° de la clé prochaine créée) 
//sinon jaffecte la valeur 0 à la variable pour son utilisation dans le formulaire ci-dessous 
// id_session est créé avec la varialble "$idcle" et envoyé par le formulaire vers la fonction insert_user() dans index.php
$idcle= (array_key_exists($len-1, $utilisateurs) ?  $len : 0);
//var_dump($idcle);


?>

<div id="content" style="background: rgb(177, 213, 228)">
    <h3> Formulaire de connexion</h3>

        <form action="index.php?page=connexion&idinscrit= <?=$idcle?>" method="POST"> <!-- routage des données envoyées par le script dont l'id_session par idinscript -->
            <label for="pseudo"> Votre pseudo </label>
            <input type="text" id="pseudo" name="pseudo" placeholder="saisir votre pseudo">
            <label for="motpasse"> Votre mot de passe </label>
            <input type="text" id="motpasse" name="motpasse" placeholder="saisir votre mot de passe">
            <button type="submit" id="connexion" name="connexion"> Connexion   </button>
        </form>

</div>
