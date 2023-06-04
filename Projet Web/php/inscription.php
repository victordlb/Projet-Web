<?php
include_once 'log.php' ;
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <script src="../js/log.js"></script>
    <link rel="stylesheet" href="../css/style-compte.css">
    <link rel="stylesheet" href="../css/style-general.css">
    <title>Inscription</title>
</head>
<body>
    <h1>Inscription</h1>
    <div>
        <div class="container">
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
                        <td>
                            <select id="options" name="options2" required onchange="ajout_attributs()">
                                <option value="" disabled selected hidden>Sélectionnez une option</option>
                                <option value="a1.jpg">homme 1</option>
                                <option value="a2.jpg">femme 1</option>
                                <option value="a3.jpg">homme 2</option>
                                <option value="a4.jpg">homme 3</option>
                                <option value="a5.jpg">femme 2</option>
                                <option value="a6.jpg">femme 3</option>
                                <option value="a7.jpg">homme 4</option>
                                <option value="a8.jpg">femme 4</option>
                                <option value="a9.jpg">homme 5</option>
                            </select>
                        </td>
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
                                <option value="admin">Compte admin </option>
                            </select>
                        </td>
                    </tr>
                    <tr>
                        <td id="nvAttributs">
                            
                        </td> 
                    </tr>
                    <tr>
                        <td><a href=../php/connexion.php>Retourner a la page de connexion</a></td>
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

        $photo = isset($_POST["options2"]) ? $_POST["options2"] : "";
        $file_name = "../photos/";
        $file_name .= $photo;

        $typec = isset($_POST["typec"]) ? $_POST["typec"] : "";
        $numeroc = isset($_POST["numeroc"]) ? $_POST["numeroc"] : "";
        $nomc = isset($_POST["nomc"]) ? $_POST["nomc"] : "";
        $datec = isset($_POST["expirationc"]) ? $_POST["expirationc"] : "";
        $cvc = isset($_POST["cvc"]) ? $_POST["cvc"] : "";

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