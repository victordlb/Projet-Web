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
</body>
</html>