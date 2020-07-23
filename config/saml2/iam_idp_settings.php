<?php

// If you choose to use ENV vars to define these values, give this IdP its own env var names
// so you can define different values for each IdP, all starting with 'SAML2_'.$this_idp_env_id
$this_idp_env_id = 'IAM';

//This is variable is for simplesaml example only.
// For real IdP, you must set the url values in the 'idp' config to conform to the IdP's real urls.
$idp_host = env('SAML2_'.$this_idp_env_id.'_IDP_HOST', '');
return $settings = array(

    /*****
     * One Login Settings
     */

    // If 'strict' is True, then the PHP Toolkit will reject unsigned
    // or unencrypted messages if it expects them signed or encrypted
    // Also will reject the messages if not strictly follow the SAML
    // standard: Destination, NameId, Conditions ... are validated too.
    'strict' => true, //@todo: make this depend on laravel config

    // Enable debug mode (to print errors)
    'debug' => env('APP_DEBUG', true),

    // Service Provider Data that we are deploying
    'sp' => array(

        // Specifies constraints on the name identifier to be used to
        // represent the requested subject.
        // Take a look on lib/Saml2/Constants.php to see the NameIdFormat supported
        'NameIDFormat' => 'urn:oasis:names:tc:SAML:2.0:nameid-format:entity',
        // Usually x509cert and privateKey of the SP are provided by files placed at
        // the certs folder. But we can also provide them with the following parameters
        'x509cert' => env('SAML2_'.$this_idp_env_id.'_SP_x509',''),
        'privateKey' => env('SAML2_'.$this_idp_env_id.'_SP_PRIVATEKEY',''),

        // Identifier (URI) of the SP entity.
        // Leave blank to use the '{idpName}_metadata' route, e.g. 'test_metadata'.
        'entityId' => 'https://kp.boe.gov.sa',

        // Specifies info about where and how the <AuthnResponse> message MUST be
        // returned to the requester, in this case our SP.
        'assertionConsumerService' => array(
            // URL Location where the <Response> from the IdP will be returned,
            // using HTTP-POST binding.
            // Leave blank to use the '{idpName}_acs' route, e.g. 'test_acs'
            'url' => '',
        ),
        // Specifies info about where and how the <Logout Response> message MUST be
        // returned to the requester, in this case our SP.
        // Remove this part to not include any URL Location in the metadata.
        'singleLogoutService' => array(
            // URL Location where the <Response> from the IdP will be returned,
            // using HTTP-Redirect binding.
            // Leave blank to use the '{idpName}_sls' route, e.g. 'test_sls'
            'url' => '',
        ),
    ),

    // Identity Provider Data that we want connect with our SP
    'idp' => array(
        // Identifier of the IdP entity  (must be a URI)
        'entityId' => env('SAML2_'.$this_idp_env_id.'_IDP_SSO_URL', ''),

        // SSO endpoint info of the IdP. (Authentication Request protocol)
        'singleSignOnService' => array(
            // URL Target of the IdP where the SP will send the Authentication Request Message,
            // using HTTP-Redirect binding.
            'url' => env('SAML2_'.$this_idp_env_id.'_IDP_SSO_URL', ''),
        ),
        // SLO endpoint info of the IdP.
        'singleLogoutService' => array(
            // URL Location of the IdP where the SP will send the SLO Request,
            // using HTTP-Redirect binding.
            'url' => env('SAML2_'.$this_idp_env_id.'_IDP_SL_URL',''),
        ),
        // Public x509 certificate of the IdP
        'x509cert' => env('SAML2_'.$this_idp_env_id.'_IDP_x509', 'MIIESzCCAzOgAwIBAgIEVGvomzANBgkqhkiG9w0BAQsFADBSMQswCQYDVQQGEwJz
YTEMMAoGA1UEChMDbW9pMQwwCgYDVQQLEwNuaWMxDjAMBgNVBAsTBWluZnJhMRcw
FQYDVQQDEw5JbmZyYSBDQSBWMiBQUDAeFw0yMDA2MjEwODEyMzZaFw0yMzA2MjEw
ODQyMzZaMF8xCzAJBgNVBAYTAnNhMQwwCgYDVQQKEwNtb2kxDDAKBgNVBAsTA25p
YzEOMAwGA1UECxMFaW5mcmExDzANBgNVBAsTBnNlcnZlcjETMBEGA1UEAxMKaWFt
Lmdvdi5zYTCCASIwDQYJKoZIhvcNAQEBBQADggEPADCCAQoCggEBALOAtLfGvGHC
THOcLGIPEZmy9jY4bfJhx1RyomKZPn+vUh1e8SoDnYJbnJ2sQolStFtI7FK0Si8r
LzweNGHKJFBs4q+uh/dMmn2dLOXrpCxLEss3RqFjX+j7tFeEFgYj7Ygxf3TpFFr5
SAXL9H4QB0CShbPH/oMNSDheXRg3wGFx5UkKCqV/w31+KUjRmCG6rItU/jMEJqPc
C73C4iw8UeF/60OKrIGlQddv3e7h3B3d1QK5AQjVDQPe9ZdyWkMgEqbBQURnIFkM
mD+YhWWoLg6rSX+78S4KpYDFCKbpH0FY89M1YY6dFGBSrLpjSfyrCUXgelZn7tjr
jYyenC8W/5MCAwEAAaOCARowggEWMAsGA1UdDwQEAwIHgDB0BgNVHR8EbTBrMGmg
Z6BlpGMwYTELMAkGA1UEBhMCc2ExDDAKBgNVBAoTA21vaTEMMAoGA1UECxMDbmlj
MQ4wDAYDVQQLEwVpbmZyYTEXMBUGA1UEAxMOSW5mcmEgQ0EgVjIgUFAxDTALBgNV
BAMTBENSTDEwKwYDVR0QBCQwIoAPMjAyMDA2MjEwODEyMzZagQ8yMDIyMDcyNzIw
NDIzNlowHwYDVR0jBBgwFoAUZYqvso+WtZ6o3CNQ03tsT50HNCQwHQYDVR0OBBYE
FOXkuCM/sMmFpHuicJAf9eykvT8NMAkGA1UdEwQCMAAwGQYJKoZIhvZ9B0EABAww
ChsEVjguMQMCBLAwDQYJKoZIhvcNAQELBQADggEBAK8S/nCQOwBtDXnsohNqgpT1
tvdgBAFw0BMhbMU/o3I+LnEUfd7yhsFQjG6xC8bdJZb+hFA5T1jiBSBE4r6DAizn
R3ogmqd5BldUm6P8wIZhf8kKkjbN/It0I5K1S08dur+y8XfRrG+jZ8GSyop786qq
zEZ5Ny3jSoE3TijotzDsaX6fEnfh0lXQUSGOR2fUj/go5KTB1G4POLO+JYIkuII1
qaJcvK2bH1Czbwv422K7t0FjEdmDjTNiJ2lzFefydcdBCIDyFCfCZWho8QAHlU9S
tlGGTPxoVaqP9ygo4nls6z0GlRt5PvBozEzubZTEz0BAETh1N02EnpYZE5P+6mM='),
        /*
         *  Instead of use the whole x509cert you can use a fingerprint
         *  (openssl x509 -noout -fingerprint -in "idp.crt" to generate it)
         */
        // 'certFingerprint' => '',
    ),
    /***
     *
     *  OneLogin advanced settings
     *
     *
     */
    // Security settings
    'security' => array(

        /** signatures and encryptions offered */

        // Indicates that the nameID of the <samlp:logoutRequest> sent by this SP
        // will be encrypted.
        'nameIdEncrypted' => false,

        // Indicates whether the <samlp:AuthnRequest> messages sent by this SP
        // will be signed.              [The Metadata of the SP will offer this info]
        'authnRequestsSigned' => true,

        // Indicates whether the <samlp:logoutRequest> messages sent by this SP
        // will be signed.
        'logoutRequestSigned' => true,

        // Indicates whether the <samlp:logoutResponse> messages sent by this SP
        // will be signed.
        'logoutResponseSigned' => true,

        /* Sign the Metadata
         False || True (use sp certs) || array (
                                                    keyFileName => 'metadata.key',
                                                    certFileName => 'metadata.crt'
                                                )
        */
        'signMetadata' => true,


        /** signatures and encryptions required **/

        // Indicates a requirement for the <samlp:Response>, <samlp:LogoutRequest> and
        // <samlp:LogoutResponse> elements received by this SP to be signed.
        'wantMessagesSigned' => true,

        // Indicates a requirement for the <saml:Assertion> elements received by
        // this SP to be signed.        [The Metadata of the SP will offer this info]
        'wantAssertionsSigned' => true,

        // Indicates a requirement for the NameID received by
        // this SP to be encrypted.
        'wantNameIdEncrypted' => false,

        // Authentication context.
        // Set to false and no AuthContext will be sent in the AuthNRequest,
        // Set true or don't present thi parameter and you will get an AuthContext 'exact' 'urn:oasis:names:tc:SAML:2.0:ac:classes:PasswordProtectedTransport'
        // Set an array with the possible auth context values: array ('urn:oasis:names:tc:SAML:2.0:ac:classes:Password', 'urn:oasis:names:tc:SAML:2.0:ac:classes:X509'),
        'requestedAuthnContext' => true,
    ),

    // Contact information template, it is recommended to suply a technical and support contacts
    'contactPerson' => array(
        'technical' => array(
            'givenName' => 'technical',
            'emailAddress' => env('Mail_SUPPORT_email')
        ),
        'support' => array(
            'givenName' => 'Support',
            'emailAddress' => env('Mail_SUPPORT_email')
        ),
    ),

    // Organization information template, the info in en_US lang is recomended, add more if required
    'organization' => array(
        'en-US' => array(
            'name' => 'khabeer',
            'displayname' => 'Support',
            'url' => 'https://kp.boe.org.sa/'
        ),
    ),

    /* Interoperable SAML 2.0 Web Browser SSO Profile [saml2int]   http://saml2int.org/profile/current

       'authnRequestsSigned' => false,    // SP SHOULD NOT sign the <samlp:AuthnRequest>,
                                          // MUST NOT assume that the IdP validates the sign
       'wantAssertionsSigned' => true,
       'wantAssertionsEncrypted' => true, // MUST be enabled if SSL/HTTPs is disabled
       'wantNameIdEncrypted' => false,
    */

);
