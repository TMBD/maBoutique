<?php
    /*
    Ce fichier joue le rôle de model
    crée le 13/08/2017
    */

    //Initialisation des variables
    $host = "localhost";
    $user = "root";
    $pwd = "";
    $db = "maboutique";

    //Fontion qui permet d'obtenir tous les produits
    function getAllProduits(){
        global $host, $user, $pwd, $db;

        //Connexion à la base de données
        $conn = mysqli_connect($host, $user, $pwd, $db);

        // Création de la requête
        $req = "SELECT * FROM produit";

        // On envoie la requête 
        $res = $conn->query($req);

        //On ferme la connection
        mysqli_close($conn);
        //Et on retourne la réponse
        return $res;
    }

    //Fontion qui permet de d'ajouter un produit ou de modifier la quantité d'un produit
    function insertProduits($p, $q){
        global $host, $user, $pwd, $db;

        //On cherche d'abord tous les produits
        $res = getAllProduits();

        //On initialise la variable qui nous permettra de savoir si le produit existe déja
        $find = false;

        //On cherche si le produit existe
        while ((!$find)&&($data = mysqli_fetch_array($res))) {
            $find = $data['nom']==$p;
        }
        
        if(!$find){ //Si le produit n'existe pas, on crée une requette d'insertion
            $req = "INSERT INTO produit(nom,quantite) VALUES ('".$p."',".$q.")"; //La requette d'ajout
        }else{ //Sinon on crée une requette de mise à jour
            $nomProduit = $data['nom'];
            $newQuantite =$data['quantite']+$q; //On additionne l'ancienne et la nouvelle quantité
            $req = "UPDATE produit SET quantite=$newQuantite WHERE nom='".$nomProduit."'"; //La requette de mise à jour
        }

        //Maintenant on se connect à la base données
        $conn = mysqli_connect($host, $user, $pwd, $db); 

        // on envoie la requête
        $req = $conn->query($req);

        //On ferme la connexion
        mysqli_close($conn);

        // On retourne la réponse
        return $res;
    }

    function supprimerProduit($nom){
        global $host, $user, $pwd, $db;

        //Connexion à la base de données
        $conn = mysqli_connect($host, $user, $pwd, $db);

        // Création de la requête
        $req = "DELETE FROM produit WHERE nom='".$nom."'";

        // On envoie la requête 
        $res = $conn->query($req);

        //On ferme la connection
        mysqli_close($conn);
        
        //Et on retourne la réponse
        return $res;
    }
?>