<?php

    /*
    Ce fichier joue le rôle d'intermediaire entre la vue et le model
    crée le 13/08/2017
    */
    
    //inclusion de fraction.model.php dans lequel se trouve les methodes getAllProduits et insertProduits
    include "../model/boutique.mainModel.php"; 

    if(isset($_GET["p"]) && isset($_GET["q"])) { // Si les variables existent
        if($_GET["p"] && $_GET["q"] && is_numeric($_GET["q"])){ // Si les variables sont bien renseignées
            //on insert le produit ou on modifie sa quantité s'il existe déja
            insertProduits($_GET["p"], $_GET["q"]);
            //On recharge la table
            $newTab = createTable();
            //on renvoi la table dans la vu pour l'afficher
            header("Location: ../view/index.php?err=0&newTab=".$newTab);
        }else{ //si les variables $_GET["p"] et $_GET["q"] n'existe pas on appel la vue avec la variable err=1
            header("Location: ../view/index.php?err=1");
        }
    }

    //fonction qui crée la table des produits
    function createTable(){
        //On appel la fonction getAllProduits du modél pour obtenir la lise des produits
        $res = getAllProduits();

       //initialisation de la table 
        $tableContent = "<table style='border: 1px solid black;'><th>PRODUITS</th><th>QUANTITES</th>";

        // on scanne tous les tuples un par un en les ajoutant dans notre table
        while ($data = mysqli_fetch_array($res)) {
            $tableContent =  $tableContent."<tr><td>".$data['nom']."</td><td>".$data['quantite']."</td></tr>";
        }
        
        //fermeture de la table
        $tableContent = $tableContent."</table>";

        //on renvoi le résultat
        echo $tableContent;
    }


    function createOptionlist(){
         //On appel la fonction getAllProduits du modél pour obtenir la lise des produits
        $res = getAllProduits();
        // on scanne tous les tuples un par un en les ajoutant dans notre table
        while ($data = mysqli_fetch_array($res)) {
            $opt=$opt."<option value='".$data['nom']."'>".$data['nom']."</option>";
        }
        echo $opt;
    }

?>