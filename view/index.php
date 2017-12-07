<!DOCTYPE html>
<html>
    <head>
        <title>Ma Boutique</title>
        <meta charset="UTF-8">
        <style >
            .divs{
                vertical-align: middle;
                border-style: solid;
                border-width: 1px;
                width: "60%";
                max-width: "60";
                display:flex;
                flex: 1;
                justify-content:center;
                padding: 10px;
            }
            .tableView{
                float: right;
                flex: 0.3;
                margin: 10px;
            }
            .insertView{
                float: right;
                flex: 0.25;
                background: rgb(47, 130, 160);
                margin: 10px;
                color: white;
                height: 170px;
            }
            .modifView{
                flex: 0.15;
                background: #FF4500;
                margin: 10px;
                color: white;
                height: 100px;
            }
            table, th, td {
                border: 1px solid black;
                border-collapse: collapse;
                min-width: 120px;
            }
            th {
                background: rgb(255, 178, 255);
            }
            label, input{
                margin:5px;

            }
        </style>
        </script>
    </head>
    <body>

        <?php
            // On inclut le fichier mainController.php où se trouve la methode createTable
            include "../controller/boutique.mainController.php";

            //Creation du datalist pour le nom des produits
        ?>

        <datalist id="productName">
            <?php
                createOptionlist();
            ?>     
        </datalist>

        <div class='divs' >
            
            <div class = 'tableView'>
                <?php
                    if(isset($_GET["newTabn"]) && $_GET['newTab']){
                        $_GET['newTab'];
                    }else createTable();
                ?>
            </div>

            <div class = 'insertView'>
                
                <form style = "padding: 10px" method="GET" action="../controller/boutique.mainController">
                    <label for="p">Nom du produit : </label><input type="text" name="p" id="p" list="productName" required/></br>
                    <label for="q">Quantité : </label><input type="text" name="q" id="q" required/></br>
                    <input type="submit" value="ajouter"/>
                </form>

                <?php
                    //Si les champs ne sont pa corectement renseignés
                    if(isset($_GET["err"]) && $_GET['err'] && $_GET['err']==1){
                        echo "<p style='color: yellow;'>VEUILLEZ RENSEIGNER CONVENABLEMENT LES CHAMPS</p>";
                    }
                ?>
            </div>
            </br>
            <div class = 'modifView'>
                
                <form style = "padding: 10px" method="GET" action="../controller/boutique.suppressionController.php">
                    <label for="l">Nom du produit : </label></br>
                    <select name="l" id="l" list="productName" required>
                        <?php
                            createOptionlist();

                            //Si le nom du produit n'est pas correctement renseigné
                            if(isset($_GET["err"]) && $_GET['err'] && $_GET['err']==-1){
                                echo "<p style='color: yellow;'>ERREUR</p>";
                            }
                        ?>
                    </select> </br>
                    <input type="submit" value="Supprimer"/>
                </form>

            </div>
        </div>

    </body>
</html>
