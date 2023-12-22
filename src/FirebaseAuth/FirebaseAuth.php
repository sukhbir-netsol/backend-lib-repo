<?php 

/**
 * Firebase library to connect on firebase via node as middle layer with apis
 * @author sukhbir singh <https://github.com/sukhbir-netsol>
 */
namespace FirebaseAuth;

use GuzzleHttp\Client;
use GuzzleHttp\Exception\RequestException;
use GuzzleHttp\Exception\ConnectException;

class FirebaseAuth
{
    /**
     * @var string
     */
    private static $baseUrl;
    private static $authToken;
   

    /**
      * @param string $authtoken
     * @return void
    */
    public static function initialize($authToken):void
    {
        self::$authToken = $authToken;
        self::$baseUrl = getenv('SUPPLIER_NODE_SITE_URL','http://localhost');
    }


    /**
     * @return object
    */
    private static function getClient():object 
    {
        return new Client();
    }


    /**
     * Register user on firebase and return respected response in an array
     * @param string $display_name,$email
     * @return array
     * 
    */
    public static function register($display_name, $email):array
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
                ],
                
            ]);

            $returnBody = json_decode($response->getBody(), true);
            $userData = $returnBody['data'] ?? [];
            $returnOutput=  json_decode(json_encode(["message"=> $returnBody['message'],"userData"=>$userData,"statusCode"=> $response->getStatusCode()]), true);
            

        }catch (RequestException $e) {
            //Caught request related exception
            if ($e->hasResponse()) {
                $response = $e->getResponse();
                $returnBody = json_decode($response->getBody(), true);
                $returnOutput= json_decode(json_encode(["message"=> $returnBody['message'],"statusCode"=> $e->getCode()]), true);
            }else{
                $returnOutput= json_decode(json_encode(["message"=> $e->getMessage(),"statusCode"=> $e->getCode()]), true);
            }
        }catch (ConnectException $e) {
            //Caught connection specific exception/error
            $returnOutput= json_decode(json_encode(["message"=> "Service not available","statusCode"=> 503]), true);
        }catch(\Exception $e){
             //Caught any type of exception/error
            $returnOutput= json_decode(json_encode(["message"=> $e->getMessage(),"statusCode"=> $e->getCode()]), true);
        }
        return $returnOutput;
        
        
    }

    

    

    
}
