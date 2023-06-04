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
    elseif(isset($_GET['nego_id'])){
        $nego_id = $_GET['nego_id'];
        $error = "";
        $requete = "DELETE FROM nego WHERE ID_nego = '$nego_id'" ;
        $requete2 = "SELECT * FROM article WHERE ID_article IN (SELECT ID_article FROM nego WHERE ID_nego = $nego_id)";
        $requete4 = "DELETE FROM article WHERE ID_article IN (SELECT ID_article FROM nego WHERE ID_nego = $nego_id);";
        $results2 = mysqli_query($db_handle, $requete2);
        while($data = mysqli_fetch_assoc($results2))
        {
            $requete3 = "INSERT INTO histo (ID_user, titre, description, prix, ID_vendeur, photo, categorie, date) VALUES ('$id_user', '" . $data['titre'] . "', '" . $data['description'] . "', '" . $data['prix'] . "', '" . $data['ID_vendeur'] . "', '" . $data['photo'] . "', '" . $data['categorie'] . "', '" . $data['date'] . "')";
            $results3 = mysqli_query($db_handle, $requete3);
        }
            
        if ($error)
        {
            // S'il y a eu une erreur, on l'affiche
            echo "<p>Error: $error</p>";
        } 
        else 
        {
            $results4 = mysqli_query($db_handle, $requete4);
            $results = mysqli_query($db_handle, $requete);
        }
    }
    else
    {
        $error = "";
        $requete = "DELETE FROM panier WHERE ID_panier = '$id_user'" ;
        $requete2 = "SELECT * FROM article WHERE ID_article IN (SELECT ID_article FROM panier WHERE ID_panier = $id_user)";
        $requete4 = "DELETE FROM article WHERE ID_article IN (SELECT ID_article FROM panier WHERE ID_panier = $id_user);";
        $results2 = mysqli_query($db_handle, $requete2);
        while($data = mysqli_fetch_assoc($results2))
        {
            $requete3 = "INSERT INTO histo (ID_user, titre, description, prix, ID_vendeur, photo, categorie, date) VALUES ('$id_user', '" . $data['titre'] . "', '" . $data['description'] . "', '" . $data['prix'] . "', '" . $data['ID_vendeur'] . "', '" . $data['photo'] . "', '" . $data['categorie'] . "', '" . $data['date'] . "')";
            $results3 = mysqli_query($db_handle, $requete3);
        }
            
        if ($error)
        {
            // S'il y a eu une erreur, on l'affiche
            echo "<p>Error: $error</p>";
        } 
        else 
        {
            $results4 = mysqli_query($db_handle, $requete4);
            $results = mysqli_query($db_handle, $requete);
            $requete5 = "SELECT * FROM user WHERE ID_user = $id_user";
            $results5 = mysqli_query($db_handle, $requete5);
            $data5 = mysqli_fetch_assoc($results5);
            $personne = $data5['mail'];
            $article = $data['titre'];
            $subject = "Envoie de '$article'";
            $message = "Votre article est envoyé";
            // Envoyer l'e-mail
            $mailSent = mail($personne, $subject, $message);

            // Vérifier si l'e-mail a été envoyé avec succès
            if ($mailSent) {
                echo "L'e-mail a été envoyé avec succès.";
            } else {
                echo "Une erreur s'est produite lors de l'envoi de l'e-mail.";
            }
        }
    }
    mysqli_close($db_handle); 


    echo '<script type="text/javascript">';
    echo 'setTimeout(function() {';
    echo '    window.location.href = "../php/panier.php";'; // Remplacez par l'URL de la page de destination
    echo '}, 1000);'; // 3000 millisecondes = 3 secondes
    echo '</script>';

?>