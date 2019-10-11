<?php

namespace App\Repositories;

use App\Models\Scanner;
use App\Models\Asset;
use App\Models\Strategy;
use App\Models\Signal;
use App\Repositories\BaseRepository;
use App\Traits\AlphaVantage;

/**
 *	Aplicacion de cada
 */
class ScannerRepository extends BaseRepository
{
	
	private $price;

	private $series_type = [
		'open' => '1. open',
		'high' => '2. high', 
		'low' => '3. low',
		'close' => '4. close',
	];

	/*crea un scaner*/
	public function create($inputs)
	{
		/*obtenemos el activo*/
		$scanner = new Scanner;

		$scanner->fill($inputs);

		$scanner->save();

		$attach = $this->attachStrategy($scanner, $inputs['strategy_id']);

		return [
			'scanner' => $scanner,
			'type' => 'success',
			'message' => 'Escaner registrado con exito'
		];
	}

	/*Actualiza la informacion general de un scanner*/
	public function update($inputs, $model)
	{
		//$model->asset_id = $inputs['asset_id'];

		$model->interval = $inputs['interval'];
		
		/*actualizamos el periodo en cada estrategia*/
		$settings = $model->settings_array;
		
		foreach($settings as $key => $value)
		{
			$settings[$key]['request_data']['interval'] = $inputs['interval'];
		}

		$model->settings = serialize($settings);

		$model->update();

		return [
			'scanner' => $model,
			'type' => 'success',
			'message' => 'Escaner actualizado con exito'
		];
	}

	/*actualiza las configuraciones de un scanner*/
	public function updateSettings(Scanner $scanner, $inputs)
	{

		$settings = $scanner->settings_array;

		$strategy = $inputs['code'];

		unset($inputs['code']);

		$settings[$strategy]['request_data'] = $inputs;

		$scanner->settings = serialize($settings);

		$scanner->update();

		return [
			'scanner' => $scanner,
			'type' => 'success',
			'message' => 'Escaner actualizado con exito'
		];
	}

	/*vincula estrategias a un scanner*/
	public function attachStrategy(Scanner $scanner, $strategies_id)
	{
		$settings = $scanner->settings_array;

		if (is_array($strategies_id)) 
		{

			foreach ($strategies_id as $key => $id) 
			{
				/*obtenemos la estrategia*/
				$strategy = Strategy::find($id);

				/*obtenemos el template de la estrategia*/
				$template = $strategy->template_array;

				/*le injectamos el simbolo del activo*/
				$template['request_data']['symbol'] = $scanner->merged_symbols;

				/*lo guardamos en en los settings del scanner*/
				$settings[$strategy->code] = $template;

				$scanner->strategies()->attach($id);
			}
		}else{
				/*obtenemos la estrategia*/
				$strategy = Strategy::find($strategies_id);

				/*obtenemos el template de la estrategia*/
				$template = $strategy->template_array;

				/*le injectamos el simbolo del activo*/
				$template['request_data']['symbol'] = $scanner->merged_symbols;

				/*lo guardamos en en los settings del scanner*/
				$settings[$strategy->code] = $template;

				$scanner->strategies()->attach($strategies_id);
		}

		$scanner->settings = serialize($settings);

		$scanner->update();

		return [
			'message' => 'Estrategia vinculada con exito',
			'type' => 'success'
		];
	}

	public function updateAssetSymbol(Scanner $scanner)
	{
		$settings_array = $scanner->settings_array;

		foreach ($settings_array as $key => $value) {
			
			$settings_array[$key]['request_data']['symbol'] = $scanner->merged_symbols;
		}

		$scanner->settings = serialize($settings_array);

		$scanner->update();

		return true;
	}

