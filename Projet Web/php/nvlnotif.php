<?php
include '../php/db.php' ;
$data = recup_data();
$date1 = date('d/m/Y');
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <link rel="stylesheet" href="../css/style-general.css">
    <title>Ajout</title>
</head>
<body>
    <h1>Ajout notif</h1>

    <div>
        <div>
            <form action="" method="post">
                <table>
                    <tr>
                        <td>Type</td>
                        <td>
                            <select id="options" name="options" required onchange="ajout_attributs()">
                                <option value="" disabled selected hidden>Sélectionnez une option</option>
                                <option value="livre">Livres</option>
                                <option value="vetement">Vetements</option>
                                <option value="arme">Armes</option>
                            </select>
                        </td>
                    </tr>
                    <tr>
                        <td>Message</td>
                        <td><input type="text" name="message" placeholder="Ajouter une description"></td>
                    </tr>
                    <tr>
                        <td><input type="submit" name="Ajout" value="Valider"></td>
                    </tr>
                </table>
            </form>
        </div>
    </div>

    <?php
    if(isset($_POST['Ajout']))
    {
        $type = isset($_POST["options"]) ? $_POST["options"] : "";
        $date = date('Y-m-d');
        $message = isset($_POST["message"]) ? $_POST["message"] : "";
        while($auser = mysqli_fetch_assoc($data))
        {
            $id_user = $auser['ID_user'];
        }
        ajout_notif($type, $message, $date, $id_user);
    }

    function ajout_notif($type, $message, $date, $id_user)
    {
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
            $requete = "INSERT INTO notif (type, date, message, ID_user) VALUES ('$type', '$date', '$message' , '$id_user')";
            if ($error)
            {
                // S'il y a eu une erreur, on l'affiche
                echo "<p>Error: $error</p>";
            } 
            else 
            {
                // On envoie la requête à MySQL
                $results = mysqli_query($db_handle, $requete);
                echo "La notif a ete ajoute";
            }
        
        mysqli_close($db_handle); 
        
        }
    }
    ?>

    <a href="../php/notifications.php">Quitter l'ajout de notif</a>
    
</body>
</html>