<?php 
namespace FirebaseAuth;

use GuzzleHttp\Client;
use GuzzleHttp\Exception\RequestException;
use GuzzleHttp\Exception\ConnectException;



class FirebaseAuth
{
    
    private static $baseUrl;
    private static $authToken;
   
    
    public static function initialize($authToken)
    {
        self::$authToken = $authToken;
        self::$baseUrl = env('NODE_DOMAIN','http://localhost');
    }

    private static function getClient()
    {
        return new Client();
    }

    public static function register($display_name, $email)
    {
        $client = self::getClient();
        $signUpApiUrl = self::$baseUrl .'registration';
        try{
            $response = $client->post($signUpApiUrl, [
                'headers' => [
                    'authorization' => self::$authToken,
                ],
                'json' => [
                    'email' => $email,
                    'displayName' => $display_name,
                ]
            ]);
            return json_decode($response->getBody(), true);

        }catch (RequestException $e) {
            if ($e->hasResponse()) {
                $response = $e->getResponse();
                $statusCode = $response->getStatusCode();
                return json_decode($response->getBody(), true);
            }else{
                return json_decode(json_encode(["message"=> $e->getMessage(),"status_code"=> $e->getCode()]), true);
            }
        }catch (ConnectException $e) {
           return json_decode(json_encode(["message"=> "Service not available","status_code"=> 503]), true);
        }catch(\Exception $e){
            return json_decode(json_encode(["message"=> $e->getMessage(),"status_code"=> $e->getCode()]), true);
        }
        
    }

    

    

    
}