	/*desvincula estrategias a un scanner*/
	public function detachStrategy(Scanner $scanner, $strategies_id)
	{
		$settings = $scanner->settings_array;

		if (is_array($strategies_id)) 
		{
			foreach ($strategies_id as $key => $id) 
			{
				$strategy = Strategy::find($id);

				unset($settings[$strategy->code]);

				$scanner->strategies()->detach($id);

			}
		}else{
			$strategy = Strategy::find($strategies_id);

			unset($settings[$strategy->code]);
			
			$scanner->strategies()->detach($strategies_id);
		}
		
		$scanner->settings = serialize($settings);

		$scanner->update();
		
		return [
			'message' => 'Estrategia desvinculada con exito',
			'type' => 'success'
		];	
	}

	/*aplica las estrategias al scaner*/
	public function applyStrategy(Scanner $scanner, $exec_type = 'system', $exec_time = null)
	{
		$response = [];

		/*Si todas las estrategias coinciden*/
		$general_alert = true;

		/*si la alerta es de compra/venta y diferente a la ultima alerta*/
		$is_valid = false;
		
		/*cantidad de estrategias acertadas*/
		$succes_strategies = 0;

		/*aplicamos las estrategias asociadas al scanner*/
		foreach ($scanner->strategies as $strategy) 
		{
			switch ($strategy->code) {
				case 'MA_SINGLE':
					$response['MA_SINGLE'] = $this->applyMaSingle($scanner);
					(!$response['MA_SINGLE']['alert']) ? $general_alert = false : $succes_strategies++;
					break;

				case 'MA_DOUBLE':
					$response['MA_DOUBLE'] = $this->applyMaDouble($scanner);
					(!$response['MA_DOUBLE']['alert']) ? $general_alert = false: $succes_strategies++;
					break;

				case 'STOCH':
					$response['STOCH'] = $this->applyStoch($scanner);
					(!$response['STOCH']['alert']) ? $general_alert = false: $succes_strategies++;
					break;

				case 'RSI':
					$response['RSI'] = $this->applyRsi($scanner);
					(!$response['RSI']['alert']) ? $general_alert = false: $succes_strategies++;
					break;

				case 'BBANDS':
					$response['BBANDS'] = $this->applyBbands($scanner);
					(!$response['BBANDS']['alert']) ? $general_alert = false: $succes_strategies++;
					break;
				
				default:
					return [
						'success' => false,
						'alert' => false,
						'message' => 'Estrategia invalida',
						'data_signal' => null,
						'code' => 200
					];
					break;
			}
		}

		/*Si laas estrategias coinciden, entoncesnecesitamos saber si es valida la alerta*/
		if ($general_alert) 
		{
			if (!empty($scanner->signals->where('valid', true)->last())) 
			{
				/*obtenemos la ultima alerta valida*/
				$previous = $scanner->signals->where('valid', true)->last();
				
				/**Obtenemos el tipo de la alerta actual*/
				$values = array_values($response);
				$type_alert = $values[0]['type'];

				/*Si el tipo de senal es diferente al anterior entonces es valida*/
				if ($previous->just_type != $type_alert) 
				{
					$is_valid = true;
				}
			}else{
				/*si no hay una alerta previa con la cual comparar entonces es valida*/
				$is_valid = true;
			}
		}

		/*si hay una alerta la registramos */
		$signal = new Signal();
		$signal->scanner_id = $scanner->id;
		$signal->data = serialize($response);
		$signal->valid = $is_valid;
		$signal->exec_type = $exec_type;
		$signal->exec_time = (empty($exec_time)) ? now() : $exec_time;
		$signal->ratio = $succes_strategies;
		$signal->save();

		return [
			'success' => true,
			'data_signal' => $response,
			'general_alert' => $general_alert,
			'code' => 200
		];
	}

