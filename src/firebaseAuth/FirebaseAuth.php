<?php 
namespace FirebaseAuth;

use GuzzleHttp\Client;
//update class
class FirebaseAuth
{
    private static $baseUrl = 'https://identitytoolkit.googleapis.com/v1/';
    private static $apiKey;


    public static function initialize($apiKey)
    {
        self::$apiKey = $apiKey;
    }

    private static function getClient()
    {
        return new Client();
    }

    public static function register($email, $password)
    {
        $client = self::getClient();
        $response = $client->post(self::$baseUrl . 'accounts:signUp?key=' . self::$apiKey, [
            'json' => [
                'email' => $email,
                'password' => $password,
                // Add other parameters as needed
            ],
        ]);

        return json_decode($response->getBody(), true);
    }

    

    

    
}