<?php

session_start();

$_SESSION["session_token"] = null;


if($_SESSION["session_token"] == null){
    //On ouvre la session api glpi
    $ch = curl_init();
    curl_setopt_array($ch, array(
        CURLOPT_RETURNTRANSFER => 1,
        CURLOPT_URL =>
            "localhost/glpi-9.2/apirest.php/initSession/?login=glpi&password=glpi",
        CURLOPT_HTTPHEADER => array(
            'Content-Type' => 'application/json',
            'App-Token' => '7QumVF4l7YwJpPr0Je8yis55nGZYDPM6bKg1lp8w'
        )
    ));

//on récupère la session
    $reponseJson = curl_exec($ch);

    $reponse = json_decode($reponseJson);

//on sauvegarde le tokken de session renvoyé par l'api
    $_SESSION["session_token"] = $reponse->session_token;

//on libère les ressources
    curl_close($ch);
}

var_dump($_SESSION["session_token"]);

echo "</br>";


//on init pour récupérer tous les entités
$ch = curl_init();
curl_setopt_array($ch, array(
        CURLOPT_RETURNTRANSFER => 1,
        CURLOPT_URL => 'localhost/glpi-9.2/apirest.php/Ticket/?session_token='. $_SESSION['session_token'],
        CURLOPT_HTTPHEADER => array(
            'Content-Type' => 'application/json',
            "Session-Token" => $_SESSION["session_token"],
            'App-Token' => '7QumVF4l7YwJpPr0Je8yis55nGZYDPM6bKg1lp8w'
        )
    )
);

$reponse = curl_exec($ch);

$tabTicket = json_decode($reponse);
echo "</br>";

if(true == false){
//on init la session curl pour fermer la session de l'api
    $ch = curl_init(
        curl_setopt_array($ch, array(
                CURLOPT_RETURNTRANSFER => 1,
                CURLOPT_URL => 'localhost/apirest.php/killSession',
                CURLOPT_HTTPHEADER => array(
                    'Content-Type' => 'application/json',
                    "Session-Token" => $_SESSION["session_token"],
                    'App-Token' => '7QumVF4l7YwJpPr0Je8yis55nGZYDPM6bKg1lp8w'
                )
            )
        )
    );
}

curl_close($ch);


?>
<html>
<head>
    <meta charset="UTF-8">
    <title>Accueil</title>
</head>
<body>
    <h1>GLPI API</h1>


    <table>

        <tr>
            <?php
                foreach ($tabTicket as $ticket){
                    echo "<td>". $ticket->id . "</td> <td>". $ticket->name . "</td>";
                }
            ?>
        </tr>

    </table>

</body>
</html>
