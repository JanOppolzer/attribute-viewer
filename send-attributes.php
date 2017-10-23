<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>Attribute Viewer :: <?=$_SERVER["HTTP_HOST"]?></title>
    <link rel="stylesheet" href="css/normalize.css">
    <link rel="stylesheet" href="css/style.css">
    <meta name="viewport" content="width=device-width, initial-scale=1">
</head>
<body>

<?php

require("./php/saml.php");

/*
 * From:    Attributes eduID.cz <no-reply@attributes.eduid.cz>
 * Subject: IdP: CESNET, z. s. p. o. [https://whoami.cesnet.cz/idp/shibboleth]
 *
 * Uživatel Jan Oppolzer (jop@cesnet.cz) zasílá přehled uvolňovaných atributů z
 * IdP [https://whoami.cesnet.cz/idp/shibboleth]:
 *
 * ------------------------------------------------------------------------
 *
 * 1. Povinné atributy:
 *
 * atribut1: hodnota
 * atribut2: hodnota
 * atribut3: hodnota
 *
 * ------------------------------------------------------------------------
 *
 * 2. Doporučené atributy:
 *
 * atribut1: hodnota
 * atribut2: hodnota
 * atribut3: hodnota
 *
 * ------------------------------------------------------------------------
 *
 * 3. TCS atributy:
 *
 * atribut1: hodnota
 * atribut2: hodnota
 * atribut3: hodnota
 *
 * ------------------------------------------------------------------------
 * 
 * 4. Lokální atributy:
 *
 * atribut1: hodnota
 * atribut2: hodnota
 * atribut3: hodnota
 *
 * ------------------------------------------------------------------------
 *
 * 5. Perun atributy:
 *
 * atribut1: hodnota
 * atribut2: hodnota
 * atribut3: hodnota
 *
 * ------------------------------------------------------------------------
 *
 * 6. Následuje obsah proměnné $_SERVER:
 *
 * -- 
 *   https://attributes.eduid.cz
 */

if(isset($attributes["mail"])) {
    $mailaddr = explode(";", $attributes["mail"]);
}

$to         = "eduid-admin@eduid.cz";
$subject    = "IdP: " .$attributes["o"]. " [".$session["Shib-Identity-Provider"]."]";
$subject    = "=?utf-8?b?" .base64_encode($subject). "?=";
$headers    = "From: eduID.cz Attributes <no-reply@attributes.eduid.cz>" . "\n" .
              "Reply-To: " .$mailaddr[0]. "\n" .
              "MIME-Version: 1.0" . "\n" .
              "Content-Type: text/plain; charset=utf-8" . "\n" .
              "Content-Transfer-Encoding: 8bit" . "\n" .
              "X-Mailer: PHP/" . phpversion();

$message  = "Uživatel " .$attributes["cn"]. " (" .$attributes["eppn"]. ") ";
$message .= "zasílá přehled uvolňovaných atributů z IdP [" .$session["Shib-Identity-Provider"]. "]:\n";

$message .= "\n------------------------------------------------------------------------\n";

$message .= "\nDŮLEŽITÉ!\n";
$message .= "Nezapomeň se podívat na:\n";
$message .= "https://www.eduid.cz/cs/internal/drafts/join\n";

$message .= "\n------------------------------------------------------------------------\n";

$message .= "\n1. Povinné atributy:\n\n";
$message .= "eduPersonPrincipalName: "          .$attributes["eppn"].              "\n";
$message .= "eduPersonScopedAffiliation: "      .$attributes["affiliation"].       "\n";
$message .= "eduPersonTargetedID: "             .$attributes["persistent-id"].     "\n";
$message .= "eduPersonUniqueId: "               .$attributes["uniqueId"].          "\n";
$message .= "unstructuredName: "                .$attributes["unstructuredName"].  "\n";
$message .= "givenName: "                       .$attributes["givenName"].         "\n";
$message .= "sn: "                              .$attributes["sn"].                "\n";
$message .= "cn: "                              .$attributes["cn"].                "\n";
$message .= "mail: "                            .$attributes["mail"].              "\n";

$message .= "\n------------------------------------------------------------------------\n";

$message .= "\n2. Doporučené atributy:\n\n";
$message .= "displayName: "                     .$attributes["displayName"].       "\n";
$message .= "o: "                               .$attributes["o"].                 "\n";
$message .= "ou: "                              .$attributes["ou"].                "\n";
$message .= "eduPersonEntitlement: "            .$attributes["entitlement"].       "\n";

$message .= "\n------------------------------------------------------------------------\n";

$message .= "\n3. TCS atributy -- povinné:\n\n";
$message .= "authMail: "                        .$attributes["authMail"].          "\n";
$message .= "commonNameASCII: "                 .$attributes["commonNameASCII"].   "\n";

$message .= "\n------------------------------------------------------------------------\n";

$message .= "\n4. TCS atributy -- doporučené:\n\n";
$message .= "telephoneNumber: "                 .$attributes["telephoneNumber"].   "\n";

$message .= "\n------------------------------------------------------------------------\n";

$message .= "\n5. Lokální atributy:\n\n";
$message .= "LoA: "                             .$attributes["loa"].               "\n";

/*
* vyházet SERVER_*, HTTP_*, PHP_*, Shib-* a všechny výše uvedené atributy
* a zbytek vyhodit sem
*/

$message .= "\n------------------------------------------------------------------------\n";

$message .= "\n6. Perun atributy:\n\n";
$message .= "perunEntryStatus: "                .$attributes["perunEntryStatus"].      "\n\n";
$message .= "perunGroupDn: "                    .$attributes["perunGroupDn"].          "\n\n";
$message .= "perunGroupId: "                    .$attributes["perunGroupId"].          "\n\n";
$message .= "perunGroupName: "                  .$attributes["perunGroupName"].        "\n\n";
$message .= "perunOrganizationName: "           .$attributes["perunOrganizationName"]. "\n\n";
$message .= "perunPreferredMail: "              .$attributes["perunPreferredMail"].    "\n\n";
$message .= "perunPrincipalName: "              .$attributes["perunPrincipalName"].    "\n\n";
$message .= "perunUniqueGroupName: "            .$attributes["perunUniqueGroupName"].  "\n\n";
$message .= "perunUserId: "                     .$attributes["perunUserId"].           "\n\n";
$message .= "perunVoId: "                       .$attributes["perunVoId"].             "\n\n";
$message .= "perunVoName: "                     .$attributes["perunVoName"].           "\n\n";

$message .= "\n------------------------------------------------------------------------\n";

$message .= "\n7. Následuje obsah proměnné \$_SERVER:\n\n";
foreach($_SERVER as $key => $value) {
    $message .= "$key: $value\n";
}

$message .= "\n------------------------------------------------------------------------\n";

$message .= "\n8. Následují XML assertions:\n\n";
$message .= sendAssertions($saml);

$message .= "\n-- \n  https://attributes.eduid.cz\n\n";

if(mail($to, $subject, $message, $headers)) {

?>

        <p>E-mail s atributy byl odeslán správcům federace eduID.cz.</p>

        <p>Přejít <a href="/">zpět</a>.</p>

<?php

} else {

?>

        <p>E-mail se nepodařilo odeslat, kontaktujte správce stránky.</p>

        <p>Kontaktujte nás na adrese <a href="mailto:eduid-admin@eduid.cz">eduid-admin@eduid.cz</a>.</p>

<?php

}

?>

</body>
</html>

