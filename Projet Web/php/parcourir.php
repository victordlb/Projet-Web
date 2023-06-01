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
    <title>Parcours</title>
    <link rel="stylesheet" href="../css/style-general.css">
    <link rel="stylesheet" href="../css/style-liste.css">
</head>
<body>
    <h1>Nos articles</h1>
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
    </br>
    <form method="POST" action="parcourir.php">
        <!-- Menu de choix des filtres -->
        <label for="categorie">Catégorie :</label>
        <select name="categorie" id="categorie">
            <option value="">Toutes les catégories</option>
            <option value="arme">Armes</option>
            <option value="vetement">Vétements</option>
            <option value="livre">Livres</option>
        </select>
        
        <label for="date">Date :</label>
        <select name="date" id="date">
            <option value="">Toutes les dates</option>
            <option value="DESC">Plus récent</option>
            <option value="ASC">Plus ancien</option>
        </select>

        <label for="prix">Prix :</label>
        <select name="prix" id="prix">
            <option value="">Tous les prix</option>
            <option value="DESC">Plus cher</option>
            <option value="ASC">Moins cher</option>
        </select>

        <input type="text" name="motcle" placeholder="Rechercher un article"></br>

        <label for="prixMax">Prix maximal :</label>
        <span id="prixMaxValue"></span>
        <input type="range" name="prixMax" id="prixMax" min="0" max="1000" step="10">

        <!-- Bouton de validation -->
        <input type="submit" value="Appliquer les filtres">
    </form>

    <div id="container">
        <h1>Liste des articles</h1>
        <div id="content-container">
            <?php

            $database = "piscine";
            $db_handle = mysqli_connect('db', 'root', 'mypassword', $database);
            $db_found = mysqli_select_db($db_handle, $database);


            // Si le BDD existe, faire le traitement
            if ($db_found) {
                $error = "";

                $categorieCondition = "";
                $dateCondition = "";
                $prixCondition = "";
                $motcleCondition = "";
                $prixMaxCondition = "";
                
                // Construction de la requête SQL
                $requete = "SELECT * FROM article WHERE 1=1";
                
                // Application des filtres
                if (!empty($_POST['categorie'])) {
                    $categorie = $_POST['categorie'];
                    $categorieCondition = " categorie = '$categorie'";
                }
                
                if (!empty($_POST['date'])) {
                    $date = $_POST['date'];
                    $dateCondition = " date $date";
                }
                
                if (!empty($_POST['prix'])) {
                    $prix = $_POST['prix'];
                    $prixCondition = " date $prix";
                }

                if (!empty($_POST['motcle'])) {
                    $motcle = $_POST['motcle'];
                    $motcle = mysqli_real_escape_string($db_handle, $motcle);
                    $motcleCondition = " titre LIKE %$motcle%";
                }

                if (!empty($_POST['prixMax'])) {
                    $prixMax = $_POST['prixMax'];
                    $prixMaxCondition = " prix <= $prixMax";
                }

                if (!empty($categorieCondition)) {
                    $requete .= " AND $categorieCondition";
                }
                
                if (!empty($motcleCondition)) {
                    $requete .= " AND $motcleCondition";
                }
                
                if (!empty($prixMaxCondition)) {
                    $requete .= " AND $prixMaxCondition";
                }

                if (!empty($dateCondition) AND !empty($prixCondition)) {
                    
                    $requete .= " ORDER BY";
                    if (!empty($prixCondition)) {
                        $requete .= " $prixCondition ,";
                    }
                    if (!empty($dateCondition)) {
                        $requete .= " $dateCondition";
                    }
                }
                if (!empty($dateCondition) OR !empty($prixCondition)) {
                    
                    $requete .= " ORDER BY";
                    if (!empty($prixCondition)) {
                        $requete .= " $prixCondition";
                    }
                    if (!empty($dateCondition)) {
                        $requete .= " $dateCondition";
                    }
                }

                if ($error) {
                    // S'il y a eu une erreur, on l'affiche
                    echo "<p>Error: $error</p>";
                } else {
                    // On envoie la requête à MySQL
                    $results = mysqli_query($db_handle, $requete);

                    // Regarder s'il y a des resultats
                    if (!$results || mysqli_num_rows($results) == 0) {
                        echo "<p>Aucun article en vente.</p>";
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
                            if(!$vendeur)
                            {
                                echo '<td><form method="get" action="ajoutPanier.php"><button type="submit" name="ajout" value="' . $data['ID_article'] . '">Ajouter au panier</button></td></form>';
                            }
                            echo "</tr>";
                        }
                        echo "</table>";
                    }
                }
            } else {
                echo "Database not found";
            } //end else

            // On ferme la connexion
            mysqli_close($db_handle); 
            ?>           
        </div>
    </div>

    <script>
        var prixMaxInput = document.getElementById("prixMax");
        var prixMaxValue = document.getElementById("prixMaxValue");

        prixMaxInput.addEventListener("input", function() {
            prixMaxValue.textContent = prixMaxInput.value;
        });
    </script>

</body>
</html>