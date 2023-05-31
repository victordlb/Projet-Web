<?php

function validationinformation($id, $password)
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
        $requete = "SELECT * FROM user WHERE pseudo = '$id' OR mail= '$id'" ;
            
        if ($error)
        {
            // S'il y a eu une erreur, on l'affiche
            echo "<p>Error: $error</p>";
        } 
        else 
        {
            // On envoie la requête à MySQL
            $results = mysqli_query($db_handle, $requete);
            if (!$results || mysqli_num_rows($results) == 0) {
                echo "<p>Cette utilisateur n'existe pas</p>"; 
            }
            else
            {
                while($user = mysqli_fetch_assoc($results))
                {
                    if(password_verify($password, $user["password"]))
                    {
                        $ID_utilisateur = $user["ID_user"]; //
                        $requete2 = "UPDATE auser SET ID_auser = '$ID_utilisateur' WHERE 1=1";
                        $insertion = mysqli_query($db_handle, $requete2);
                        mysqli_close($db_handle); 
                        return True; // L'utilisateur existe et ses informations sont correcte
                    }
                }
            }

        }
    }

    mysqli_close($db_handle); 
    return False; // L'utilisateur existe mais ses informations sont incorrecte
}

function inscription_utilisateur($pseudo, $prenom,$nom,$mail,$age,$tel,$option, $password, $adresse, $ville, $codep, $pays, $file_name, $typec,$numeroc,$nomc,$datec,$cvc)
{
    $database = "piscine";
    $db_handle = mysqli_connect('db', 'root', 'mypassword', $database);
    $db_found = mysqli_select_db($db_handle, $database);

    $bool = false;

    if(!$db_handle)
    {
        echo "Connexion db echoue";
        $bool = false;    
    }
    else // nom	prenom	mail	password	avatar	fond	tel	pseudo	age
    // $pseudo, $prenom,$nom,$mail,$age,$tel,$option, $password_crypte
    {
        mysqli_begin_transaction($db_handle);
        try
        {
            // Insertion de l'utilisateur
            $stmtUtilisateur = mysqli_prepare($db_handle, "INSERT INTO user (nom, prenom, mail, password, tel, pseudo, age, avatar, status) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?)");
            mysqli_stmt_bind_param($stmtUtilisateur, 'ssssssiss', $nom, $prenom, $mail,$password, $tel, $pseudo, $age, $file_name, $option);

            mysqli_stmt_execute($stmtUtilisateur);
            $ID_Utilisateur = mysqli_insert_id($db_handle);

            if($option == 'vendeur')
            {
                // Insertion du vendeur
                $stmtVendeur = mysqli_prepare($db_handle, "INSERT INTO vendeur (ID_vendeur) VALUES (?)");
                mysqli_stmt_bind_param($stmtVendeur, 'i', $ID_Utilisateur);
                mysqli_stmt_execute($stmtVendeur);
            }
            if($option == 'acheteur')
            {
                // Insertion de l'acheteur
                $stmtVendeur = mysqli_prepare($db_handle, "INSERT INTO acheteur (ID_acheteur, adresse, ville, codep, pays) VALUES (?, ?, ?, ?, ?)");
                mysqli_stmt_bind_param($stmtVendeur, 'issss', $ID_Utilisateur, $adresse, $ville, $codep, $pays);
                mysqli_stmt_execute($stmtVendeur);

                $stmtCarte = mysqli_prepare($db_handle, "INSERT INTO infop (ID_info, type, num, nom, expire, cvc) VALUES (?, ?, ?, ?, ?, ?)");
                mysqli_stmt_bind_param($stmtCarte, 'issssi', $ID_Utilisateur, $typec, $numeroc, $nomc, $datec, $cvc);
                mysqli_stmt_execute($stmtCarte);
            }

            // Validation de la transaction
            mysqli_commit($db_handle);

            echo "L'inscription s'est bien effectuee !";
            $bool = true;
        }
        catch (Exception $e) {
            // En cas d'erreur, annulation de la transaction
            mysqli_rollback($db_handle);
            die("Erreur lors de l'inscription : " . $e->getMessage());
            $bool = false;
        }

        mysqli_close($db_handle); 
    }
    return $bool;
}

?>