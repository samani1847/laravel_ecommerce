<?php
namespace OneStop\Lib;
use DB;

class GuzzleClient implements ClientInterface{

    protected $client;

    public function __construct(){
        $this->client = DB::table('oauth_clients')->where('id', '=',2)->first();

    }

    public function login($username, $password){

        $http = new \GuzzleHttp\Client;
        
        $response = $http->post(url('/oauth/token'), [
            'form_params' => [
                'grant_type' => 'password',
                'client_id' => $this->client->id,
                'client_secret' => $this->client->secret,
                'username' => $username,
                'password' => $password,
                'scope' => '',
            ],
        ]);
        
        return json_decode((string) $response->getBody(), true);
        
    }
}