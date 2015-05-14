<?php namespace Library\Github;

use GuzzleHttp\Client;
use GuzzleHttp\Exception\RequestException;
use Library\Resources\Managers\Manager;

class GithubApi {


    public static function getDependencyName($fields)
    {
        $response = null;
        $manager = Manager::find($fields['manager']);
        $name = explode('/', $fields['name']);

        try {
            $url = "http://raw.githubusercontent.com/{$name[0]}/{$name[1]}/master/";

            $client = new Client();

            try{
                $response = $client->get($url . $manager->file);

                try{
                    $json =  json_decode($response->getBody());
                    print_r($json);
                    $response = [
                        "name" => $fields["name"],
                        "manager_id" => $fields["manager"],
                        "dependency_name" => $json->name
                    ];
                }
                catch (\Exception $e)
                {
                    $response = [
                        "error" => "There isn't a name field in the {$manager->file}",
                        "code" => 404
                    ];
                }

            }
            catch (\ErrorException $e)
            {
                $response = [
                    "error" => "The repository name is not valid",
                    "code" => 400
                ];
            }
            catch (RequestException $e)
            {
                $response = [
                    "error" => "The repository does not exist",
                    "code" => 404
                ];
            }
        }
        catch (\ErrorException $e)
        {
            $response = [
                "error" => "The repository name is not valid",
                "code" => 400
            ];
        }

        return $response;
    }
} 