	/*CRUCE DE EMA, WMA, SMA, VWAP con el precio*/
	private function applyMaSingle(Scanner $scanner)
	{
		/*PASO 1: OBTENCION DE DATOS */
		/* Obtenemos la configuracion indicador técnico lento (MA) $slow */
		$slow_request = $scanner->settings_array['MA_SINGLE']['request_data'];
		
		/* Construimos la configuracion indicador técnico rápido  (PRECIO) $fast */
		switch ($scanner->scanner_type) {
			
			case 'stock_market':
				$fast_request = [
					'function' => 'TIME_SERIES_INTRADAY',
					'symbol' => $slow_request['symbol'],
					'interval' => $slow_request['interval'],
				];
				break;

			case 'physical':
				$fast_request = [
					'function' => 'FX_INTRADAY',
					'from_symbol' => $scanner->asset->symbol,
					'to_symbol' => $scanner->assetTo->symbol,
					'interval' => $slow_request['interval'],
				];
				break;
			
			default:
				$fast_request = [
					'function' => 'FX_INTRADAY',
					'from_symbol' => $scanner->asset->symbol,
					'to_symbol' => $scanner->assetTo->symbol,
					'interval' => $slow_request['interval'],
				];
				break;
		}

		/* consultamos la api para obtener la informacion necesaria */
		$alphaVantage = new AlphaVantage;

		$slow = $alphaVantage->get($slow_request);

		$fast = $alphaVantage->get($fast_request);

		if (!$fast || !$slow) 
		{
			return [
				'alert' => false,
				'type_html' => '<span class="badge badge-danger">ERROR</span>',
				'type' => 'ERROR',
				'symbol' => $scanner->merged_symbols,
				'prev_ma' => '---',
				'prev_price' => '---',
				'ma' => '---',
				'price' => '---',
				'time' => now()->format('d-m-Y H:i') 
			];
		}

		/*PASO 2: FORMATEO DE DATOS*/

		/*Eliminamos los key de la respuesta y obtenelos solo las listas de valores de cada indicador */

		/*lista de valores de la MA */	
		$slow = array_values($slow)[1];
		/*lista de valores del precio*/
		$fast = array_values($fast)[1];

		/* Necesitamos el tipo de ma que se solicito*/
		$ma = $slow_request['function'];

		/* obtenemos las ultimos dos valores de MA */
		$slow_last = array_shift($slow)[$ma];

		$slow_prevous = array_shift($slow)[$ma];

		/* necesitamos el tipo que serie que se solicito formateado */
		$serie = $this->series_type[$slow_request['series_type']];

		/* obtenemos las ultimos dos valores del precio*/
		$price_last = array_shift($fast)[$serie];

		$price_prevous =  array_shift($fast)[$serie];

		/*PASO 3: EVALUACION DE CONDICIONES*/

		/*El precio ANTES era menor al valor de la ma*/
		//$a = ($fast_prevous < $slow_prevous);

		/*El precio AHORA es mayor al valor de la ma*/
		//$b = ($fast_last > $slow_last);

		/*Respuesta por default*/
		$data_signal = [
			'alert' => false,
			'type' => 'NEUTRO',
			'type_html' => '<span class="badge badge-secondary">NEUTRO</span>',
			'symbol' => $scanner->merged_symbols,
			'prev_ma' => $slow_prevous,
			'prev_price' => $price_prevous,
			'ma' => $slow_last,
			'price' => $price_last,
			'time' => now()->format('d-m-Y H:i') 
		];

		/* Cuando el valor del precio actual $fast  cruza de abajo hacía arriba la ema $slow entonces se da una señal de compra. */
		if (($price_prevous < $slow_prevous) && ($price_last > $slow_last) && ($price_last > $price_prevous))
		{
			$data_signal['alert'] = true;
			$data_signal['type_html'] = '<span class="badge badge-success">BUY</span>';
			$data_signal['type'] = 'BUY';

            return  $data_signal;
		}

		/* Cuando el valor del precio actual $fast  cruza de arriba hacia abajo ema $slow entonces se da una señal de venta. */
		if (($price_prevous > $slow_prevous) && ($price_last < $slow_last) && ($price_last < $price_prevous))
		{
			$data_signal['alert'] = true;
			$data_signal['type_html'] = '<span class="badge badge-danger">SELL</span>';
			$data_signal['type'] = 'SELL';

            return  $data_signal;
		}

		return  $data_signal;
	}

