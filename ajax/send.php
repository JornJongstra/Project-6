<?php
    $msg = '
    <table style="padding: 1rem; background-color: rgb(221, 210, 186);"> 
        <tr>
            <th style="padding: 0.25rem; text-align: left; vertical-align:top;">Naam</th>
            <td style="padding: 0.25rem; text-align: left; vertical-align:top;">'.$_POST['name'].'</td>
        </tr>
        <tr>
            <th style="padding: 0.25rem; text-align: left; vertical-align:top;">Email</th>
            <td style="padding: 0.25rem; text-align: left; vertical-align:top;">'.$_POST['email'].'</td>
        </tr>
        <tr>
            <th style="padding: 0.25rem; text-align: left; vertical-align:top;">Telefoon</th>
            <td style="padding: 0.25rem; text-align: left; vertical-align:top;">'.$_POST['tel'].'</td>
        </tr>
        <tr>
            <th style="padding: 0.25rem; text-align: left; vertical-align:top;">Bericht</th>
            <td style="padding: 0.25rem; text-align: left; vertical-align:top;">'.nl2br($_POST['message']).'</td>
        </tr>
    </table>
    ';

    $from = "test@test.com";
    $to = "test@test.com";

    $headers = "";
    $headers .= "From: $from \r\n";
    $headers .= "Reply-To:" .$from. "\r\n" ."X-Mailer: PHP/" . phpversion();
    $headers .= 'MIME-Version: 1.0' . "\r\n";
    $headers .= 'Content-type: text/html; charset=iso-8859-1' . "\r\n";    

    if(mail($from, $_POST['name']. ' heeft een bericht achtergelaten', $msg, $headers)){
        $response = [
            'success' 			=> true,
            "response_title" => 'Gelukt!',
            "response_message" => 'Je email is verstuurd!',
        ];
    }else{
        $response = [
            'success' 			=> false,
            "response_title" => 'Mislukt!',
            "response_message" => 'Je email is niet verstuurd!',
        ];
    }

    header('Content-type: application/json');
    die(json_encode($response));
?>