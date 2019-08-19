<?php

namespace App\Abstracts;

use GuzzleHttp\Client;
use Guzzle\Http\Exception\ClientErrorResponseException;

abstract class AlphaVantage
{
	/*FUERA DE USO - MOVIDO A TRAITS*/
	static function get($data)
	{
		$data['apikey'] = getApiKey();  

		$client = new client(['base_uri' => env('ALPHA_VANTAGE_API_URL')]);

		$url = 'query?'.http_build_query($data);
 		
 		try {
		    $response = $client->request('GET', $url);
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

 	static function getStockPrice($symbol)
 	{
 		$api = env('ALPHA_VANTAGE_API_URL');

 		$apikey = getApiKey();

 		if (!$apikey) 
 		{
			return false;
 		}

 		$data = [
 			'function' => 'TIME_SERIES_INTRADAY',
 			'apikey' => $apikey,
 			'symbol' => $symbol, 
 			'interval' => '1min'
 		];

 		$data = http_build_query($data);
 		 		
 		$ch = curl_init($api.$data);
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
		curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "GET");
		$response = curl_exec($ch);
		curl_close($ch);
		
		if(!$response) 
		{
			return false;
		}else{

			$response = json_decode($response, true);

			if (isset($response['Time Series (1min)'])) 
            {
               	$response = array_shift($response['Time Series (1min)'])['4. close'];
            }else{
                $response = false;
            }

			return $response;
		}
 	}

 	static function getCurrecyExchange($from_currency, $to_currency)
 	{
 		$api = env('ALPHA_VANTAGE_API_URL');

 		$apikey = getApiKey();

 		if (!$apikey) 
 		{
			return false;
 		}

 		$data = [
 			'function' => 'CURRENCY_EXCHANGE_RATE',
 			'apikey' => $apikey,
 			'from_currency' => $from_currency, 
 			'to_currency' => $to_currency
 		];

 		$data = http_build_query($data);
 		 		
 		$ch = curl_init($api.$data);
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
		curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "GET");
		$response = curl_exec($ch);
		curl_close($ch);
		
		if(!$response) 
		{
			return false;
		}else{

			$response = json_decode($response, true);

			if (isset($response['Realtime Currency Exchange Rate'])) 
            {
                $response = $response['Realtime Currency Exchange Rate']['5. Exchange Rate'];

            }else{
                $response = false;
            }

			return $response;
		}
 	}

 	/* Obtener el valor de un activo (stock) en especifico */
 	static function getIntardayData($symbol, $period = '1min')
 	{
 		$api = env('ALPHA_VANTAGE_API_URL');

 		$apikey = getApiKey();

 		if (!$apikey) 
 		{
			return false;
 		}

 		$data = [
 			'function' => 'TIME_SERIES_INTRADAY',
 			'apikey' => $apikey,
 			'symbol' => $symbol, 
 			'interval' => $period
 		];

 		$data = http_build_query($data);
 		 		
 		$ch = curl_init($api.$data);
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
		curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "GET");
		$response = curl_exec($ch);
		curl_close($ch);
		
		if(!$response) 
		{
			return false;
		}else{

			$response = json_decode($response, true);

			if (isset($response['Time Series (1min)'])) 
            {
                $response = array_shift($response['Time Series (1min)']);
            }else{
                $response = false;
            }

			return $response;
		}
 	}

 	/*Peticion directa a la api*/
 	static function getDirect($data)
 	{
 		$api = env('ALPHA_VANTAGE_API_URL');
 		
 		$apikey = getApiKey();

 		if (!$apikey) 
 		{
			return false;
 		}

 		$data['apikey'] = $apikey;
 		
 		$data = http_build_query($data);
 		
 		$ch = curl_init($api.$data);

		curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
		
		curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "GET");
		
		$response = curl_exec($ch);
		
		curl_close($ch);
		
		if(!$response) 
		{
			return false;
		}else{

			$response = json_decode($response, true);
						
			/*Error de limite excedido*/
			if (isset($response['note']) || isset($response['Note']) || isset($response['Error Message'])) 
			{
				return false;
			}

			return $response;
		}
 	}

 	static function getPrice($symbol)
 	{
 		$api = env('ALPHA_VANTAGE_API_URL');

 		$apikey = getApiKey();

 		if (!$apikey) 
 		{
			return false;
 		}

 		$data = [
 			'function' => 'GLOBAL_QUOTE',
 			'apikey' => $apikey,
 			'symbol' => $symbol, 
 		];

 		$data = http_build_query($data);

 		$ch = curl_init($api.$data);

 		//dd($api.$data);

		curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
		curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "GET");
		$response = curl_exec($ch);
		curl_close($ch);
		
		if(!$response) 
		{
			return false;
		}else{

			$response = json_decode($response, true);

			if (isset($response['Global Quote']['05. price'])) 
            {
                $response = $response['Global Quote']['05. price'];
            }else{
                $response = false;
            }

			return $response;
		}
 	}
}