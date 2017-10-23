<?php

/* load attributes definitions (name and SAML2 encoding)
 */
require("attributes.php");

/* obtained SAML attributes
 */
$attributes = array(); // user attributes including SERVER_*, PHP_*, etc.
$saml       = array(); // SAML assertions
$session    = array(); // Shib-* session variables

/* createURI()
 */
function createURI($uri, $original) {
    if($original) {
        $uri = $original . "&amp;" . $uri;
    }
    echo "?" . $uri;
}

/* modifyURI()
 */
function modifyURI($uri, $original) {
    $uri = preg_replace("/$uri/", "", $original);
    $uri = preg_replace("/&&/", "&", $uri);    // change && to &
    $uri = preg_replace("/^&/", "", $uri);     // drop leading &
    $uri = preg_replace("/&$/", "", $uri);     // drop ending &
    strlen($uri) !== 0 ? $prefix = "?" : $prefix = "/";
    echo $prefix . htmlspecialchars($uri);
}

/* filter $_SERVER variable
 */
foreach($_SERVER as $key => $value) {
    /* filter Shib-* variables
     */
    if(preg_match("/^(Shib-.+)/", $key, $match)) {
        $session[$match[1]] = $value;
    }
    /* filter the rest (user attributes including SERVER_*, PHP_*, etc.)
     */
    elseif(preg_match("/^(.+)$/", $key, $match)) {
        $attributes[$match[1]] = $value;
    }
}

/* is user logged in?
 */
function logged() {
    if(isset($GLOBALS["session"]["Shib-Session-ID"]))
        return true;
    else
        return false;
}

/* determine czTestFed
 */
function cztestfed() {
    if(preg_match("/^\/cztestfed\/index\.php/", $_SERVER["SCRIPT_NAME"]))
        return true;
    else
        return false;
}

/* are there any SAML assertions?
 */
if(isset($session["Shib-Assertion-Count"])) {
    /* how many SAML assertions are available?
     */
    $samlCount = intval($session["Shib-Assertion-Count"]);
    if($samlCount) {
        for($i=1; $i<=$samlCount; $i++) {
            $samlName = sprintf("Shib-Assertion-%02d", $i);
            /* save individual assertions into $saml array
             */
            if(isset($session[$samlName])) {
                $saml[$samlName] = file_get_contents($session[$samlName]);
            }
        }
    }
}

/* pretty printed SAML assertion(s)
 */
function printAssertions($saml) {
    foreach($saml as $key => $value) {
        $conf = array(
            "input-xml"         => true,
            "output-xml"        => true,
            "wrap"              => 60,
            "wrap-attributes"   => true,
            "indent"            => true,
            "indent-attributes" => true
        );
        $tidy = new tidy;
        $tidy->parseString($value, $conf);
        $tidy->cleanRepair();
        echo "<h3>$key</h3>\n";
        echo "<pre>" . htmlspecialchars($tidy) . "</pre>\n";
    }
}

/* pretty printed SAML assertion(s) for e-mail
 */
function sendAssertions($saml) {
    $xml = "";
    foreach($saml as $key => $value) {
        $conf = array(
            "input-xml"         => true,
            "output-xml"        => true,
            "wrap"              => 60,
            "wrap-attributes"   => true,
            "indent"            => true,
            "indent-attributes" => true
        );
        $tidy = new tidy;
        $tidy->parseString($value, $conf);
        $tidy->cleanRepair();
        $xml .= "$key:\n\n";
        $xml .= "$tidy\n\n";
    }
    return $xml;
}

/* printAttribute()
 */
function printAttribute($attr, $level) {
    if(isset($GLOBALS["attributes"][$attr])) {
        echo "<tr>";
        echo "<td class=\"" .$level. "\">";
        if(isset($GLOBALS["attribute"][$attr]["url-eduidcz"])) {
            echo "<a class=\"" .$level. "\" href=\"" .$GLOBALS["attribute"][$attr]["url-eduidcz"]. "\">";
            echo $GLOBALS["attribute"][$attr]["name"]. "</a> <span>" .$GLOBALS["attribute"][$attr]["saml2"]. "</span>";
        } else {
            echo $GLOBALS["attribute"][$attr]["name"]. " <span>" .$GLOBALS["attribute"][$attr]["saml2"]. "</span>";
        }
        echo "</td><td>";
        $part = explode(";", $GLOBALS["attributes"][$attr]);
        sort($part);
        $count = count($part);
        if($count > 1) {
            echo "<ul>";
            for($i=0; $i<$count; $i++) {
                echo "<li>" .$part[$i]. "</li>";
            }
            echo "</ul>";
        } else {
            echo $GLOBALS["attributes"][$attr];
        }
        echo "</td></tr>\n";
    }
}

