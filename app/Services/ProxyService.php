<?php


namespace App\Services;


use GuzzleHttp\Client;
use Illuminate\Http\Response;
use Illuminate\Support\Arr;

class ProxyService implements ProxyInterface
{
    /**
     * @var
     */
    private $includes = [];

    /**
     * @var
     */
    private $projects;

    /**
     * @param $parameters
     */
    public function __construct($parameters)
    {
        $this->includes = explode(',',$parameters);
        $this->projects = $this->callAPI();
    }

    public function callAPI() : array
    {
        $client = new Client();
        $res = $client->get(config('api.innosabi_api'), [
            'auth' => [
                config('auth.UserName'),
                config('auth.Password')
            ]
        ]);

        if (Response::HTTP_OK === $res->getStatusCode()) {
            $response = $res->getBody()->getContents();
        }

        return  json_decode($response, true)['data'];
    }

    /**
     * @return array
     */
    public function makeResult() : array
    {
        $result = [];
        foreach ($this->projects as $key => $project)
        {
            foreach ($this->includes as $element) {
                if(Arr::exists($project,$element)) {
                    $result[$key][$element] = $project[$element];
                }
            }
        }

        return $result;
    }
}
