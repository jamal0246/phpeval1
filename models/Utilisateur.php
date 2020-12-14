<?php

class Utilisateur {
    private $id_utilisateur;
    private $pseudo;
    private $motpasse;

    function __construct(string $id_utilisateur, string $pseudo,  string $motpasse){
        $this->id_utilisateur = $id_utilisateur;
        $this->pseudo = $pseudo;
        $this->motpasse = $motpasse;
    }

    function save_user() {
        // en cours d'élaboration
    }


}

