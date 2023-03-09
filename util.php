<?php
function LoginCheck(int $minLevel = 1): bool {
    if (isset($_SESSION["UserLevel"]) && $_SESSION["UserLevel"] < $minLevel) {
        header("Location: index.php?page=home");
        exit();
    }

    // De gebruiker is alleen ingelogd als deze session is gezet.
    if (isset($_SESSION["UserID"])) {
        return true;
  }

  // De gebruiker is niet ingelogd. We sturen hem naar de inlogpagina.
  header("Location: index.php?page=Auth/Login");

  // Dit punt zou nooit gehaald moeten kunnen worden.
  return false;
}

function LoginCheckInReg() {
    if (isset($_SESSION["UserLevel"]) && $_SESSION["UserLevel"] > 0) {
        header("Location: index.php?page=home");
        exit();
    }
}

function ValideerEmail(string $email): bool
{
    // Controleer of de e-mail een geldige formaat heeft.
    return filter_var($email, FILTER_VALIDATE_EMAIL);
}

function ValideerWachtwoord(string $wachtwoord): bool
{
    // Een wachtwoord is alleen geldig als het minimaal 8 tekens
    // bevat.
    return strlen($wachtwoord) >= 8;
}

function BerekenEinddatum(string $startDatum, int $aantalDagen): string
{
    // StartDatum omzetten naar de DateTime class.
    $date = new DateTime($startDatum);
    // Het aantal dagen bij de startdatum optellen (add functie), en dan
    // omzetten naar een string (format functie).
    return $date->add(new DateInterval("P" . $aantalDagen . "D"))
        ->format("Y-m-d");
}

function StoreMsg(string $type, string $msg)
{
    //Set session
    $_SESSION['Msg'] = $msg;
    $_SESSION['Type'] = $type;
}

function ShowMsg()
{
    //shows message and type to session
    if (isset($_SESSION['Msg'])) : ?>
        <div class="alert <?php echo $_SESSION['Type'] ? $_SESSION['Type'] : "" ?>">
            <?php
            echo $_SESSION['Msg'];
            unset($_SESSION['Msg']);
            unset($_SESSION['Type']);
            ?>
        </div>
    <?php endif;
}

function Email($name, $email, $telefoon, $password)
{
    $to = $email;
    $subject = "Acount gegevens Dockey Travel";
    $msg = "
    Uw inlog gegevens zijn:

    \tNaam: $name
    \tEmail: $email
    \tTelefoon: $telefoon
    \tWachtwoord: $password
    
    \tBewaar deze gegevns goed!
    
    \tMet vriendelijke groet,
    
    \tHet Donkey Travel team.
    ";
    //$from = "Dockey Travel";

    mail($to, $subject, $msg);
}

function EmailGewijzigd($name, $email, $telefoon)
{
    $to = $email;
    $subject = "Wijziging gegevens Donkey Travel account";
    $msg = "
    Uw gegevens zijn als volgt gewijzigd:

    \tNaam: $name
    \tEmail: $email
    \tTelefoon: $telefoon
    
    \tBewaar deze gegevns goed!
    
    \tMet vriendelijke groet,
    
    \tHet Donkey Travel team.
    ";
    //$from = "Dockey Travel";

    mail($to, $subject, $msg);
}
?>