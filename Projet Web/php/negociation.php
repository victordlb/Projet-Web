<?php
    // Inclure le fichier de connexion à la base de données
    include '../php/db.php';
    $donne = recup_data();

    $vendeur = true;
    while($auser = mysqli_fetch_assoc($donne))
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
    <title>Negociation</title>
    <link rel="stylesheet" href="../css/style-general.css">
    <link rel="stylesheet" href="../css/style-liste.css">
</head>
<body>
    <div id="container">
        <h1>Liste des Négociations</h1>
        <div id="content-container">
            <?php
            echo "<a href='../php/panier.php'>quitter les nego</a>";
            $data = recup_data();
            $id_user = mysqli_fetch_assoc($data);

            $database = "piscine";
            $db_handle = mysqli_connect('db', 'root', 'mypassword', $database);
            $db_found = mysqli_select_db($db_handle, $database);

            // Si la BDD existe, effectuer le traitement
            if ($db_found) {
                $error = "";
                if($vendeur) {
                    $requete = "SELECT * FROM nego WHERE ID_article IN (SELECT ID_article FROM article WHERE ID_vendeur = '{$id_user['ID_user']}')";
                } else {
                    $requete = "SELECT * FROM nego WHERE ID_acheteur = '{$id_user['ID_user']}'";
                }
                if ($error) {
                    // S'il y a eu une erreur, on l'affiche
                    echo "<p>Error: $error</p>";
                } else {
                    // On envoie la requête à MySQL
                    $results = mysqli_query($db_handle, $requete);

                    // Regarder s'il y a des résultats
                    if (!$results || mysqli_num_rows($results) == 0) {
                        echo "<p>No nego found.</p>";
                    } else {
                        // On affiche les joueurs
                        echo '
                            
                                <table>
                                    <tr>
                                        <th>Titre</th>
                                        <th>Prix</th>
                                        <th>Compteur</th>
                                        <th>En attente de</th>
                                        <th>Action</th>
                                    </tr>
                        ';
                        // Afficher les résultats
                        while ($data = mysqli_fetch_assoc($results)) {
                            $requete2 = "SELECT * FROM article WHERE ID_article = " . $data['ID_article'];
                            $results2 = mysqli_query($db_handle, $requete2);
                            $data2 = mysqli_fetch_assoc($results2);
                            echo "<tr>";
                            echo "<td>" . $data2['titre'] . "</td>";
                            echo "<td>" . $data['newprice'] . "</td>";
                            echo "<td>" . $data['compteur'] . "</td>";
                            echo "<td>" . $data['tour'] . "</td>";
                            if(!$vendeur && $data['tour'] == 'acheteur'){
                                echo '<td>
                                    <form action="modifier_prix.php" method="post">
                                        <input type="number" step="0.01" name="prix" id="prix">
                                        <input type="hidden" name="nego_id" value="' . $data['ID_nego'] . '">
                                        <input type="hidden" name="compteur" value="' . $data['compteur'] . '">
                                        <input type="submit" value="Modifier">
                                    </form>
                                </td>';
                            }
                            if($vendeur && $data['tour'] == 'vendeur'){
                                echo '<td>
                                    <form action="process_nego.php" method="post">
                                        <input type="hidden" name="nego_id" value="' . $data['ID_nego'] . '">
                                        <input type="hidden" name="compteur" value="' . $data['compteur'] . '">
                                        <input type="submit" name="accepter" value="Accepter">
                                        <input type="submit" name="decliner" value="Décliner">
                                    </form>
                                </td>';
                            }
                            if($data['compteur'] == 5){
                                echo "<td>Désacord</td>";
                            }

                            echo "</tr>";
                        }
                        echo "</table>";
                    }
                }
            } else {
                echo "Database not found";
            } // End else

            // On ferme la connexion
            mysqli_close($db_handle);
            ?>           
        </div>
    </div>
</body>
</html>
