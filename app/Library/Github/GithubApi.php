<?php namespace Library\Github;

use GuzzleHttp\Client;
use GuzzleHttp\Exception\RequestException;

class GithubApi {


    public static function getBowerName($repository)
    {
        $name = explode('/', $repository);
        $client = new Client();
        $response = null;
        try{
            $response = $client->get("http://raw.githubusercontent.com/{$name[0]}/{$name[1]}/master/package.json");
        }catch (RequestException $e){
            try{
                $response = $client->get("http://raw.githubusercontent.com/{$name[0]}/{$name[1]}/master/bower.json");
            }catch (RequestException $e) {

            }
        }

        $json =  json_decode($response->getBody());
        return $json->name;
    }
} 