<?php
include '../php/db.php' ;
$data = recup_data();
$date1 = date('d/m/Y');
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <link rel="stylesheet" href="../css/style-general.css">
    <title>Ajout</title>
</head>
<body>
    <h1>Ajout d'article</h1>

    <div>
        <div>
            <form action="" method="post">
                <table>
                <tr>
                        <td>Titre</td>
                        <td><input type="text" name="titre" placeholder="Saisir un titre" required></td>
                    </tr>
                    <tr>
                        <td>Prix</td>
                        <td><input type="number" name="prix" placeholder="Saisir votre prix" required></td>
                    </tr>
                    <tr>
                        <td>Description</td>
                        <td><input type="text" name="description" placeholder="Ajouter une description"></td>
                    </tr>
                    <tr>
                        <td>Photo</td>
                        <td><input type="file" name="photo" accept="image/*"></td>
                    </tr>
                    <tr>
                        <td>Categorie</td>
                        <td>
                            <select id="options" name="options" required onchange="ajout_attributs()">
                                <option value="" disabled selected hidden>Sélectionnez une option</option>
                                <option value="livre">Livres</option>
                                <option value="vetement">Vetements</option>
                                <option value="arme">Armes</option>
                            </select>
                        </td>
                    </tr>
                    <tr>
                        <td><input type="submit" name="Ajout" value="Valider"></td>
                    </tr>
                </table>
            </form>
        </div>
    </div>

    <?php
    if(isset($_POST['Ajout']))
    {
        $titre = isset($_POST["titre"]) ? $_POST["titre"] : "";
        $prix = isset($_POST["prix"]) ? $_POST["prix"] : "";
        $description = isset($_POST["description"]) ? $_POST["description"] : "";
        $date = date('Y-m-d');
        $photo = isset($_POST["photo"]) ? $_POST["photo"] : "";
        $categorie = isset($_POST["options"]) ? $_POST["options"] : "";

        while($auser = mysqli_fetch_assoc($data))
        {
            $id_vendeur = $auser['ID_user'];
        }
        ajout_article($id_vendeur, $titre, $prix, $description, $date, $photo, $categorie);
    }

    function ajout_article($id_vendeur, $titre, $prix, $description, $date, $photo, $categorie)
    {
        $database = "piscine";
        $db_handle = mysqli_connect('db', 'root', 'mypassword', $database);
        $db_found = mysqli_select_db($db_handle, $database);
        if(!$db_handle)
        {
            echo "Connexion db echoue";
        }
        else
        {
            $error = "";
            $requete = "INSERT INTO article (ID_vendeur, titre, prix, description, date, photo, categorie) VALUES ('$id_vendeur','$titre', '$prix', '$description', '$date', '$photo', '$categorie')";
            if ($error)
            {
                // S'il y a eu une erreur, on l'affiche
                echo "<p>Error: $error</p>";
            } 
            else 
            {
                // On envoie la requête à MySQL
                $results = mysqli_query($db_handle, $requete);
                echo "L'article a ete ajoute";
            }
        
        mysqli_close($db_handle); 
        
        }
    }
    ?>

    <a href="../php/vosArticles.php">Quitter l'ajout d'article</a>
    
</body>
</html>