/* printSessionAttribute()
 */
function printSessionAttribute($attr, $level) {
    echo "<tr>";
    echo "<td class=\"" .$level. "\">" .$attr. "</td>";
    echo "<td>" .$GLOBALS["session"][$attr]. "</td>";
    echo "</tr>\n";
}

/* printSessionAssertionURL()
 */
function printSessionAssertionURL($level) {
    $assertionNumber = $GLOBALS["session"]["Shib-Assertion-Count"];
    for($i=1; $i<=$assertionNumber; $i++) {
        $number = sprintf("%02d", $i);
        echo "<tr>";
        echo "<td class=\"" .$level. "\">" .sprintf("Shib-Assertion-%02d", $i). "</td>";
        echo "<td>" .htmlspecialchars($GLOBALS["session"]["Shib-Assertion-".$number]). "</td>";
        echo "</tr>\n";
    }
}

/* eduID.cz mandatory attributes
 */
function eduIDczAttributesMandatory() {
    if(isset($GLOBALS["attributes"]["eppn"]) &&
       isset($GLOBALS["attributes"]["affiliation"]) &&
       isset($GLOBALS["attributes"]["persistent-id"]) &&
       isset($GLOBALS["attributes"]["uniqueId"]) &&
       isset($GLOBALS["attributes"]["givenName"]) &&
       isset($GLOBALS["attributes"]["sn"]) &&
       isset($GLOBALS["attributes"]["cn"]) &&
       isset($GLOBALS["attributes"]["mail"]) &&
       isset($GLOBALS["attributes"]["unstructuredName"])) {
        return 1;
    } else {
        return 0;
    }
}

/* eduID.cz optional attributes
 */
function eduIDczAttributesOptional() {
    if(isset($GLOBALS["attributes"]["displayName"]) &&
       isset($GLOBALS["attributes"]["o"]) &&
       isset($GLOBALS["attributes"]["ou"]) &&
       isset($GLOBALS["attributes"]["entitlement"])) {
        return 1;
    } else {
        return 0;
    }
}

/* eduID.cz attributes (mandatory + optional)
 */
function eduIDczAttributes() {
    if(eduIDczAttributesMandatory()) {
        if(eduIDczAttributesOptional()) {
            return 1;
        } else {
            return 2;
        }
    } else {
        return 0;
    }
}

/* TCS mandatory attributes
 */
function tcsAttributesMandatory() {
    if(isset($GLOBALS["attributes"]["authMail"]) &&
       isset($GLOBALS["attributes"]["commonNameASCII"])) {
        return 1;
    } else {
        return 0;
    }
}

/* TCS optional attributes
 */
function tcsAttributesOptional() {
    if(isset($GLOBALS["attributes"]["telephoneNumber"])) {
        return 1;
    } else {
        return 0;
    }
}

/* TCS attributes (mandatory + optional)
 */
function tcsAttributes() {
    if(tcsAttributesMandatory()) {
        if(tcsAttributesOptional()) {
            return 1;
        } else {
            return 2;
        }
    } else {
            return 0;
    }
}

/* R&S attributes
 */
function rsAttributes() {
    if(isset($GLOBALS["attributes"]["displayName"]) &&
       isset($GLOBALS["attributes"]["eppn"]) &&
       isset($GLOBALS["attributes"]["affiliation"]) &&
       isset($GLOBALS["attributes"]["persistent-id"]) &&
       isset($GLOBALS["attributes"]["givenName"]) &&
       isset($GLOBALS["attributes"]["mail"]) &&
       isset($GLOBALS["attributes"]["sn"])) {
        return 1;
    } else {
        return 0;
    }
}

/* does the IdP supports R&S?
 */
function isRS() {
    $where = $GLOBALS["attributes"]["md_entityCategorySupport"];
    $what  = "http://refeds.org/category/research-and-scholarship";
    if(stripos($where, $what) === false) {
        return 0;
    } else {
        return 1;
    }
}

/* does the IdP supports SIRTFI?
 */
function isSIRTFI() {
    $where = $GLOBALS["attributes"]["md_assuranceCertification"];
    $what  = "https://refeds.org/sirtfi";
    if(stripos($where, $what) === false) {
        return 0;
    } else {
        return 1;
    }
}

/* print missing attribute
 */
function missingAttribute($attribute, $name, $class) {
    if(!isset($attribute)) {
        echo "<li>Atribut <a class=\"$class\" href=\"" .$GLOBALS["attribute"]["$name"]["url-eduidcz"]. "\">" . $GLOBALS["attribute"]["$name"]["name"] . "</a> není dostupný</li>\n";
    }
}

?>

