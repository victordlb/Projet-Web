<?php
include '../php/db.php' ;
$data = recup_data();
while($auser = mysqli_fetch_assoc($data))
{
    $id_user = $auser['ID_user'];
}

echo '<link rel="stylesheet" href="../css/style-general.css">';
echo "<h1>Paiement en cours ...</h1>";

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
        $requete = "DELETE FROM panier WHERE ID_panier = '$id_user'" ;
        $requete2 = "SELECT * FROM panier WHERE ID_panier = '$id_user'";
        $results2 = mysqli_query($db_handle, $requete2);
        while($data = mysqli_fetch_assoc($results2))
        {
            $requete3 = "INSERT INTO histo (ID_histo, ID_article) VALUES ('$id_user', '" . $data['ID_article'] . "')";
            $results3 = mysqli_query($db_handle, $requete3);
        }
            
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
echo '    window.location.href = "../php/panier.php";'; // Remplacez par l'URL de la page de destination
echo '}, 1000);'; // 3000 millisecondes = 3 secondes
echo '</script>';

?>