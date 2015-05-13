<?php namespace Library\Github;

use GuzzleHttp\Client;
use GuzzleHttp\Exception\RequestException;
use Library\Resources\Managers\Manager;

class GithubApi {


    public static function getDependencyName($fields)
    {
        $manager = Manager::find($fields['manager']);
        $name = explode('/', $fields['name']);
        $url = "http://raw.githubusercontent.com/{$name[0]}/{$name[1]}/master/";

        $client = new Client();
        $response = null;

        try{
            $response = $client->get($url . $manager->file);
        }
        catch (\ErrorException $e)
        {
            return ["error" => "The repository name is not valid"];
        }
        catch (RequestException $e)
        {
            return ["error" => "The repository does not exist"];
        }

        try{
            $json =  json_decode($response->getBody());
            return [
                "name" => $fields["name"],
                "manager_id" => $fields["manager"],
                "dependency_name" => $json->name
            ];
        }catch (\Exception $e) {
            return ["error" => "There isn't a name field in the {$manager->file}"];
        }
    }
} 