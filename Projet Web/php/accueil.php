<?php
include '../php/db.php' ;
$data = recup_data();
$vendeur = true;
$admin = false;
while($auser = mysqli_fetch_assoc($data))
{
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
    <link rel="stylesheet" href="../css/style-carrou.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.1/jquery.min.js"></script>
    <script type="text/javascript" src="../js/carrousselAccueil.js"></script>
    <title>Accueil</title>
</head>
<body>
    
    <h1>Bienvenue sur la page d'accueil</h1>
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

    <div id="carrousel">
        <img src="../photos/ak.jpeg" />
        <img src="../photos/v.jpeg" />
        <img src="../photos/livre.jpeg" />
    </div>

    <div id="controles">
        <button id="precedent">Precédent</button>
        <button id="defilement">Désactiver le défilement</button>
        <button id="suivant">Suivant</button>
    </div>

</body>
</html>