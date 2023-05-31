<?php
$bouton = -5;
$bouton = isset($_GET["supp"]) ? $_GET["supp"] : "";

echo "<p>" . $bouton . "</p>";

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
        $requete = "DELETE FROM article WHERE ID_article = '$bouton'" ;
            
        if ($error)
        {
            // S'il y a eu une erreur, on l'affiche
            echo "<p>Error: $error</p>";
        } 
        else 
        {
            $results = mysqli_query($db_handle, $requete);
        }
    }
    mysqli_close($db_handle); 

    echo '<script type="text/javascript">';
        echo 'setTimeout(function() {';
        echo '    window.location.href = "../php/vosArticles.php";'; // Remplacez par l'URL de la page de destination
        echo '}, 0);'; // 3000 millisecondes = 3 secondes
        echo '</script>';

?>