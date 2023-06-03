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
    <title>Notifications</title>
    <link rel="stylesheet" href="../css/style-general.css">
</head>
<body>
    <h1>Vos Notifications</h1>
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
    <?php

        $database = "piscine";
        $db_handle = mysqli_connect('db', 'root', 'mypassword', $database);
        $db_found = mysqli_select_db($db_handle, $database);

        if(!$db_handle)
        {
                echo "Connexion db echoue";
        }
        elseif($vendeur)
        {
            $error = "";
            $requete = "SELECT * FROM notif";
            if ($error)
            {
                // S'il y a eu une erreur, on l'affiche
                echo "<p>Error: $error</p>";
            } 
            else 
            {
                echo "<div id='container'>";
                $results = mysqli_query($db_handle, $requete);
                if (!$results || mysqli_num_rows($results) == 0) {
                    echo "<h1>Pas de Notifications</h1>";
                } else {
                    echo '
                        <table>
                            <tr>
                                <th>Type</th>
                                <th>Message</th>
                                <th>Date</th>
                                <th>Acheteur</th>
                            </tr>
                    ';
                    //afficher le resultat
                    while ($data = mysqli_fetch_assoc($results)) {
                        $requete2 = "SELECT * FROM user WHERE ID_user =" . $data['ID_user'];
                        $results2 = mysqli_query($db_handle, $requete2);
                        $data2 = mysqli_fetch_assoc($results2);
                        echo "<tr>";
                        echo "<td>" . $data['type'] . "</td>";
                        echo "<td>" . $data['message'] . "</td>";
                        echo "<td>" . $data['date'] . "$</td>";
                        echo "<td>" . $data2['pseudo'] . "</td>";
                    }
                    echo "</table>";
                    echo "</div>";
                }
            }
            mysqli_close($db_handle);
        }elseif(!$vendeur){
            echo "<li><a href='../php/nvlnotif.php'>Ajouter une notification</a></li>";
        }

    ?>

</body>
</html>