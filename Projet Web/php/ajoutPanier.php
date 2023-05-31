<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <link rel="stylesheet" href="../css/style-liste.css">
    <link rel="stylesheet" href="../css/style-general.css">
    <title>Panier</title>
</head>
<body>
    <?php
    include '../php/db.php' ;
    $data = recup_data();
    $stop = 0;

    while($auser = mysqli_fetch_assoc($data))
    {
        $id_user = $auser['ID_user'];
    }
    $bouton = -5;
    $bouton = isset($_GET["ajout"]) ? $_GET["ajout"] : "";

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
        $requete0 = "SELECT * FROM panier WHERE ID_article = '$bouton'";
        $results0 = mysqli_query($db_handle, $requete0);
        if(mysqli_num_rows($results0) != 0)
        {
            echo "<h1>Cet article se trouve deja dans votre panier</h1>";
            $stop = 7;
        }

        $requete = "INSERT INTO  panier (ID_panier, ID_article) VALUES ('$id_user','$bouton')" ;
                
        if ($error)
        {
            // S'il y a eu une erreur, on l'affiche
            echo "<p>Error: $error</p>";
        } 
        else 
        {
            if($stop != 7)
            {
                $results = mysqli_query($db_handle, $requete);
            }

        }
    }
    mysqli_close($db_handle); 

    echo '<script type="text/javascript">';
    echo 'setTimeout(function() {';
    echo '    window.location.href = "../php/parcourir.php";'; // Remplacez par l'URL de la page de destination
    echo '}, 600);'; // 3000 millisecondes = 3 secondes
    echo '</script>';
    ?>
    
</body>
</html>


