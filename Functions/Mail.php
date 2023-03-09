<?php 

$to = "jorn.jongstra@kpnmail.nl";
$subject = "test";
$msg = "hallo test code";
$from = "Jorn Jongtsra Yahoo";

if (mail($to, $subject, $msg, $from))
{
    echo "mail sent";
}
else
{
    echo "not send";
}


// $img = base64_encode();

?>