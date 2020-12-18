<?php
//var_dump($_SESSION);

require_once "models/Utilisateur.php";
$connect=unserialize($_SESSION["user"]);
//var_dump($connect);

// J'appelle la fonction "getPseudo()" pour recevoir le nom du pseudo connecté pour ensuite personnaliser la page
$pseudo=$connect->getPseudo();
$idutilisateur=$connect->getId_utilisateur();
//var_dump($connect->getId_utilisateur());


//****************************************** Liste des tâches */

// Liste des taches saisies au cours de la session de connexion en cours
 // en cours délaboration

 $contenu = (file_exists("datas/taches.json"))? file_get_contents("datas/taches.json") : "";
 //var_dump($contenu);

 //echo "Je décode mon JSON en structure PHP (tableau associatif) :<br>";
 $taches = json_decode($contenu);
 //var_dump($taches);

 $taches = (is_array($taches))? $taches : [];


 //Aide au contrôle de la bonne réception des données pour traitement de la liste des tâches enregistrées lors d'une même session
 //foreach ($taches as $key=>$tache){

        //if($tache->id_utilsateur_t == $idutilisateur){
               // var_dump($tache->id_utilsateur_t);
               // var_dump($tache->nomtache);
               // var_dump($tache->description);
               // var_dump($tache->datelimite);
        //}
 //}

?>


<div style="background: rgb(187, 243, 187)">

        <h3>Mon espace </h3>
                <div>
                        <p> Bonjour <?= $pseudo?> , vous êtes bien connecté.</p> <br> <hr>
                </div>
                <div>
                        <h4> Formulaire de saisie de la tâche </h4>
                </div>
                <div>
                        <form action="index.php?page=inserttache&idutilisateur=<?=$idutilisateur?>" method="POST" >
                                <label for="nom">Tâche</label>       
                                <input type="text" id="nom" name="nom" placeholder="Saisir le nom de la tâche" minlength="0" maxlength="16" size="10">
                                <label for="descrpition"> Descrption de la tâche </label>
                                <textarea id="description" name="description"  cols="30" rows="10"> Décrire la tâche </textarea>
                                <label for="date"></label>
                                <input type="date" id="date" name="date" required>
                                
                                <button type="submit" id="enregistrer" name="enregistrer"> Enregistrer </button>
                        </form>
                        <hr>
                </div>
                <div>
                        <h4> Liste des tâches de la session en cours de connexion </h4>
                <div>
                <div>
                        <table>
                                <thead>
                                <tr>
                                        <th>Id_utilisateur</th>
                                        <th>Tâche</th>
                                        <th>Description de la tâche</th>
                                        <th>Date limite</th>
                                </tr>
                                </thead>

                                <tbody>
                                <?php foreach ($taches as $key=>$tache){
                                        if($tache->id_utilsateur_t == $idutilisateur) {
                                        echo "<tr>";
                                        echo "<th>" .  $tache->id_utilsateur_t . "</th>";
                                        echo "<th>" .  $tache->nomtache . "</th>";
                                        echo "<th>" .  $tache->description . "</th>";
                                        echo "<th>" .  $tache->datelimite . "</th>";
                                        } 
                                }
                                ?>
                                </tbody>    
                        </table>
                </div>
</div>