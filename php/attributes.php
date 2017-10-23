<?php

/* Ordered list of defined saml attributes.
 *
 * They must be defined in Shibboleth's attribute-map.xml (/etc/shibboleth/ by
 * default) as well and their names (`id' attributes' values) must match those
 * in $attribute here, i.e. <Attribute name="urn:oid:1.3.6.1.4.1.5923.1.1.1.6"
 * id="eppn"> and $attribute["eppn"].
 */
$attribute = array(

    'affiliation'                   => array(
        'name'                      => 'eduPersonScopedAffiliation',
        'saml2'                     => 'urn:oid:1.3.6.1.4.1.5923.1.1.1.9',
        'url-eduidcz'               => 'https://www.eduid.cz/cs/tech/attributes/edupersonscopedaffiliation',
    ),

    'authMail'                      => array(
        'name'                      => 'authMail',
        'saml2'                     => 'urn:oid:1.2.840.113549.1.9.1',
        'url-eduidcz'               => 'https://www.eduid.cz/cs/tech/attributes/authmail',
    ),

    'authorisedMail'                => array(
        'name'                      => 'authorisedMail',
        'saml2'                     => 'https://whoami.cesnet.cz/attribute-def/authorisedMail',
    ),

    'cesnetEmplID'                  => array(
        'name'                      => 'cesnetEmplID',
        'saml2'                     => 'https://whoami.cesnet.cz/attribute-def/cesnetEmplID',
    ),

    'cn'                            => array(
        'name'                      => 'cn',
        'saml2'                     => 'urn:oid:2.5.4.3',
        'url-eduidcz'               => 'https://www.eduid.cz/cs/tech/attributes/cn',
    ),

    'commonNameASCII'               => array(
        'name'                      => 'commonNameASCII',
        'saml2'                     => 'http://eduid.cz/attributes/commonName#ASCII',
        'url-eduidcz'               => 'https://www.eduid.cz/cs/tech/attributes/commonnameascii',
    ),

    'displayName'                   => array(
        'name'                      => 'displayName',
        'saml2'                     => 'urn:oid:2.16.840.1.113730.3.1.241',
        'url-eduidcz'               => 'https://www.eduid.cz/cs/tech/attributes/displayname',
    ),

    'eduroamUID'                    => array(
        'name'                      => 'eduroamUID',
        'saml2'                     => 'http://eduroam.cz/attributes/eduroamUID',
    ),

    'entitlement'                   => array(
        'name'                      => 'eduPersonEntitlement',
        'saml2'                     => 'urn:oid:1.3.6.1.4.1.5923.1.1.1.7',
        'url-eduidcz'               => 'https://www.eduid.cz/cs/tech/attributes/edupersonentitlement',
    ),

    'eppn'                          => array(
        'name'                      => 'eduPersonPrincipalName',
        'saml2'                     => 'urn:oid:1.3.6.1.4.1.5923.1.1.1.6',
        'url-eduidcz'               => 'https://www.eduid.cz/cs/tech/attributes/edupersonprincipalname',
    ),

    'givenName'                     => array(
        'name'                      => 'givenName',
        'saml2'                     => 'urn:oid:2.5.4.42',
        'url-eduidcz'               => 'https://www.eduid.cz/cs/tech/attributes/givenname',
    ),

    'headDegree'                    => array(
        'name'                      => 'headDegree',
        'saml2'                     => 'https://whoami.cesnet.cz/attribute-def/headDegree',
    ),

    'loa'                           => array(
        'name'                      => 'LoA',
        'saml2'                     => 'urn:oid:1.3.6.1.4.1.8057.2.1',
    ),

    'mail'                          => array(
        'name'                      => 'mail',
        'saml2'                     => 'urn:oid:0.9.2342.19200300.100.1.3',
        'url-eduidcz'               => 'https://www.eduid.cz/cs/tech/attributes/mail',
    ),

    'md_assuranceCertification'     => array(
        'name'                      => 'AssuranceCertification',
        'saml2'                     => 'urn:oasis:names:tc:SAML:attribute:assurance-certification',
        'url-eduidcz'               => 'https://www.eduid.cz/cs/tech/categories',
    ),

    'md_entityCategory'             => array(
        'name'                      => 'EntityCategory',
        'saml2'                     => 'http://macedir.org/entity-category',
        'url-eduidcz'               => 'https://www.eduid.cz/cs/tech/categories',
    ),

    'md_entityCategorySupport'      => array(
        'name'                      => 'EntityCategorySupport',
        'saml2'                     => 'http://macedir.org/entity-category-support',
        'url-eduidcz'               => 'https://www.eduid.cz/cs/tech/categories',
    ),

    'o'                             => array(
        'name'                      => 'o',
        'saml2'                     => 'urn:oid:2.5.4.10',
        'url-eduidcz'               => 'https://www.eduid.cz/cs/tech/attributes/o',
    ),

    'ou'                            => array(
        'name'                      => 'ou',
        'saml2'                     => 'urn:oid:2.5.4.11',
        'url-eduidcz'               => 'https://www.eduid.cz/cs/tech/attributes/ou',
    ),

    'persistent-id'                 => array(
        'name'                      => 'eduPersonTargetedID',
        'saml2'                     => 'urn:oid:1.3.6.1.4.1.5923.1.1.1.10',
        'url-eduidcz'               => 'https://www.eduid.cz/cs/tech/attributes/edupersontargetedid',
    ),

    'perunEntryStatus'              => array(
        'name'                      => 'perunEntryStatus',
        'saml2'                     => 'https://aa.cesnet.cz/attribute-def/perunEntryStatus',
    ),

    'perunGroupDn'                  => array(
        'name'                      => 'perunGroupDn',
        'saml2'                     => 'https://aa.cesnet.cz/attribute-def/perunGroupDn',
    ),

    'perunGroupId'                  => array(
        'name'                      => 'perunGroupId',
        'saml2'                     => 'https://aa.cesnet.cz/attribute-def/perunGroupId',
    ),

    'perunGroupName'                => array(
        'name'                      => 'perunGroupName',
        'saml2'                     => 'https://aa.cesnet.cz/attribute-def/perunGroupName',
    ),

    'perunOrganizationName'         => array(
        'name'                      => 'perunOrganizationName',
        'saml2'                     => 'https://aa.cesnet.cz/attribute-def/perunOrganizationName',
    ),

    'perunPreferredMail'            => array(
        'name'                      => 'perunPreferredMail',
        'saml2'                     => 'https://aa.cesnet.cz/attribute-def/perunPreferredMail',
    ),

    'perunPrincipalName'            => array(
        'name'                      => 'perunPrincipalName',
        'saml2'                     => 'https://aa.cesnet.cz/attribute-def/perunPrincipalName',
    ),

    'perunUniqueGroupName'          => array(
        'name'                      => 'perunUniqueGroupName',
        'saml2'                     => 'https://aa.cesnet.cz/attribute-def/perunUniqueGroupName',
    ),

    'perunUserId'                   => array(
        'name'                      => 'perunUserId',
        'saml2'                     => 'https://aa.cesnet.cz/attribute-def/perunUserId',
    ),

    'perunVoId'                     => array(
        'name'                      => 'perunVoId',
        'saml2'                     => 'https://aa.cesnet.cz/attribute-def/perunVoId',
    ),

    'perunVoName'                   => array(
        'name'                      => 'perunVoName',
        'saml2'                     => 'https://aa.cesnet.cz/attribute-def/perunVoName',
    ),

    'schacHomeOrganization'         => array(
        'name'                      => 'schacHomeOrganization',
        'saml2'                     => 'urn:oid:1.3.6.1.4.1.25178.1.2.9',
    ),

    'Shib-Application-ID'           => array(
        'name'                      => 'Shib-Application-ID',
        'saml2'                     => '',
    ),

    'Shib-Assertion-Count'          => array(
        'name'                      => 'Shib-Assertion-Count',
        'saml2'                     => '',
    ),

    'Shib-Authentication-Instant'   => array(
        'name'                      => 'Shib-Authentication-Instant',
        'saml2'                     => '',
    ),

    'Shib-Authentication-Method'    => array(
        'name'                      => 'Shib-Authentication-Method',
        'saml2'                     => '',
    ),

    'Shib-AuthnContext-Class'       => array(
        'name'                      => 'Shib-AuthnContext-Class',
        'saml2'                     => '',
    ),

    'Shib-Identity-Provider'        => array(
        'name'                      => 'Shib-Identity-Provider',
        'saml2'                     => '',
    ),

    'Shib-Session-ID'               => array(
        'name'                      => 'Shib-Session-ID',
        'saml2'                     => '',
    ),

    'Shib-Session-Index'            => array(
        'name'                      => 'Shib-Session-Index',
        'saml2'                     => '',
    ),

    'sn'                            => array(
        'name'                      => 'sn',
        'saml2'                     => 'urn:oid:2.5.4.4',
        'url-eduidcz'               => 'https://www.eduid.cz/cs/tech/attributes/sn',
    ),

    'tailDegree'                    => array(
        'name'                      => 'tailDegree',
        'saml2'                     => 'https://whoami.cesnet.cz/attribute-def/tailDegree',
    ),

    'tcsPersonalID'                 => array(
        'name'                      => 'tcsPersonalID',
        'saml2'                     => 'https://whoami.cesnet.cz/attribute-def/tcsPersonalID',
    ),

    'telephoneNumber'               => array(
        'name'                      => 'telephoneNumber',
        'saml2'                     => 'urn:oid:2.5.4.20',
        'url-eduidcz'               => 'https://www.eduid.cz/cs/tech/attributes/telephonenumber',
    ),

    'uid'                           => array(
        'name'                      => 'uid',
        'saml2'                     => 'urn:oid:0.9.2342.19200300.100.1.1',
    ),

    'uniqueId'                      => array(
        'name'                      => 'eduPersonUniqueId',
        'saml2'                     => 'urn:oid:1.3.6.1.4.1.5923.1.1.1.13',
        'url-eduidcz'               => 'https://www.eduid.cz/cs/tech/attributes/edupersonuniqueid',
    ),

    'unscoped-affiliation'          => array(
        'name'                      => 'eduPersonAffiliation',
        'saml2'                     => 'urn:oid:1.3.6.1.4.1.5923.1.1.1.1',
        'url-eduidcz'               => 'https://www.eduid.cz/cs/tech/attributes/edupersonaffiliation',
    ),

    'unstructuredName'              => array(
        'name'                      => 'unstructuredName',
        'saml2'                     => 'urn:oid:1.2.840.113549.1.9.2',
        'url-eduidcz'               => 'https://www.eduid.cz/cs/tech/attributes/unstructuredname',
    ),

);

?>

