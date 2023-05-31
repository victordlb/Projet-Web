<?php
include '../php/db.php' ;
$data = recup_data();
$vendeur = true;
while($auser = mysqli_fetch_assoc($data))
{
    if($auser['status'] == 'acheteur')
    {
        $vendeur = false;
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <link rel="stylesheet" href="../css/style-general.css">
    <link rel="stylesheet" href="../css/style-liste.css">
    <title>Article</title>
</head>
<body>
    <h1>Vos Articles</h1>
    <a href=../php/connexion.php>Retourner a la page de connexion</a>

    <nav class="navbar">
        <ul>
            <li><a href="../php/accueil.php">Accueil</a></li>
            <li><a href="../php/parcourir.php">Tout Parcourir</a></li>
            <li><a href="../php/notifications.php">Notifications</a></li>
            <?php
                if($vendeur)
                {
                    echo "<li><a href='../php/vosArticles.php'>Vos Articles</a></li>";
                }
                else
                {
                    echo "<li><a href='../php/panier.php'>Panier</a></li>";
                }
            ?>
            <li><a href="../php/compte.php">Votre Compte</a></li>
        </ul>
    </nav>
    <div id="container">
        <h1>Vos articles mis en ventes</h1>
        <?php
            $data = recup_data();
            while($auser = mysqli_fetch_assoc($data))
            {
                $ID_user = $auser['ID_user'];
            }
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
                $requete = "SELECT * FROM article WHERE ID_vendeur = $ID_user " ;
                    
                if ($error)
                {
                    // S'il y a eu une erreur, on l'affiche
                    echo "<p>Error: $error</p>";
                } 
                else 
                {
                    $results = mysqli_query($db_handle, $requete);
                    echo '
                            <table>
                                <tr>
                                    <th>Titre</th>
                                    <th>Description</th>
                                    <th>Prix</th>
                                    <th>Vendeur</th>
                                    <th>Photo</th>
                                    <th>Catégorie</th>
                                    <th>Date</th>
                                </tr>
                            ';
                    //afficher le resultat
                    $compteur = 0;
                    $bouton = -5;
                    while ($aff = mysqli_fetch_assoc($results)) 
                    {
                        echo "<tr>";
                        echo "<td>" . $aff['titre'] . "</td>";
                        echo "<td>" . $aff['description'] . "</td>";
                        echo "<td>" . $aff['prix'] . "</td>";
                        echo "<td>" . $aff['ID_vendeur'] . "</td>";
                        #echo "<td>" . "<img src='' height='120'>" . "</td>";
                        echo "<td></td>";
                        echo "<td>" . $aff['categorie'] . "</td>";
                        echo "<td>" . $aff['date'] . "</td>";
                        echo '<td><form method="get" action="suppression.php"><button type="submit" name="supp" value="' . $aff['ID_article'] . '">Supprimer</button></td></form>';
                        echo "</tr>";
                    }
                    echo "</table>";


                }

            }
            mysqli_close($db_handle); 

        ?>

    </div>

    <a href=../php/nvlarticle.php>Ajouter un nouvel article</a>
</body>
</html>