<?php
include '../php/db.php' ;
$data = recup_data();
while($auser = mysqli_fetch_assoc($data))
{
    $id_user = $auser['ID_user'];
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <link rel="stylesheet" href="../css/style-general.css">
    <link rel="stylesheet" href="../css/style-liste.css">
    <title>Paiement</title>
</head>
<body>
    <h1>Paiement en ligne</h1>

    <div id="container">
        <h2>Liste des articles de votre commande</h2>
        <a href="../php/panier.php">Retourner a votre panier</a>
        <?php
        $prix = 0;

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
            $requete = "SELECT * FROM panier,article WHERE $id_user = panier.ID_panier AND article.ID_article = panier.ID_article" ;
                    
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
                } 
                else 
                {
                    // On affiche les joueurs
                    echo '
                        <table>
                            <tr>
                                <th>Titre</th>
                                <th>Prix</th>
                                <th>Photo</th>
                            </tr>
                    ';
                    //afficher le resultat
                    $compteur = 0;
                    while ($data = mysqli_fetch_assoc($results)) {
                        echo "<tr>";
                        echo "<td>" . $data['titre'] . "</td>";
                        echo "<td>" . $data['prix'] . "$</td>";
                        $prix = $prix + $data['prix'];
                        #echo "<td>" . "<img src='' height='120'>" . "</td>";
                        echo "<td></td>";;
                        echo "</tr>";
                    }
                    echo "</table>";
                }
            }
            echo "<p>Prix total : " . $prix . "$</p>";

            $requete2 = "SELECT * FROM infop WHERE '$id_user' = ID_info ";
            $result = mysqli_query($db_handle, $requete2);

            while($info =  mysqli_fetch_assoc($result))
            {
                echo "<div class='container'>";
                echo "<table>";
                echo "<caption id='gras'>Vos informations de paiement</caption>"; 
                echo "<tr>";
                echo "<td>Numero : </td>";
                echo "<td>" . $info['num'] . "</td>";
                echo "</tr>";
                echo "<tr>";
                echo "<td>Nom du titulaire : </td>";
                echo "<td>" . $info['nom'] . "</td>";
                echo "</tr>";
                echo "<tr>";
                echo "<td>Date d'expiration : </td>";
                echo "<td>" . $info['expire'] . "</td>";
            }
            echo "</table>";

            mysqli_close($db_handle); 

        
        }

        ?>
    </div>
    <a href="../php/paiement-direct.php">Payer</a>
    
</body>
</html>