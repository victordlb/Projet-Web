<?php

function recup_data()
{
    $database = "piscine";
    $db_handle = mysqli_connect('db', 'root', 'mypassword', $database);
    $db_found = mysqli_select_db($db_handle, $database);

    $requete = "SELECT * FROM auser";
    $result = mysqli_query($db_handle, $requete);
    while($user = mysqli_fetch_assoc($result))
    {
        $ID_utilisateur = $user["ID_auser"];
        $requete2 = "SELECT * FROM user WHERE ID_user = '$ID_utilisateur'";
        $data = mysqli_query($db_handle, $requete2);
        mysqli_close($db_handle); 
    }

    return $data;
}
?>