	/*CRUCES DE EMA, WMA, SMA, VWAP*/
	private function applyMaDouble(Scanner $scanner)
	{
		/*PASO 1: OBTENCION DE DATOS */

		/* Obtenemos la configuracion comun en ambas ma */
		$default_request = $scanner->settings_array['MA_DOUBLE']['request_data'];
		
		/* Extraemos la configuracion especifica de cada indicador ma*/
		/* configuracion MA lenta $slow */
		$slow_request = $default_request['slow'];
		/* configuracion MA lenta $slow */
		$fast_request = $default_request['fast'];
		
		/*sacamos la informacion especifica y dejamos unicamente la general */
		unset($default_request['slow']);
		unset($default_request['fast']);
		
		/* unimos los arrays*/
		$slow_request = array_merge($slow_request, $default_request);
		$fast_request = array_merge($fast_request, $default_request);

		/* consultamos la api para obtener la informacion necesaria */

		$alphaVantage = new AlphaVantage;
 		
		$slow = $alphaVantage->get($slow_request);

		$fast = $alphaVantage->get($fast_request);
		
		if (empty($this->price)) 
		{
			$price = $alphaVantage->getPrice($default_request['symbol']);
		}else{
			$price = $this->price;
		}

		if (!$fast || !$slow || !$price) 
		{
			return [
				'alert' => false,
				'type' => 'ERROR',
				'type_html' => '<span class="badge badge-danger">ERROR</span>',
				'symbol' => $scanner->merged_symbols,
				'prev_slow_ma' => '---',
				'prev_fast_ma' => '---',
				'slow_ma' => '---',
				'fast_ma' => '---',
				'price' => '---',
				'time' => now()->format('d-m-Y H:i') 
			];
		}

		//$price = $price[$this->series_type[$default_request['series_type']]];

		/*PASO 2: FORMATEO DE DATOS*/

		/*Eliminamos los key de la respuesta y obtenelos solo las listas de valores de cada indicador */
		/*lista de valores de la MA */	
		$slow = array_values($slow)[1];
		/*lista de valores del precio*/
		$fast = array_values($fast)[1];

		/* Necesitamos el tipo de ma que se solicito*/
		$slow_ma = $slow_request['function'];

		$fast_ma = $fast_request['function'];

		/* obtenemos las ultimos dos valores de MA lenta*/
		$slow_last = array_shift($slow)[$slow_ma];

		$slow_prevous = array_shift($slow)[$slow_ma];

		/* obtenemos las ultimos dos valores de MA rapida*/
		$fast_last = array_shift($fast)[$fast_ma];

		$fast_prevous = array_shift($fast)[$fast_ma];

		//dd($slow_last, $slow_prevous ,$fast_last, $fast_prevous);

		/*PASO 3: EVALUACION DE CONDICIONES*/

		/*MA rapida era menor al valor de la MA lenta*/
		//$a = ($fast_prevous < $slow_prevous);

		/*MA rapida AHORA es mayor al valor de la ma lenta*/
		//$b = ($fast_last > $slow_last);

		/*Respuesta por default*/
		$data_signal = [
			'alert' => false,
			'type' => 'NEUTRO',
			'type_html' => '<span class="badge badge-secondary">NEUTRO</span>',
			'symbol' => $slow_request['symbol'],
			'prev_slow_ma' => $slow_prevous,
			'prev_fast_ma' => $fast_prevous,
			'slow_ma' => $slow_last,
			'fast_ma' => $fast_last,
			'price' => $price,
			'time' => now()->format('d-m-Y H:i') 
		];

		/*PASO 3: EVALUACION DE CONDICIONES*/
		/*MA rapida era menor al valor de la MA lenta y ahora es mayor*/
		if(($fast_prevous < $slow_prevous) && ($fast_last > $slow_last) && ($fast_last > $fast_prevous)){
			$data_signal['alert'] = true;
			$data_signal['type_html'] = '<span class="badge badge-success">BUY</span>';
			$data_signal['type'] = 'BUY';

			return  $data_signal;	
		}

		/*MA rapida era mayor al valor de la MA lenta y ahora es menor*/
		if(($fast_prevous > $slow_prevous) && ($fast_last < $slow_last) && ($fast_last < $fast_prevous)){
			$data_signal['alert'] = true;
			$data_signal['type_html'] = '<span class="badge badge-danger">SELL</span>';
			$data_signal['type'] = 'SELL';	

			return  $data_signal;
		}

		return  $data_signal;
	}

