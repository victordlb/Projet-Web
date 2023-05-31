<?php
include_once 'log.php' ;
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <script src="../js/log.js"></script>
    <link rel="stylesheet" href="../css/style-compte.css">
    <title>Inscription</title>
</head>
<body>
    <h1>Inscription</h1>
    <div>
        <div>
            <form method="post" action="" onsubmit="return validerMotDePasse()" enctype="multipart/form-data">
                <table>
                    <tr>
                        <td>Pseudo</td>
                        <td><input type="text" name="pseudo" placeholder="Saisir un pseudo" required></td>
                    </tr>
                    <tr>
                        <td>Prenom</td>
                        <td><input type="text" name="prenom" placeholder="Saisir votre prenom" required></td>
                    </tr>
                    <tr>
                        <td>Nom</td>
                        <td><input type="text" name="nom" placeholder="Saisir votre nom" required></td>
                    </tr>
                    <tr>
                        <td>Mail</td>
                        <td><input type="email" name="email" placeholder="Saisir votre adresse email" required></td>
                    </tr>
                    <tr>
                        <td>Age</td>
                        <td><input type="number" name="age" placeholder="Saisir votre age" required></td>
                    </tr>
                    <tr>
                        <td>Telephone</td>
                        <td><input type="text" name="telephone" placeholder="Saisir votre numero de telephone" required></td>
                    </tr>
                    <tr>
                        <td>Photo</td>
                        <td><input type="file" name="photo" accept="image/*"></td>
                    </tr>
                    <tr>
                        <td>Fond d'ecran</td>
                        <td><input type="text" name="fond" placeholder="Selectionner une photo de fond"></td>
                    </tr>
                    <tr>
                        <td>Mot de passe</td>
                        <td><input type="password" id="mot_de_passe" name="password2" placeholder="Saisir un mot de passe" required></td>
                        <td><input type="button" value="👁" onclick="afficherMotDePasse()"></td>
                    </tr>
                    <tr>
                        <td>Dans quel but creez-vous ce compte ?</td>
                        <td>
                            <select id="options" name="options" required onchange="ajout_attributs()">
                                <option value="" disabled selected hidden>Sélectionnez une option</option>
                                <option value="acheteur">Acheter des articles</option>
                                <option value="vendeur">Vendre des articles</option>
                            </select>
                        </td>
                    </tr>
                    <tr>
                        <td id="nvAttributs">
                            
                        </td> 
                    </tr>

                    <tr>
                        <td><input type="submit" name="inscription" value="Valider"></td>
                    </tr>
                </table>
            </form>
        </div>
    </div>

    <?php

    $valid = false;

    if(isset($_POST['inscription']))
    {
        $pseudo = isset($_POST["pseudo"]) ? $_POST["pseudo"] : "";
        $prenom = isset($_POST["prenom"]) ? $_POST["prenom"] : "";
        $nom = isset($_POST["nom"]) ? $_POST["nom"] : ""; 
        $mail = isset($_POST["email"]) ? $_POST["email"] : "";
        $age = isset($_POST["age"]) ? $_POST["age"] : "";
        $tel = isset($_POST["telephone"]) ? $_POST["telephone"] : "";
        $option = isset($_POST["options"]) ? $_POST["options"] : "";

        $adresse = isset($_POST["adresse"]) ? $_POST["adresse"] : "";
        $ville = isset($_POST["ville"]) ? $_POST["ville"] : "";
        $codep = isset($_POST["codep"]) ? $_POST["codep"] : "";
        $pays = isset($_POST["pays"]) ? $_POST["pays"] : "";

        $photo = isset($_FILES["photo"]) ? $_FILES["photo"] : "";
        $file_name = "../images/" . $photo['name'];

        $typec = isset($_FILES["typec"]) ? $_FILES["typec"] : "";
        $numeroc = isset($_FILES["numeroc"]) ? $_FILES["numeroc"] : "";
        $nomc = isset($_FILES["nomc"]) ? $_FILES["nomc"] : "";
        $datec = isset($_FILES["expirationc"]) ? $_FILES["expirationc"] : "";
        $cvc = isset($_FILES["cvc"]) ? $_FILES["cvc"] : "";

        $password = isset($_POST['password2']) ? $_POST["password2"] : "";
        $password_crypte = password_hash($password, PASSWORD_DEFAULT);


        if(inscription_utilisateur($pseudo, $prenom,$nom,$mail,$age,$tel,$option, $password_crypte, $adresse, $ville, $codep, $pays, $file_name, $typec,$numeroc,$nomc,$datec,$cvc)){
            $valid = true;
        }
        else
        {
            $valid = false;
        }
    }



    if($valid){
        echo "</br><a href=../php/connexion.php>Retourner a la page de connexion</a>";
    }

    ?>
    
</body>
</html>