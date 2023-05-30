<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Document</title>

    <style>
        #container {
            max-width: 1200px;
            margin: 0 auto;
            display: flex;
            flex-direction: column;
            align-items: center;
            gap: 0.5em;
        }

        h1, h2, h3, h4 {
            display: flex;
            gap: 0.5em;
            align-items: center;
            margin-top: 20px;
            margin-bottom: 20px;
            justify-content: center;
        }

        h1, h2 {
            color: white;
            filter: drop-shadow(0 0 0.25em rgba(0, 0, 0, 0.8));
        }

        #content-container {
            padding: 0.5em;
            border: 0.1em solid rgb(200, 200, 200);
            background-color: rgba(255, 255, 255, 0.9);
            border-radius: 0.5em;
        }

        table {
            padding: 0.5em;
            border: 0.1em solid rgb(200, 200, 200);
            background-color: rgba(255, 255, 255, 0.9);
            border-radius: 0.5em;
            border-collapse: collapse;
        }

        th, td {
            text-align: center;
            padding: 0.3em 0.75em;
        }
    </style>

</head>
<body>
    <nav>
        <ul>
            <li><a href="../php/accueil.php">Accueil</a></li>
            <li><a href="../php/parcourir.php">Tout Parcourir</a></li>
            <li><a href="../php/notifications.php">Notifications</a></li>
            <li><a href="../php/panier.php">Panier</a></li>
            <li><a href="../php/compte.php">Votre Compte</a></li>
        </ul>
    </nav>
    <h1>Filtres</h1>
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
        </select></br>

        <input type="text" name="motcle" placeholder="Rechercher un article"></br>

        <label for="prixMax">Prix maximal :</label>
        <span id="prixMaxValue">0</span>
        <input type="range" name="prixMax" id="prixMax" min="0" max="1000" step="10">

        <!-- Bouton de validation -->
        <input type="submit" value="Appliquer les filtres" style="margin-top: 10px;">
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
                
                // Construction de la requête SQL
                $requete = "SELECT * FROM article WHERE 1=1";
                
                // Application des filtres
                if (!empty($_POST['categorie'])) {
                    $categorie = $_POST['categorie'];
                    $requete .= " AND categorie = '$categorie'";
                }
                
                if (!empty($_POST['date'])) {
                    $date = $_POST['date'];
                    $requete .= " ORDER BY date $date";
                }
                
                if (!empty($_POST['prix'])) {
                    $prix = $_POST['prix'];
                    $requete .= " ORDER BY date $prix";
                }

                if (!empty($_POST['motcle'])) {
                    $motcle = $_POST['motcle'];
                    $motcle = mysqli_real_escape_string($db_handle, $motcle);
                    $requete .= " AND titre LIKE %$motcle%";
                }

                if (!empty($_POST['prixMax'])) {
                    $prixMax = $_POST['prixMax'];
                    $requete .= " AND prix <= $prixMax";
                }

                if ($error) {
                    // S'il y a eu une erreur, on l'affiche
                    echo "<p>Error: $error</p>";
                } else {
                    // On envoie la requête à MySQL
                    $results = mysqli_query($db_handle, $requete);

                    // Regarder s'il y a des resultats
                    if (!$results || mysqli_num_rows($results) == 0) {
                        echo "<p>No player found.</p>";
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
                            echo "<td>" . $data['prix'] . "</td>";
                            echo "<td>" . $data['ID_vendeur'] . "</td>";
                            #echo "<td>" . "<img src='' height='120'>" . "</td>";
                            echo "<td></td>";
                            echo "<td>" . $data['categorie'] . "</td>";
                            echo "<td>" . $data['date'] . "</td>";
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