<?php

    /*
    Ce fichier joue le rôle d'intermediaire entre la vue et le model
    crée le 14/08/2017
    */
    
    //inclusion de boutique.mainController.php dans lequel se trouve la methode createTable
    include "../controller/boutique.mainController.php";

    if(isset($_GET["l"])) { // Si la variable existe
        if($_GET["l"]){ // Si la variable est bien renseignée
            //on appel la fonction de suppression depuis le model
            supprimerProduit($_GET["l"]);
            //On recharge la table
            $newTab = createTable();
            //on renvoi la table dans la vu pour l'afficher
            header("Location: ../view/index.php?err=0&newTab=".$newTab);
        }else{ //si la variable $_GET["l"] n'existe pas on appel la vue avec la variable err=-1
            header("Location: ../view/index.php?err=-1");
        }
    }
?>