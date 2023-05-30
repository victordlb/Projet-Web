<?php
include '../php/db.php' ;
$data = recup_data();
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Document</title>
    <link rel="stylesheet" href="../css/style-compte.css">
</head>
<body>
    <h1>Votre Compte</h1>

    <nav>
        <ul>
            <li><a href="../php/accueil.php">Accueil</a></li>
            <li><a href="../php/parcourir.php">Tout Parcourir</a></li>
            <li><a href="../php/notifications.php">Notifications</a></li>
            <li><a href="../php/panier.php">Panier</a></li>
            <li><a href="../php/compte.php">Votre Compte</a></li>
        </ul>
    </nav>

    <?php
    $vendeur = false;
    while($auser = mysqli_fetch_assoc($data))
    {
        //Rajouter un echo pour la photo de profil
        echo "<p id='gras'>" . $auser['prenom'] . " " . $auser['nom'] . "</p>"; 
        echo "<p>Votre pseudo : " . $auser['pseudo'] . "</p>";
        echo "<p>Votre mail : " . $auser['mail'] . "</p>"; 
        echo "<p>Votre numero de telephone : " . $auser['tel'] . "</p>";
        echo "<p>Votre age : " . $auser['age'] . "ans</p>";
    

        if($auser['status'] == 'acheteur')
        {
            $database = "piscine";
            $db_handle = mysqli_connect('db', 'root', 'mypassword', $database);
            $db_found = mysqli_select_db($db_handle, $database);

            $id = $auser['ID_user'];

            $requete = "SELECT * FROM acheteur WHERE '$id' = ID_acheteur ";

            $result = mysqli_query($db_handle, $requete);
            mysqli_close($db_handle); 

            while($info =  mysqli_fetch_assoc($result))
            {
                echo "<p id='gras'>Vos informations de livraion</p>";
                echo "<p>Votre Adresse : " . $info['adresse'] . "</p>";
                echo "<p>Ville : " . $info['ville'] . "Code postale : " . $info['codep'] . "</p>";
                echo "<p>Pays : " . $info['pays'] . "</p>";
            }
        }
        if($auser['status'] == 'vendeur')
        {
            $vendeur = true;
        }
    }
    if($vendeur)
    {
        echo "<a href=../php/nvlarticle.php>Ajouter un nouvel article</a>";
    }

    ?>

</body>
</html>