	/*Estocástico*/
	private function applyStoch(Scanner $scanner)
	{
		/*PASO 1: OBTENCION DE DATOS */
		/* Obtenemos la configuracion indicador stoch */
		
		$stoch_request = $scanner->settings_array['STOCH']['request_data'];
		
		$alphaVantage = new AlphaVantage();
		
		$stoch = $alphaVantage->get($stoch_request);

		if (empty($this->price)) 
		{
			$price = $alphaVantage->getPrice($stoch_request['symbol']);
		}else{
			$price = $this->price;
		}

		if (!$stoch || !$price) 
		{
			return [
				'alert' => false,
				'type_html' => '<span class="badge badge-danger">ERROR</span>',
				'type' => 'ERROR',
				'symbol' => $scanner->merged_symbols,
				'prev_k' => '---',
				'prev_d' => '---',
				'k' => '---',
				'd' => '---',
				'price' => '---',
				'time' => now()->format('d-m-Y H:i') 
			];
		}

		/*PASO 2: FORMATEO DE DATOS*/

		/*Eliminamos los key de la respuesta y obtenelos solo las listas de valores del indicador */

		/*lista de valores del stoch */	
		$stoch = array_values($stoch)[1];
		
		/*Ultimo valor del stoch*/
		$last = array_shift($stoch);

		/*penultimo valor del stoch*/
		$previous = array_shift($stoch);

		/*PASO 3: EVALUACION DE CONDICIONES*/

		/*STOCH K era menor al valor de la STOCH D*/
		//$a = ($previous['SlowK'] < $previous['SlowD']);

		/*STOCH rapida K AHORA es mayor al valor de la STOCH lenta D*/
		//$b = ($last['SlowK'] > $last['SlowD']);

		/* Los valores previos de cada indicados estan bajo 30*/
		//$c = ($previous['SlowD'] < 30 && $previous['SlowK'] < 30);

		/* Los valores previos de cada indicados estan sobre 80*/
		//$d = ($previous['SlowD'] > 80 && $previous['SlowK'] < 80);

		/*Respuesta por default*/
		$data_signal = [
			'alert' => false,
			'type_html' => '<span class="badge badge-secondary">NEUTRO</span>',
			'type' => 'NEUTRO',
			'symbol' => $scanner->merged_symbols,
			'prev_k' => $previous['SlowK'],
			'prev_d' => $previous['SlowD'],
			'k' => $last['SlowK'],
			'd' => $last['SlowD'],
			'price' => $price,
			'time' => now()->format('d-m-Y H:i') 
		];

 		/* Cuando el indicador técnico rápido K cruza de abajo hacía arriba al lento D y ambos estaban bajo 30 entonces se da una señal de compra.  */
        if (($previous['SlowD'] < 30 && $previous['SlowK'] < 30) && ($previous['SlowK'] < $previous['SlowD']) && ($last['SlowK'] > $last['SlowD']) && ($last['SlowK'] > $previous['SlowK']))
        {
            $data_signal['alert'] = true;
            $data_signal['type_html'] = '<span class="badge badge-success">BUY</span>';
            $data_signal['type'] = 'BUY';

            return  $data_signal;
        }

        /* Cuando el indicador técnico rápido K cruza de arriba hacia abajo al lento D entonces y ambos estaban sobre 80 se da una señal de venta. */
        if (($previous['SlowD'] > 80 && $previous['SlowK'] > 80) && ($previous['SlowK'] > $previous['SlowD']) && ($last['SlowK'] < $last['SlowD']) && ($last['SlowK'] < $previous['SlowK']))
        {
            $data_signal['alert'] = true;
            $data_signal['type_html'] = '<span class="badge badge-danger">SELL</span>';
            $data_signal['type'] = 'SELL';

            return  $data_signal;
        }

		return  $data_signal;

	}

