<?php
include '../php/db.php' ;
$data = recup_data();
$vendeur = true;
$admin = false;
while($auser = mysqli_fetch_assoc($data))
{
    if($auser['status'] == 'acheteur')
    {
        $vendeur = false;
    }
    elseif($auser['status'] == 'admin'){
        $admin = true;
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
    <h1>Les vendeurs</h1>
    <a href=../php/connexion.php>Retourner a la page de connexion</a>

    <nav class="navbar">
        <ul>
            <li><a href="../php/accueil.php">Accueil</a></li>
            <?php
                if($admin){
                    echo "<li><a href='../php/liste_vendeur.php'>Vendeurs</a></li>";
                }
                else{
                    echo "<li><a href='../php/parcourir.php'>Tout Parcourir</a></li>";
                }
            ?>
            <li><a href="../php/notifications.php">Notifications</a></li>
            <?php
                if($vendeur OR $admin)
                {
                    echo "<li><a href='../php/vosArticles.php'>Vos Articles</a></li>";
                }
                elseif(!$vendeur AND !$admin)
                {
                    echo "<li><a href='../php/panier.php'>Panier</a></li>";
                }
            ?>
            <li><a href="../php/compte.php">Votre Compte</a></li>
        </ul>
    </nav>
    <div id="container">
        <h1>Les vendeurs du site</h1>
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
                $requete = "SELECT * FROM user WHERE ID_user IN(SELECT * FROM vendeur)" ;
                    
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
                                    <th>Nom</th>
                                    <th>Paul</th>
                                    <th>Mail</th>
                                    <th>Avatar</th>
                                    <th>Pseudo</th>
                                    <th>Age</th>
                                    <th>Status</th>
                                    <th>Action</th>
                                </tr>
                            ';
                    //afficher le resultat
                    $compteur = 0;
                    $bouton = -5;
                    while ($aff = mysqli_fetch_assoc($results)) 
                    {
                        echo "<tr>";
                        echo "<td>" . $aff['nom'] . "</td>";
                        echo "<td>" . $aff['prenom'] . "</td>";
                        echo "<td>" . $aff['mail'] . "</td>";
                        #echo "<td>" . "<img src='' height='120'>" . "</td>";
                        echo "<td></td>";
                        echo "<td>" . $aff['pseudo'] . "</td>";
                        echo "<td>" . $aff['age'] . "</td>";
                        echo "<td>" . $aff['status'] . "</td>";
                        echo '<td><form method="get" action="suppressionVendeur.php"><button type="submit" name="supp" value="' . $aff['ID_user'] . '">Supprimer</button></td></form>';
                        echo "</tr>";
                    }
                    echo "</table>";


                }

            }
            mysqli_close($db_handle); 

        ?>

    </div>

    <a class="nego" href="../php/negociation.php">Voir les négociations en cours</a>
    <a href=../php/nvlarticle.php>Ajouter un nouvel article</a>
</body>
</html>