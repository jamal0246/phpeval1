<?php
//var_dump($_SESSION);

require_once "models/Utilisateur.php";
$connect=unserialize($_SESSION["user"]);
//var_dump($connect);

// J'appelle la fonction "getPseudo()" pour recevoir le nom du pseudo connecté pour ensuite personnaliser la page
$pseudo=$connect->getPseudo();
$idutilisateur=$connect->getId_utilisateur();
var_dump($connect->getId_utilisateur());

// Liste des taches saisies au cours de la session de connexion en cours
 // en cours délaboration





?>


<div style="background: rgb(187, 243, 187)">

        <h3>Mon espace </h3>
                <div>
                        <p> Bonjour <?= $pseudo?> , vous êtes bien connecté.</p> <br>
                </div>

                <div>
                        <h4> Formulaire de saisie de la tâche </h4>
                </div>

                <div>
                        <form action="index.php?page=inserttache&idutilisateur=<?=$idutilisateur?>" method="POST" >
                                <label for="nom">Tâche</label>       
                                <input type="text" id="nom" name="nom" placeholder="Saisir le nom de la tâche" >
                                <label for="date"></label>
                                <input type="date" id="date" name="date">
                                
                                <button type="submit" id="enregistrer" name="enregistrer"> Enregistrer </button>
                        
                        </form>
                </div>

                <div>
                        <h4> Formulaire de saisie de la tâche </h4>
                <div>
                <div>
                        <p>Liste des tâches de la session en cours de connection</p>
                <div>

                <div>
                        <table>
                        <thead>
                                <tr>
                                <th>Id utilisateur</th>
                                <th>Tâche</th>
                                <th>Date limite</th>
                                </tr>
                        </thead>
                        <tbody>
                                <tr>
                                <td> </td>
                                <td> </td>
                                <td> </td>
                                </tr>
                        </tbody>
                        </table>
                </div>
</div>