	/*RSI*/
	private function applyRsi(Scanner $scanner)
	{
		/*PASO 1: OBTENCION DE DATOS */
		/* Obtenemos la configuracion indicador stoch */
		$request_data = $scanner->settings_array['RSI']['request_data'];
		
		$alphaVantage = new AlphaVantage;

		$rsi = $alphaVantage->get($request_data);

		if (empty($this->price)) 
		{
			$price = $alphaVantage->getPrice($request_data['symbol']);
		}else{
			$price = $this->price;
		}

		if (!$rsi || !$price) 
		{
			return [
				'alert' => false,
				'type' => 'ERROR',
				'type_html' => '<span class="badge badge-danger">ERROR</span>',
				'symbol' => $scanner->merged_symbols,
				'prev_rsi' => '---',
				'rsi' => '---',
				'price' => '---',
				'time' => now()->format('d-m-Y H:i') 
			];
		}

		/*PASO 2: FORMATEO DE DATOS*/

		/*Eliminamos los key de la respuesta y obtenelos solo las listas de valores del indicador */

		/*lista de valores del stoch */	
		$rsi = array_values($rsi)[1];
		
		/*Ultimo valor del rsi*/
		$last = array_shift($rsi);

		/*penultimo valor del rsi*/
		$previous = array_shift($rsi);

		/*PASO 3: EVALUACION DE CONDICIONES*/

		/* El rsi previos  estanba bajo 30*/
		$a = ($previous['RSI'] < 30);

		/* EL rsi actual esta sobre 30 */
		$b = ($last['RSI'] > 30);

		/* El rsi previos  estanba sobre 70*/
		$c = ($previous['RSI'] > 70);

		/* EL rsi actual esta bajo 70 */
		$d = ($last['RSI'] < 70);

		/*Respuesta por default*/
		$data_signal = [
			'alert' => false,
			'type' => 'NEUTRO',
			'type_html' => '<span class="badge badge-secondary">NEUTRO</span>',
			'symbol' => $scanner->merged_symbols,
			'prev_rsi' => $previous['RSI'],
			'rsi' => $last['RSI'],
			'price' => $price,
			'time' => now()->format('d-m-Y H:i') 
		];

		/* Cuando el rsi estaba bajo 30 y sube entonces es senal de compra  */
		if ($a && $b) 
		{
			$data_signal['alert'] = true;
			$data_signal['type_html'] = '<span class="badge badge-success">BUY</span>';
			$data_signal['type'] = 'BUY';

			return  $data_signal;
		}

		/* Cuando el rsi estaba sobre 70 y baja entonces es senal de venta  */
		if ($c && $d) 
		{
			$data_signal['alert'] = true;
			$data_signal['type_html'] = '<span class="badge badge-danger">SELL</span>';
			$data_signal['type'] = 'SELL';

			return  $data_signal;
		}

		return  $data_signal;
	}

