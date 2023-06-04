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
                                    <th>Avatar</th>
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
                        echo "<td>" . $aff['pseudo'] . "</td>";
                        echo "<td>" . $aff['age'] . "</td>";
                        echo "<td>" . "<img src='". $auser['avatar']. "' height='30'; width='30'></td>";
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

    <a href=../php/nvlarticle.php>Ajouter un nouveaux vendeur</a>
    <footer style="background-color: #585858;padding: 10px;bottom: 0;width: 100%;height: 100px;display: flex;align-items: center;"> 
        <p>Contactez-nous : agorafrancia@gmail.com
        <br>Téléphone : 06.12.13.14.15</p>
        <div style="margin-left: auto;">
            <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d2625.3726222018067!2d2.2885375999999997!3d48.8511045!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x47e6701b486bb253%3A0x61e9cc6979f93fae!2s10%20Rue%20Sextius%20Michel%2C%2075015%20Paris!5e0!3m2!1sfr!2sfr!4v1685376633191!5m2!1sfr!2sfr" style="width: 300px; height: 110px; border:0;" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>
        </div>
    </footer>
</body>
</html>