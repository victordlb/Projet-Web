<?php
    if (isset($_POST['accepter'])) {
        // Le vendeur a accepté le prix
        // Redirection vers la page de paiement avec le nouveau prix
        #header("Location: ajoutPanier.php?nego_id=" . $_POST['nego_id']);
        $nego_id = $_POST['nego_id'];
        header("Location: paiement-direct.php?nego_id=" . $nego_id);
    } elseif (isset($_POST['decliner'])) {
        $nego_id = $_POST['nego_id'];

        // Effectuer la mise à jour dans la base de données
        $database = "piscine";
        $db_handle = mysqli_connect('db', 'root', 'mypassword', $database);
        $db_found = mysqli_select_db($db_handle, $database);

        if (!$db_found) {
            echo "Connexion à la base de données échouée";
        }else{
            // Mettre à jour la valeur du champ 'tour' à 'acheteur' pour la négociation spécifiée
            $requete = "UPDATE nego SET tour = 'acheteur' WHERE ID_nego = '$nego_id'";
            $result = mysqli_query($db_handle, $requete);

            if (!$result) {
                echo "Erreur lors de la mise à jour du champ 'tour'";
            }

        }
        mysqli_close($db_handle);
    }
    echo '<script type="text/javascript">';
    echo 'setTimeout(function() {';
    echo '    window.location.href = "../php/vosArticles.php";'; // Remplacez par l'URL de la page de destination
    echo '}, 0);'; // 3000 millisecondes = 3 secondes
    echo '</script>';

?>