	/*Bandas de blinger*/
	private function applyBbands(Scanner $scanner)
	{
		/*PASO 1: OBTENCION DE DATOS */
		/* Obtenemos la configuracion las bandas $slow */
		$bbands_request = $scanner->settings_array['BBANDS']['request_data'];
		
		/* Construimos la configuracion para obtener el precio */
		if($scanner->scanner_type == 'stock_market')
		{
			$prices_request = [
				'function' => 'TIME_SERIES_INTRADAY',
				'symbol' => $bbands_request['symbol'],
				'interval' => $bbands_request['interval'],
			];

		}else
		{
			$prices_request = [
				'function' => 'FX_INTRADAY',
				'from_symbol' => $scanner->asset->symbol,
				'to_symbol' => $scanner->assetTo->symbol,
				'interval' => $bbands_request['interval'],
			];
		}	

		$alphaVantage = new AlphaVantage;
		/* consultamos la api para obtener la informacion necesaria */
		$bbands = $alphaVantage->get($bbands_request);

		$prices = $alphaVantage->get($prices_request);

		if (!$bbands || !$prices) 
		{
			return [
				'alert' => false,
				'type' => 'ERROR',
				'type_html' => '<span class="badge badge-danger">ERROR</span>',
				'symbol' => $scanner->merged_symbols,
				'upper' => '---',
				'middle' => '---',
				'lower' => '---',
				'price' => '---',
				'time' => now()->format('d-m-Y H:i') 
			];
		}

		/*PASO 2: FORMATEO DE DATOS*/

		/*Eliminamos los key de la respuesta y obtenelos solo las listas de valores de cada indicador */

		/*lista de valores de la BBANDS */	
		$bbands = array_values($bbands)[1];
		/*lista de valores del precio*/
		$prices = array_values($prices)[1];

		/* obtenemos las ultimos dos valores de BBANDS */
		$bbands_last = array_shift($bbands);

		/* obtenemos las ultimos dos valores del precio*/
		$price_last = array_shift($prices)['4. close'];
		
		/*PASO 3: EVALUACION DE CONDICIONES*/

		/*el precio esta por encima de la banda superior*/
		$a = ($price_last > $bbands_last['Real Upper Band']);

		/*el precio esta por debajo de la banda inferior*/
		$b = ($price_last < $bbands_last['Real Lower Band']);

		/*Respuesta por default*/
		$data_signal = [
			'alert' => false,
			'type' => 'NEUTRO',
			'type_html' => '<span class="badge badge-secondary">NEUTRO</span>',
			'symbol' => $scanner->merged_symbols,
			'upper' => $bbands_last['Real Upper Band'],
			'middle' => $bbands_last['Real Middle Band'],
			'lower' => $bbands_last['Real Lower Band'],
			'price' => $price_last,
			'time' => now()->format('d-m-Y H:i') 
		];

		/* Cuando el precio esta en sobrecompra es senal de venta  */
		if ($a) 
		{
			$data_signal['alert'] = true;
			$data_signal['type_html'] = '<span class="badge badge-danger">SELL</span>';
			$data_signal['type'] = 'SELL';

			return  $data_signal;
		}

		/* Cuando el precio estaba sobreventa es senal de compra  */
		if ($b) 
		{
			$data_signal['alert'] = true;
			$data_signal['type_html'] = '<span class="badge badge-success">BUY</span>';
			$data_signal['type'] = 'BUY';

			return  $data_signal;
		}

		return  $data_signal;
	}

	/*intervalos perimitidos para la ejecucion del scanner*/
	public function getIntervals()
	{
		return [
            '1min' => '1 minuto',
            '5min' => '5 minutos',
            '15min' => '15 minutos',
            '30min' => '30 minutos',
            '60min' => '1 hora',
            'daily' => 'Diario',
            'weekly' => 'Semanal',
            'monthly' => 'Mensual'
        ];
	}

	/*series perimitidas para la ejecucion del scanner*/
	public function getSeries()
	{
		return [
            'close' => 'Cierre',
            'open' => 'Apertura',
            'high' => 'Alto',
            'low' => 'Bajo'
        ];
	}

	public function model()
	{
		return Scanner::class;
	}
}