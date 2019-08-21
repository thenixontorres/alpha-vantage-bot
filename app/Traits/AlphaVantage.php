<?php 

namespace App\Traits;

use GuzzleHttp\Client;
use Guzzle\Http\Exception\ClientErrorResponseException;

class AlphaVantage
{
	
	public $client;
	public $aplikey;

	function __construct()
	{
		$this->client = new client(['base_uri' => getSetting('alpha_vantage_api')]);
		$this->apikey = getApiKey(); 
	}

	/*Peticion generica del tipo get a el API*/
	public function get($data)
	{
		$data['apikey'] = $this->apikey;

		$url = 'query?'.http_build_query($data);
 		
 		try {
		    $response = $this->client->request('GET', $url);
		} catch (ClientErrorResponseException $exception) {
		    $response = $exception->getResponse()->getBody(true);
		   	return false;
		}
		
		$response = json_decode($response->getBody()->getContents(), true);
		

		if (isset($response['note']) || isset($response['Note']) || isset($response['Error Message'])) 
		{
			return false;
		}

		return $response;
	}

	/*Obtener el precio de un activo en especifico*/
	public function getPrice($symbol)
 	{
 		$data = [
 			'function' => 'GLOBAL_QUOTE',
 			'apikey' => $this->apikey,
 			'symbol' => $symbol, 
 		];

 		$url = 'query?'.http_build_query($data);

		try {
		    $response = $this->client->request('GET', $url);
		} catch (ClientErrorResponseException $exception) {
		    $response = $exception->getResponse()->getBody(true);
		   	return false;
		}
 		
		$response = json_decode($response->getBody()->getContents(), true);

		if (isset($response['Global Quote']['05. price'])) 
        {
            $response = $response['Global Quote']['05. price'];
        }else{
            $response = false;
        }

		return $response;
 	}
}