<?php

use Illuminate\Database\Seeder;

class StrategiesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
    	
        $template  =
        [
            'indicators_allow' => [
                'EMA' => 'EMA',
                'SMA' => 'SMA',
                'WMA' => 'WMA',
                'VWAP' => 'VWAP'
            ],
            'request_data' => [
                'function' => 'EMA',
                'symbol' => '--',
                'interval' => '1min',
                'time_period' => 60,
                'series_type' => 'close'
            ],
        ]; 

        $fields = [
            'ACTIVO' => 'symbol',
            'TIPO' => 'type',
            'MA' => 'ma',
            'PRECIO' => 'price',
            'FECHA' => 'time'
        ];

        DB::table('strategies')->insert([
            'code'          => 'MA_SINGLE',
            'notification_fields' =>  serialize($fields),
            'title'         => 'Cruces de MAs simple',
            'status'        => 'on',
            'template'      => serialize($template),
            'created_at'    => now(),
            'api_request'   => 2
        ]);

        $template  =
        [
            'indicators_allow' => [
                'EMA' => 'EMA',
                'SMA' => 'SMA',
                'WMA' => 'WMA',
                'VWAP' => 'VWAP'
            ],
            'request_data' => [
                'slow' => [
                    'function' => 'EMA',
                    'time_period' => 60,
                ],
                'fast' => [
                    'function' => 'SMA',
                    'time_period' => 200,
                ],
                'symbol' => '--',
                'interval' => '1min',
                'series_type' => 'close'
            ],
        ]; 

        $fields = [
            'ACTIVO' => 'symbol',
            'TIPO' => 'type',
            'MA LENTA' => 'slow_ma',
            'MA RAPIDA' => 'fast_ma',
            'PRECIO' => 'price',
            'FECHA' => 'time'
        ];

        DB::table('strategies')->insert([
            'code'          => 'MA_DOUBLE',
            'notification_fields' =>  serialize($fields),
            'title'         => 'Cruces de MAs doble',
            'status'         => 'on',
            'template'      => serialize($template),
            'created_at'    => now(),
            'api_request'   => 3
        ]);

        $template  =
        [
            'indicators_allow' => [
                '0'=>'SMA',
                '1'=>'EMA',
                '2'=>'WMA',
                '3'=>'DEMA',
                '4'=>'TEMA',
                '5'=>'TRIMA',
                '6'=>'T3',
                '7'=>'KAMA',
                '8'=>'MAMA'
            ],
            'request_data' => [
                'function' => 'STOCH',
                'fastkperiod' => 5,
                'slowkperiod' => 3,
                'slowdperiod' => 3,
                'slowkmatype' => 0,
                'slowdmatype' => 0,
                'symbol' => '--',
                'interval' => '1min',
            ],
        ]; 

        $fields = [
            'ACTIVO' => 'symbol',
            'TIPO' => 'type',
            'K' => 'k',
            'D' => 'd',
            'PRECIO' => 'price',
            'FECHA' => 'time'
        ];

        DB::table('strategies')->insert([
            'code'          => 'STOCH',
            'notification_fields' =>  serialize($fields),
            'title'         => 'Estocástico',
            'status'         => 'on',
            'template'      => serialize($template),
            'created_at'    => now(),
            'api_request'   => 2
        ]);

        $template  =
        [
            'request_data' => [
                'function' => 'RSI',
                'symbol' => '--',
                'interval' => '1min',
                'series_type' => 'close',
                'time_period' => '14'
            ],
        ]; 

        $fields = [
            'ACTIVO' => 'symbol',
            'TIPO' => 'type',
            'RSI' => 'rsi',
            'PRECIO' => 'price',
            'FECHA' => 'time'
        ];

        DB::table('strategies')->insert([
            'code'          => 'RSI',
            'notification_fields' =>  serialize($fields),
            'title'         => 'Índice de fuerza relativa',
            'status'         => 'on',
            'template'      => serialize($template),
            'created_at'    => now(),
            'api_request'   => 2
        ]);

        $template  =
        [
            'indicators_allow' => [
                '0'=>'SMA',
                '1'=>'EMA',
                '2'=>'WMA',
                '3'=>'DEMA',
                '4'=>'TEMA',
                '5'=>'TRIMA',
                '6'=>'T3',
                '7'=>'KAMA',
                '8'=>'MAMA'
            ],
            'request_data' => [
                'function' => 'BBANDS',
                'symbol' => '--',
                'interval' => '1min',
                'series_type' => 'close',
                'time_period' => '20',
                'nbdevup' => '2',
                'nbdevdn' => '2',
                'matype' => '0' 
            ],
        ]; 

        $fields = [
            'ACTIVO' => 'symbol',
            'TIPO' => 'type',
            'ALTA' => 'upper',
            'MEDIA' => 'middle',
            'BAJA' => 'lower',
            'PRECIO' => 'price',
            'FECHA' => 'time'
        ];

        DB::table('strategies')->insert([
            'code'          => 'BBANDS',
            'notification_fields' =>  serialize($fields),
            'title'         => 'Bandas de Bollinger',
            'status'         => 'on',
            'template'      => serialize($template),
            'created_at'    => now(),
            'api_request'   => 2
        ]);
    }
}
