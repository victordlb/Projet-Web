<?php
include '../php/db.php' ;
$data = recup_data();
$vendeur = true;
$admin = false;
while($auser = mysqli_fetch_assoc($data))
{
    $id_user = $auser['ID_user'];
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
                                    <th>Type</th>
                                </tr>
                        ';
                        //afficher le resultat
                        while ($data = mysqli_fetch_assoc($results)) {
                            $requete2 = "SELECT * FROM user WHERE ID_user =" . $data['ID_vendeur'];
                            $results2 = mysqli_query($db_handle, $requete2);
                            $data2 = mysqli_fetch_assoc($results2);
                            echo "<tr>";
                            echo "<td>" . $data['titre'] . "</td>";
                            echo "<td>" . $data['description'] . "</td>";
                            echo "<td>" . $data['prix'] . "$</td>";
                            echo "<td>" . $data2['pseudo'] . "</td>";
                            #echo "<td>" . "<img src='' height='120'>" . "</td>";
                            echo "<td></td>";
                            echo "<td>" . $data['categorie'] . "</td>";
                            echo "<td>" . $data['date'] . "</td>";
                            echo "<td>" . $data['type'] . "</td>";
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

    <footer style="background-color: #585858;padding: 10px;bottom: 0;width: 100%;height: 100px;display: flex;align-items: center;margin-bottom: auto;"> 
        <p>Contactez-nous : agorafrancia@gmail.com
        <br>Téléphone : 06.12.13.14.15</p>
        <div style="margin-left: auto;">
            <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d2625.3726222018067!2d2.2885375999999997!3d48.8511045!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x47e6701b486bb253%3A0x61e9cc6979f93fae!2s10%20Rue%20Sextius%20Michel%2C%2075015%20Paris!5e0!3m2!1sfr!2sfr!4v1685376633191!5m2!1sfr!2sfr" style="width: 300px; height: 110px; border:0;" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>
        </div>
    </footer>

</body>
</html>