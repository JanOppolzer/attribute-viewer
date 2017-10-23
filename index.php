<?php
    require("php/saml.php");
    $logged     = logged();
    $cztestfed  = cztestfed();
?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>Attribute Viewer :: <?=$_SERVER["HTTP_HOST"]?></title>
    <link rel="stylesheet" href="css/normalize.css">
    <link rel="stylesheet" href="css/style.css">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="author" content="Jan Oppolzer; jan@oppolzer.cz">
    <script src="js/script.js" type="text/javascript"></script>
</head>
<body>
<div class="container">

    <header>

        <div class="clearfix">

            <h1 class="float-left">
                <a href="https://<?=$_SERVER["HTTP_HOST"]?>">https://<?=$_SERVER["HTTP_HOST"]?></a>
            </h1>

            <h1 class="float-right">
                <a class="float-right" href="https://www.eduid.cz">CESNET</a>
            </h1>

        </div>

        <h2>Attribute Viewer</h2>

        <hr class="hidden">

    </header>

    <main>

        <p>
            Tato stránka vypíše seznam atributů, které byly poskytnuty Vaším
            poskytovatelem identity (Identity Provider, IdP) a dozvíte se, zda jsou
            dostupné informace nezbytné pro funkčnost služeb v&nbsp;rámci e-Infrastruktury
            <a href="https://www.cesnet.cz">CESNET</a>. Máte-li účet v <a
            href="https://perun.cesnet.cz/">Perunovi</a>, zobrazí se i atributy z Peruna,
            které začínající slovem <em>perun</em>.
        </p>

        <p>
            Atributy ve federaci eduID.cz jsou několika druhů:
        </p>

        <ul>
            <li>Povinné</li>
            <li>Doporučené</li>
            <li>TCS</li>
            <li>R&amp;S</li>
        </ul>

        <p>
            V&nbsp;případě, že Vaše IdP uvolňuje atributy na základě <a
            href="https://www.eduid.cz/cs/tech/idp/shibboleth#confattribute-filterxml">doporučení</a>
            federace <a href="https://www.eduid.cz">eduID.cz</a>, měly by služby dostupné
            ve federaci bezproblémově fungovat. Pokud správce Vašeho IdP nějakým způsobem
            uvolňování atributů limituje pro jednotlivé služby (Service Provider, SP), pak
            skutečnost, že atributy vidíte zde, nezaručuje, že jsou atributy uvolňovány i
            dalším službám a funkčnost ostatních služeb tedy není zaručena.
        </p>

        <p>
            Pokud Vám nějaká služba nefunguje, vždy byste se měli držet
            následujícího postupu a kontaktovat:
        </p>
        
        <ol>
            <li>správce služby (SP),</li>
            <li>správce Vašeho IdP,</li>
            <li>operátora federace <a href="mailto:eduid-admin@eduid.cz">eduID.cz</a>.</li>
        </ol>

        <p>
            Správce služby by měl být schopný Vás informovat, proč nedošlo ke
            korektnímu přihlášení &ndash; např. z&nbsp;důvodu, že chybí nějaký atribut.
            Správce Vašeho IdP je ten, kdo může uvolnit požadovaný atribut. Správce
            federace Vám může v&nbsp;tomto procesu pomoci, pokud byste se cítili naprosto
            ztraceni.
        </p>

        <hr class="hidden">

<?php

if($logged) {
    $arpResult = array (
        0 => "arp-error",
        1 => "arp-ok",
        2 => "arp-warning",
    );

?>
        <div>
            <h3>Stav uvolňování atributů</h3>

            <ul class="buttons">
                <li class="arp-check <?=$arpResult[eduIDczAttributes()]?>">eduID.cz</li>
                <li class="arp-check <?=$arpResult[tcsAttributes()]?>">TCS</li>
<?php
    if(isRS()) {
?>
                <li class="arp-check <?=$arpResult[rsAttributes()]?>">R&amp;S</li>
<?php
    } else {
?>
                <li class="arp-check arp-warning">R&amp;S</li>
<?php
    }

    if (isSIRTFI()) {
?>
                <li class="arp-check <?=$arpResult[isSIRTFI()]?>">SIRTFI</li>
<?php
    } else {
?>
                <li class="arp-check arp-warning">SIRTFI</li>
<?php
    }
?>
            </ul>

        </div>

        <hr class="hidden">
<?php

}

if($logged &&
    (!isset($attributes["eppn"]) ||
     !isset($attributes["affiliation"]) ||
     !isset($attributes["persistent-id"]) ||
     !isset($attributes["uniqueId"]) ||
     !isset($attributes["givenName"]) ||
     !isset($attributes["sn"]) ||
     !isset($attributes["cn"]) ||
     !isset($attributes["mail"]) ||
     !isset($attributes["unstructuredName"]))) {
?>

        <div class="error">
            <h3>Povinné atributy</h3>
            <ul>
<?php

     $class = "attr-required";
     missingAttribute($attributes["eppn"], "eppn", $class);
     missingAttribute($attributes["affiliation"], "affiliation", $class);
     missingAttribute($attributes["persistent-id"], "persistent-id", $class);
     missingAttribute($attributes["uniqueId"], "uniqueId", $class);
     missingAttribute($attributes["givenName"], "givenName", $class);
     missingAttribute($attributes["sn"], "sn", $class);
     missingAttribute($attributes["cn"], "cn", $class);
     missingAttribute($attributes["mail"], "mail", $class);
     missingAttribute($attributes["unstructuredName"], "unstructuredName", $class);

?>
            </ul>
        </div>

        <hr class="hidden">
<?php

}

