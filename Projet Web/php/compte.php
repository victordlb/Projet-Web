<?php
include '../php/db.php' ;
$data = recup_data();
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Document</title>
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
    while($auser = mysqli_fetch_assoc($data))
    {
        echo $auser['pseudo'];
    }
    ?>

</body>
</html>