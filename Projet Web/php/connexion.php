<?php
include_once 'log.php' ;
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <script src="../js/log.js"></script>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <title>Accueil</title>
</head>
<body>
    <?php
    $verif = false;
    ?>
    <h1>Bienvenue sur mon site web</h1>

    <div id="content">
        <h2>Connexion</h2>
        <div id="connexion">
            <form method="post" action ="" >
                <table>
                    <tr>
                        <td>Nom d'utilisateur ou adresse mail</td>
                        <td><input type="text" name="id"></input>
                    </tr>
                    <tr>
                        <td>Mot de passe</td>
                        <td><input type="password" id="mot_de_passe" name="password"></input>
                        <td><input type="button" value="👁" onclick="afficherMotDePasse()"></td>
                    </tr>
                    <tr>
                        <td><input type="submit" name="connection" value="Se connecter"></td>
                        <td><input type="reset" value="Réinitialiser"></td>
                        <td><a href="inscription.php">S'inscrire</td>
                    </tr>
                </table>

            </form>
        </div>

    </div>

    <?php

    if(isset($_POST['connection']))
    {
        $id = isset($_POST["id"]) ? $_POST["id"] : "";
        $password = isset($_POST["password"]) ? $_POST["password"] : "";
        if(empty($id) || empty($password))
        {
            echo "<p>Vous n'avez pas saisi tous les attributs du champ</p>";
            $verif = false;
        }
        else
        {
            if(validationinformation($id, $password))
            {
               echo "Connexion reussi";
               $verif = true;
            }
            else
            {
                echo "Information de connexion incorrecte";
                $verif = false;
            }
        }
        
    }

    if($verif){
        echo "Vous allez etre rediriger vers notre site dans 3 secondes";
        echo '<script type="text/javascript">';
        echo 'setTimeout(function() {';
        echo '    window.location.href = "../php/accueil.php";'; // Remplacez par l'URL de la page de destination
        echo '}, 3000);'; // 3000 millisecondes = 3 secondes
        echo '</script>';
    }

    ?>

</body>
</html>