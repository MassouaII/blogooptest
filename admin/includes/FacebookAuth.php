<?php

//require_once ('vendor/autoload.php');
require_once $_SERVER['DOCUMENT_ROOT'] . '/newblogoopklas/vendor/autoload.php';
//$config = require_once 'config.php';

use League\OAuth2\Client\Provider\Facebook;



class FacebookAuth
{
    protected $provider; //This means that subclasses can access protected members, but code outside the class hierarchy cannot.  private can only be accessed within the class in which it is defined.

    public function __construct()
    {
        //global $config;
        require_once 'config.php';
        $this->provider = new Facebook([
            'clientId' => FACEBOOK_APP_ID,
            'clientSecret' => FACEBOOK_APP_SECRET,
            'redirectUri' => FACEBOOK_REDIRECT_URI,
            'graphApiVersion' => 'v19.0',
        ]);
    }


    public function getAuthorizationUrl(): string
    {
        return $this->provider->getAuthorizationUrl([
            'scope' => ['email']
        ]);
    }

    public function getAccessToken($code): \League\OAuth2\Client\Token\AccessTokenInterface{
        try{
            return $this->provider->getAccessToken('authorization_code', ['code' => $code,]);
        }catch
        (\League\OAuth2\Client\Provider\Exception\IdentityProviderException $e) {
            // Handle the exception (e.g., log error, return null, etc.)
            // Example: log the error
            error_log('Error getting access token: ' . $e->getMessage());
            throw new \Exception('Failed to obtain access token', 0, $e);
        }
    }
    public function getUserDetails($accessToken): array
    {
        try {
            $resourceOwner = $this->provider->getResourceOwner($accessToken);
            return $resourceOwner->toArray();
        } catch
        (\Exception $e) {
            // Handle error fetching user details
            throw new \Exception('Failed to fetch user details: ' . $e->getMessage());
        }
    }
}

?>