?>

<?php

if($logged &&
    (!isset($attributes["displayName"]) ||
     !isset($attributes["o"]) ||
     !isset($attributes["ou"]) ||
     !isset($attributes["entitlement"]))) {
?>

        <div class="warning">
            <h3>Doporučené atributy</h3>
            <ul>
<?php

     $class = "attr-recommended";
     missingAttribute($attributes["displayName"], "displayName", $class);
     missingAttribute($attributes["o"], "o", $class);
     missingAttribute($attributes["ou"], "ou", $class);
     missingAttribute($attributes["entitlement"], "entitlement", $class);

?>
            </ul>
        </div>

        <hr class="hidden">

<?php

}

?>

<?php

if($logged) {
    if(!isset($attributes["authMail"]) ||
       !isset($attributes["commonNameASCII"])) {
?>

        <div class="error">
            <h3>Atributy pro certifikáty (TCS)</h3>

            <ul>

<?php

     $class = "attr-required";
     missingAttribute($attributes["authMail"], "authMail", $class);
     missingAttribute($attributes["commonNameASCII"], "commonNameASCII", $class);

?>

            </ul>

        </div>

        <hr class="hidden">
<?php

    }    if(!isset($attributes["telephoneNumber"]) ) {
?>

        <div class="warning">
            <h3>Atributy pro certifikáty (TCS)</h3>

            <ul>

<?php

     $class = "attr-recommended";
     missingAttribute($attributes["telephoneNumber"], "telephoneNumber", $class);

?>

            </ul>

        </div>
<?php

    }

}

$isRS = isRS();

if($logged) {
    if(!$isRS) {
?>
        <div class="warning">
            <h3>Research &amp; Scholarship (R&amp;S)</h3>

            <ul>
                <li>Zvažte podporu pro <a href="https://www.eduid.cz/cs/tech/categories/rs">R&amp;S</a>.</li>
            </ul>
        </div>
<?php
    }
    elseif($isRS) {

    if(!isset($attributes["displayName"]) ||
       !isset($attributes["eppn"]) ||
       !isset($attributes["affiliation"]) ||
       !isset($attributes["persistent-id"]) ||
       !isset($attributes["givenName"]) ||
       !isset($attributes["mail"]) ||
       !isset($attributes["sn"])) {

?>

        <div class="error">
            <h3>Research &amp; Scholarship (R&amp;S)</h3>

            <ul>

<?php

     $class = "attr-required";
     missingAttribute($attributes["displayName"], "displayName", $class);
     missingAttribute($attributes["eppn"], "eppn", $class);
     missingAttribute($attributes["affiliation"], "affiliation", $class);
     missingAttribute($attributes["persistent-id"], "persistent-id", $class);
     missingAttribute($attributes["givenName"], "givenName", $class);
     missingAttribute($attributes["mail"], "mail", $class);
     missingAttribute($attributes["sn"], "sn", $class);

?>

            </ul>
        </div>

<?php
    }
    }
}

?>

<?php

$isSIRTFI = isSIRTFI();

if($logged) {
    if(!$isSIRTFI) {
?>
        <div class="warning">
            <h3>SIRTFI</h3>

            <ul>
                <li>Zvažte podporu pro <a href="https://www.eduid.cz/cs/tech/categories/sirtfi">SIRTFI</a>.</li>
            </ul>
        </div>
<?php
    }
}
?>

        <hr class="hidden">

<?php

