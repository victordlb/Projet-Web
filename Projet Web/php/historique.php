<?php
include '../php/db.php' ;
$data = recup_data();
while($auser = mysqli_fetch_assoc($data))
{
    $id_user = $auser['ID_user'];
}

echo '<link rel="stylesheet" href="../css/style-general.css">';
echo '<link rel="stylesheet" href="../css/style-liste.css">';

echo "<a href='../php/compte.php'>quitter l'historique</a>";

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
        $requete = "SELECT * FROM article, histo WHERE histo.ID_histo = '$id_user' AND histo.ID_article = article.ID_article";
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
                echo "<h1>Historique vide.</h1>";
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
                    echo "<tr>";
                    echo "<td>" . $data['titre'] . "</td>";
                    echo "<td>" . $data['description'] . "</td>";
                    echo "<td>" . $data['prix'] . "$</td>";
                    echo "<td>" . $data['ID_vendeur'] . "</td>";
                    #echo "<td>" . "<img src='' height='120'>" . "</td>";
                    echo "<td></td>";
                    echo "<td>" . $data['categorie'] . "</td>";
                    echo "<td>" . $data['date'] . "</td>";
                    echo "</tr>";
                }
                echo "</table>";
                echo "</div>";
            }
        }
    }
    mysqli_close($db_handle); 

?>