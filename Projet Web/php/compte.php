<?php
include '../php/db.php' ;
$data = recup_data();
$vend = true;
while($auser = mysqli_fetch_assoc($data))
{
    if($auser['status'] == 'acheteur')
    {
        $vend = false;
    }
}
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Compte</title>
    <link rel="stylesheet" href="../css/style-compte.css">
    <link rel="stylesheet" href="../css/style-general.css">
    <link rel="stylesheet" href="../css/style-liste.css">
</head>
<body>
    <h1>Votre Compte</h1>
    <a href=../php/connexion.php>Retourner a la page de connexion</a>

    <nav class="navbar">
        <ul>
            <li><a href="../php/accueil.php">Accueil</a></li>
            <li><a href="../php/parcourir.php">Tout Parcourir</a></li>
            <li><a href="../php/notifications.php">Notifications</a></li>
            <?php
                if($vend)
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
</br>


    <?php
    $vendeur = false;
    $data = recup_data();
    while($auser = mysqli_fetch_assoc($data))
    {
        echo "<div id='container'>";
        echo "<table>";
        echo "<caption id='gras'>Informations Personnelles</caption>"; 
        echo "<tr>";
        //Rajouter un echo pour la photo de profil
        echo "<td>Prenom et Nom : </td>";
        echo "<td>" . $auser['prenom'] . " " . $auser['nom'] . "</td>"; 
        echo "</tr>";
        echo "<tr>";
        echo "<td>Pseudo : </td>";
        echo "<td>" . $auser['pseudo'] . "</td>";
        echo "</tr>";
        echo "<tr>";
        echo "<td>Mail : </td>";
        echo "<td>" . $auser['mail'] . "</td>"; 
        echo "</tr>";
        echo "<tr>";
        echo "<td>Telephone : </td>";
        echo "<td>" . $auser['tel'] . "</td>";
        echo "</tr>";
        echo "<tr>";
        echo "<td>Age : </td>";
        echo "<td>" . $auser['age'] . "ans</td>";
        echo "</tr>";
        echo "</table>";
        echo "</div>";
    

        if($auser['status'] == 'acheteur')
        {
            $database = "piscine";
            $db_handle = mysqli_connect('db', 'root', 'mypassword', $database);
            $db_found = mysqli_select_db($db_handle, $database);

            $id = $auser['ID_user'];

            $requete = "SELECT * FROM acheteur WHERE '$id' = ID_acheteur ";

            $result = mysqli_query($db_handle, $requete);
            mysqli_close($db_handle); 
            echo "</br>";

            while($info =  mysqli_fetch_assoc($result))
            {
                echo "<div id='container'>";
                echo "<table>";
                echo "<caption id='gras'>Vos informations de livraison</caption>"; 
                echo "<tr>";
                echo "<td>Votre Adresse : </td>";
                echo "<td>" . $info['adresse'] . "</td>";
                echo "</tr>";
                echo "<tr>";
                echo "<td>Ville et Code Postal : </td>";
                echo "<td>" . $info['ville'] . "  " . $info['codep'] . "</td>";
                echo "</tr>";
                echo "<tr>";
                echo "<td>Pays : </td>";
                echo "<td>" . $info['pays'] . "</td>";
            }
            echo "</table>";
            echo "</div>";
        }
        if($auser['status'] == 'vendeur')
        {
            $vendeur = true;
        }
    }
    if($vendeur)
    {
        echo "<a href='../php/historique.php'>Voir votre historique de vente</a>";
    }
    else
    {
        echo "<a href='../php/historique.php'>Voir votre historique d'achat</a>";
    }

    ?>

</body>
</html>