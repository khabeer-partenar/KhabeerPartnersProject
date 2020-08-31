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
        'x509cert' => env('SAML2_'.$this_idp_env_id.'_SP_x509','MIICvzCCAacCAQAwejELMAkGA1UEBhMCU0ExCzAJBgNVBAgMAlJZMQswCQYDVQQH
DAJSWTEMMAoGA1UECgwDQk9FMQwwCgYDVQQLDANCT0UxETAPBgNVBAMMCDI1Mjc1
NTIwMSIwIAYJKoZIhvcNAQkBFhNlc2VydmljZXNAbXUuZWR1LnNhMIIBIjANBgkq
hkiG9w0BAQEFAAOCAQ8AMIIBCgKCAQEAxW0kH78ylsCkKiTJKIQdG1ny7XW+Sl5p
hPRjCRRDEYtf85VDwB/nEY8ynio4RyyZnISkG1tjfM3AkZLbT/xn/pKgkBqyIJ27
6qwNZkEROUqFrHKjtzQAMhYVSsvxt+XBWnODi1+gfoRAP6AazvXgTIEM8qN1oEYM
spcO6tHMTm2G/1rm0PCXsh4kasvnxcTPnfMOX0hRWJSuUHRMTfkZO3G9y0MG4+2B
45tSCZDNTX37c045qYRl4FkeIbp5QkZ9hFS4X67R6H7IlhnqeQWpsDqv29Xo/QZh
6cNfNN/9YuIDLJew8QLZd7Yd8NTFzZra0uU5j+FJPOyZ5DgWAqXALQIDAQABoAAw
DQYJKoZIhvcNAQELBQADggEBACQ5MtejwpVnBcRzRUVeJAjKEcXskitfRtAps38T
0CRrFyU2n7cx1EUBmEif+ApQeTkRrqLdZDiFyRzHr3z6PrOUhXwLjJ6x3RZRq+Wi
bWFxqX5AAnd/JBBHGGTcj4FdgsnoEsDFQG1j9GBl/5JeD0bcjemIryQJyIszM8dk
BfBu7wiG2iV8BjQrRgrfIpQC+56uQScVFYX24/fI+y4u4T6rCGBC1myuw1gDJKVz
/ImEVP/JmXL/6n6tnled/dQnuYEVVgJovrMQJpVtx5cIUnmBTve3zlQOuY4E5EcO
O0HZJ/CBhstWzCcrd1sgogPlWtGlD1QBzZEAMFlU1kzfi5k='),
        'privateKey' => env('SAML2_'.$this_idp_env_id.'_SP_PRIVATEKEY','MIIEvwIBADANBgkqhkiG9w0BAQEFAASCBKkwggSlAgEAAoIBAQDFbSQfvzKWwKQq
JMkohB0bWfLtdb5KXmmE9GMJFEMRi1/zlUPAH+cRjzKeKjhHLJmchKQbW2N8zcCR
kttP/Gf+kqCQGrIgnbvqrA1mQRE5SoWscqO3NAAyFhVKy/G35cFac4OLX6B+hEA/
oBrO9eBMgQzyo3WgRgyylw7q0cxObYb/WubQ8JeyHiRqy+fFxM+d8w5fSFFYlK5Q
dExN+Rk7cb3LQwbj7YHjm1IJkM1NfftzTjmphGXgWR4hunlCRn2EVLhfrtHofsiW
Gep5BamwOq/b1ej9BmHpw1803/1i4gMsl7DxAtl3th3w1MXNmtrS5TmP4Uk87Jnk
OBYCpcAtAgMBAAECggEBAI74bsSezZ/mefwbD6HLqth31zinn9pzbK7f3ChjB/7Y
k+/uFFY5xDgvH1Ty9jZ00flLBRzanb1vsxi45SGThCwTOzugWYbNM5zKZBm83SBE
G3G6w1yUx999poW4E6A9PjymkoiIA84bL/vjkgZ2gKxmeF3uiew7Tk62nhLnQ7E2
0UqjcOgGzuqm9+jt5wJ5ikdFoS35aWtd8HGdUUojw2o6K2oIgIDuoF8k6sMAVst0
B2c8ySukqrNYfUsiWdLJ0QFM9LCWhHWeWir3sRPzvWajdoLVtdatNdP8JOIYT1x+
gdFOOTiUOl2SJfJR6iYLkDVE/Jyv5adzMeqr814MjHECgYEA9Sndips3KJhWvzT9
5ia1eSUohTDRdwpzYljbK6JKLjGYcu9QuAw91CAYryeUKxxMQSjKeOwcb3O8E27r
b3fIxNZr3jNpCgfPOM/nh81Gp1YWDjfIvSPBIYKJrGCQQ6qkPGiLa7xh7Pk2BC4U
3sbjv72DyoCvfl8ihrsGDGaRLKcCgYEAzicbpQgtxx+Hjz2rkj5f5hPm5+yUHPiV
nUSoifF0X7YJ8AXZAdRu1e3FVtPcADjGF0Qrl0SzHvczbGsijdSRri0yobM2rAAr
8uM041S0MTldSLEgFwEP2Ry2bNMTPWpoCA5Vh23RpfPI/LeCXW+WV1dJ/fhdQW4r
+sqeFFgCIwsCgYEA69OOsOKnh1wqrZjK1tXLYLIWrTANfYXHAgZZJTriQlcgvwZn
TfMwklkhhXL7+xAoZdFYGkN9AtSASO08eafurzFW55Hqa2Sht5N9sssKOLL9WkXc
yduXzqUjy3XDr+N4QkeKPWMji3EZvaGaH8WPlIQ3PtbUeSoIKzPCGLGc2icCgYA8
hKCJ7v+5T9k0xK7kTKlMWpVTilDkvFj3hRtQ+2/lVQRP0PemoN00sgtXdPRFoGUO
mXWOf51xvrH65uyK5Fcr4ZrWe0zWa2p7cBWrkscfGC75Uv4PosErRFGNWt1wDxeh
Hcwf6K494HYlMh30HfjthPN0uf9uYNBKXEbRxBBEhwKBgQDn/uq3fpIDkbeld1/Q
bFN88tUMmOZVy0fuQj+L/2A9cHEdZegIMO595AGBlJVHBaOPsgUHMAvSimwhg/EU
eY2/deI/c7H3CAZK1Y7yPqZgWhYgGk/IZO+33C0NSn+jPSY04X74RrhkattiuE6s
DAcwtdOu8yro2tmtPpbyODHa8g=='),

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
        'x509cert' => env('SAML2_'.$this_idp_env_id.'_IDP_x509', 'MIIEejCCA2KgAwIBAgIEVPP7JzANBgkqhkiG9w0BAQsFADBPMQswCQYDVQQGEwJz
YTEMMAoGA1UEChMDbW9pMQwwCgYDVQQLEwNuaWMxDjAMBgNVBAsTBWluZnJhMRQw
EgYDVQQDEwtpbmZyYSBjYSB2MjAeFw0yMDA4MjQwNTAyMzJaFw0yMjA4MjQwNTMy
MzJaMGIxCzAJBgNVBAYTAnNhMQwwCgYDVQQKEwNtb2kxDDAKBgNVBAsTA25pYzEO
MAwGA1UECxMFaW5mcmExDzANBgNVBAsTBnNlcnZlcjEWMBQGA1UEAxMNa3AuYm9l
Lmdvdi5zYTCCASIwDQYJKoZIhvcNAQEBBQADggEPADCCAQoCggEBAMVtJB+/MpbA
pCokySiEHRtZ8u11vkpeaYT0YwkUQxGLX/OVQ8Af5xGPMp4qOEcsmZyEpBtbY3zN
wJGS20/8Z/6SoJAasiCdu+qsDWZBETlKhaxyo7c0ADIWFUrL8bflwVpzg4tfoH6E
QD+gGs714EyBDPKjdaBGDLKXDurRzE5thv9a5tDwl7IeJGrL58XEz53zDl9IUViU
rlB0TE35GTtxvctDBuPtgeObUgmQzU19+3NOOamEZeBZHiG6eUJGfYRUuF+u0eh+
yJYZ6nkFqbA6r9vV6P0GYenDXzTf/WLiAyyXsPEC2Xe2HfDUxc2a2tLlOY/hSTzs
meQ4FgKlwC0CAwEAAaOCAUkwggFFMAsGA1UdDwQEAwIFoDAdBgNVHSUEFjAUBggr
BgEFBQcDAQYIKwYBBQUHAwIwEQYJYIZIAYb4QgEBBAQDAgZAMHEGA1UdHwRqMGgw
ZqBkoGKkYDBeMQswCQYDVQQGEwJzYTEMMAoGA1UEChMDbW9pMQwwCgYDVQQLEwNu
aWMxDjAMBgNVBAsTBWluZnJhMRQwEgYDVQQDEwtpbmZyYSBjYSB2MjENMAsGA1UE
AxMEQ1JMMjArBgNVHRAEJDAigA8yMDIwMDgyNDA1MDIzMlqBDzIwMjIwMTE3MDUz
MjMyWjAfBgNVHSMEGDAWgBR5Yj4i+5gh1oPH/gZDoweDT7P2/TAdBgNVHQ4EFgQU
1O7zbn2f7VCMnVKN5ss8coPeWQgwCQYDVR0TBAIwADAZBgkqhkiG9n0HQQAEDDAK
GwRWOC4xAwIDqDANBgkqhkiG9w0BAQsFAAOCAQEAWAoCZ97M1bvb9kIXb0wA8cN2
8ihroGi+HOie6v+LCuVUbr1cLLGHF50xTyON4GFuKWSqMUdC+2RpSk/znQtK/ev8
xf2pqWF7P+GCQCIawyYBa+eMT9f6hZXKJG2xFHfuwpu1lSP6BefftSSLraZkkOu9
xm9IclQAEFIOZBTqloUS6bor/T1P8uFfL3xmDUbaa995ESC1h+1KG5wgGyVjQ1Ni
czmoqwmvSNechqsYex3iNWV6BY78HC2gx79+T9rp01VIcBh4UeFfM5A2YGOnwA7u
JWEjv4WoFplorTrFz3N0ucNbG7YQGzxhsfDKDzF8jQsqsP+mNzjjvCFEGsUKyg=='),
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
