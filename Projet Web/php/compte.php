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
        echo "<td>Avatar : </td>";
        echo "<td>" . "<img src='". $auser['avatar']. "' height='30'; width='30'></td>";
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
    <footer style="background-color: #585858;padding: 10px;bottom: 0;width: 100%;height: 100px;display: flex;align-items: center;margin-bottom: auto;"> 
        <p>Contactez-nous : agorafrancia@gmail.com
        <br>Téléphone : 06.12.13.14.15</p>
        <div style="margin-left: auto;">
            <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d2625.3726222018067!2d2.2885375999999997!3d48.8511045!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x47e6701b486bb253%3A0x61e9cc6979f93fae!2s10%20Rue%20Sextius%20Michel%2C%2075015%20Paris!5e0!3m2!1sfr!2sfr!4v1685376633191!5m2!1sfr!2sfr" style="width: 300px; height: 110px; border:0;" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>
        </div>
    </footer>

</body>
</html>