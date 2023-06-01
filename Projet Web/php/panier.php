<?php
include '../php/db.php' ;
$data = recup_data();
$vendeur = true;
while($auser = mysqli_fetch_assoc($data))
{
    $id_user = $auser['ID_user'];
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
    <title>Panier</title>
    <link rel="stylesheet" href="../css/style-general.css">
    <link rel="stylesheet" href="../css/style-liste.css">
</head>
<body>
    <h1>Votre Panier</h1>
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
        <h1>Article de votre panier</h1>
        <?php
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
            $requete = "SELECT * FROM article,panier WHERE $id_user = panier.ID_panier AND article.ID_article = panier.ID_article" ;
                    
            if ($error)
            {
                // S'il y a eu une erreur, on l'affiche
                echo "<p>Error: $error</p>";
            } 
            else 
            {
                $results = mysqli_query($db_handle, $requete);
                // Regarder s'il y a des resultats
                if (!$results || mysqli_num_rows($results) == 0) {
                    echo "<p>Panier vide.</p>";
                } else {
                    // On affiche les joueurs
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
                    while ($data = mysqli_fetch_assoc($results)) {
                        if($data['type'] == 'direct'){
                            echo "<tr>";
                            echo "<td>" . $data['titre'] . "</td>";
                            echo "<td>" . $data['description'] . "</td>";
                            echo "<td>" . $data['prix'] . "$</td>";
                            echo "<td>" . $data['ID_vendeur'] . "</td>";
                            #echo "<td>" . "<img src='' height='120'>" . "</td>";
                            echo "<td></td>";
                            echo "<td>" . $data['categorie'] . "</td>";
                            echo "<td>" . $data['date'] . "</td>";
                            echo '<td><form method="get" action="supprimer-panier.php"><button type="submit" name="supp" value="' . $data['ID_article'] . '">Supprimer</button></td></form>';
                            echo "</tr>";
                        }
                    }
                    echo "</table>";
                }
            }
        }
        mysqli_close($db_handle); 

        ?>
    </div>
    <a class="nego" href="../php/negociation.php">Voir les négociations en cours</a>
    <a class="paiement" href="../php/paiement-panier.php">Valider votre panier et payer</a>
</body>
</html>