if($logged) {

?>

        <h3>Dostupné atributy a jejich hodnoty</h3>

        <table border="1">
            <thead>
                <tr>
                    <th>Atribut</th>
                    <th>Hodnota</th>
                </tr>
            </thead>
            <tbody>
<?php

    //$level = "attr-required";
    $level = "attr-saml";
    printAttribute("givenName", $level);
    printAttribute("sn", $level);
    printAttribute("cn", $level);
    printAttribute("displayName", $level);
    printAttribute("commonNameASCII", $level);
    printAttribute("o", $level);
    printAttribute("ou", $level);
    printAttribute("schacHomeOrganization", $level);
    printAttribute("mail", $level);
    printAttribute("authMail", $level);
    printAttribute("telephoneNumber", $level);
    printAttribute("eppn", $level);
    printAttribute("uniqueId", $level);
    printAttribute("unstructuredName", $level);
    printAttribute("persistent-id", $level);
    printAttribute("affiliation", $level);
    printAttribute("entitlement", $level);

    //$level = "attr-local";
    printAttribute("headDegree", $level);
    printAttribute("tailDegree", $level);
    printAttribute("unscoped-affiliation", $level);
    printAttribute("authorisedMail", $level);
    printAttribute("tcsPersonalID", $level);
    printAttribute("uid", $level);
    printAttribute("cesnetEmplID", $level);
    printAttribute("loa", $level);
    printAttribute("md_entityCategory", $level);
    printAttribute("md_entityCategorySupport", $level);
    printAttribute("md_assuranceCertification", $level);

    printAttribute("eduroamUID", $level);

    $level = "attr-perun";
    printAttribute("perunEntryStatus", $level);
    printAttribute("perunGroupDn", $level);
    printAttribute("perunGroupId", $level);
    printAttribute("perunGroupName", $level);
    printAttribute("perunOrganizationName", $level);
    printAttribute("perunPreferredMail", $level);
    printAttribute("perunPrincipalName", $level);
    printAttribute("perunUniqueGroupName", $level);
    printAttribute("perunUserId", $level);
    printAttribute("perunVoId", $level);
    printAttribute("perunVoName", $level);

    $level = "attr-shibboleth";
    printSessionAttribute("Shib-Application-ID", $level);
    printSessionAttribute("Shib-Session-ID", $level);
    printSessionAttribute("Shib-Identity-Provider", $level);
    printSessionAttribute("Shib-Authentication-Instant", $level);
    printSessionAttribute("Shib-Authentication-Method", $level);
    printSessionAttribute("Shib-AuthnContext-Class", $level);
    printSessionAttribute("Shib-Session-Index", $level);
    printSessionAttribute("Shib-Assertion-Count", $level);
    printSessionAssertionURL($level);

?>
            </tbody>
        </table>

        <hr class="hidden">

<?php
    if(strpos($_SERVER["QUERY_STRING"], "show_assertion") !== false) {
        echo '<a name="assertion"></a>' . "\n";
        printAssertions($saml);
        echo '<hr class="hidden">';
    }
?>

<?php   if(strpos($_SERVER["QUERY_STRING"], "show_session") !== false) { ?>
        <a name="session"></a>
        <h3>Obsah proměnné $_SERVER</h3>

        <table border="1">
<?php   foreach($_SERVER as $key => $value) {
            echo "<tr><td>" .htmlspecialchars ($key). "</td><td>" .htmlspecialchars ($value). "</td></tr>\n";
        } ?>
        </table>

        <hr class="hidden">
<?php   } ?>

        <p>
            <small>
<?php   if(strpos($_SERVER["QUERY_STRING"], "show_assertion") === false) { ?>
            <a href="<?php createURI("show_assertion#assertion", $_SERVER["QUERY_STRING"]); ?>">Zobrazit Shibboleth assertion</a>, 
<?php   } else { ?>
            <a href="<?php modifyURI("show_assertion", $_SERVER["QUERY_STRING"]); ?>">Schovat Shibboleth assertion</a>, 
<?php   } ?>
<?php   if(strpos($_SERVER["QUERY_STRING"], "show_session") === false) { ?>
            <a href="<?php createURI("show_session#session", $_SERVER["QUERY_STRING"]); ?>">Zobrazit všechny proměnné</a>
<?php   } else { ?>
            <a href="<?php modifyURI("show_session", $_SERVER["QUERY_STRING"])?>">Schovat všechny proměnné</a>
<?php   } ?>
            </small>
        </p>

        <p>
            <strong>Pokud jste o to byli požádáni, můžete <a
            href="send-attributes.php">poslat atributy</a> správcům federace
            eduID.cz.</strong>
        </p>

        <hr class="hidden">

<?php } ?>

        <ul class="buttons">
<?php   if(!$logged) { ?>
            <li class="logsum"><a href="/Shibboleth.sso/Login?target=https://<?=$_SERVER['HTTP_HOST']?><?=$_SERVER['REQUEST_URI']?>">Přihlásit (eduID.cz)</a></li>
            <li class="logsum"><a href="/cztestfed/Shibboleth.sso/Login?target=https://<?=$_SERVER['HTTP_HOST']?>/cztestfed">Přihlásit (czTestFed)</a></li>
<?php   } else { ?>
<?php       if(!$cztestfed) { ?>
            <li class="logsum"><a href="/Shibboleth.sso/Logout?target=/">Odhlásit</a></li>
            <li class="logsum"><a href="/Shibboleth.sso/Session">Session summary</a></li>
            <li class="logsum"><a href="/Shibboleth.sso/Login?forceAuthn=1">Re-authenticate</a></li>
<?php       } else { ?>
            <li class="logsum"><a href="/cztestfed/Shibboleth.sso/Logout?target=/">Odhlásit</a></li>
            <li class="logsum"><a href="/cztestfed/Shibboleth.sso/Session">Session summary</a></li>
            <li class="logsum"><a href="/cztestfed/Shibboleth.sso/Login?forceAuthn=1&target=https://<?=$_SERVER['HTTP_HOST']?>/cztestfed">Re-authenticate</a></li>
<?php       } ?>
<?php   } ?>
        </ul>

    </main>

    <footer>

        <hr>

        <p>
            <small>&copy; 2016&ndash;<?=Date("Y")?> <a href="https://www.cesnet.cz">CESNET, z. s. p. o.</a></small>
        </p>

    </footer>

</div>

</body>
</html>

