<?php
// Inclure le fichier de connexion à la base de données
include '../php/db.php';

// Récupérer les valeurs envoyées depuis le formulaire
$prix = isset($_POST['prix']) ? $_POST['prix'] : "";
$negoId = isset($_POST['nego_id']) ? $_POST['nego_id'] : "";
$compteur = isset($_POST['compteur']) ? $_POST['compteur'] : "";
$compteur += 1;

// Vérifier si les valeurs sont présentes
if (!empty($prix) && !empty($negoId)) {
    // Effectuer la requête de mise à jour dans la base de données
    $database = "piscine";
    $db_handle = mysqli_connect('db', 'root', 'mypassword', $database);
    $db_found = mysqli_select_db($db_handle, $database);

    if ($db_found) {
        $requete = "UPDATE nego SET newprice = '$prix', tour = 'vendeur', compteur = '$compteur' WHERE ID_nego = '$negoId'";
        $results = mysqli_query($db_handle, $requete);

        if ($results) {
            echo "Le prix a été modifié avec succès.";
        } else {
            echo "Une erreur s'est produite lors de la modification du prix.";
        }
    } else {
        echo "Database not found";
    }

    // Fermer la connexion à la base de données
    mysqli_close($db_handle);
} else {
    echo "Les valeurs du formulaire sont manquantes.";
}

echo '<script type="text/javascript">';
echo 'setTimeout(function() {';
echo '    window.location.href = "../php/negociation.php";'; // Remplacez par l'URL de la page de destination
echo '}, 1000);'; // 3000 millisecondes = 3 secondes
echo '</script>';
?>
