<?php

use Illuminate\Database\Seeder;

class IndicatorsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

    	$indicators = [
    		['function_name' => 'SMA','description'=>'returns the simple moving average (SMA) values.'],
    		['function_name' => 'EMA','description'=>'returns the exponential moving average (EMA) values.'],
    		['function_name' => 'WMA','description'=>' returns the weighted moving average (WMA) values.'],
    		['function_name' => 'DEMA','description'=>'returns the double exponential moving average (DEMA) values.'],
    		['function_name' => 'TEMA','description'=>'returns the triple exponential moving average (TEMA) values.'],
    		['function_name' => 'TRIMA','description'=>'returns the triangular moving average (TRIMA) values.'],
    		['function_name' => 'KAMA','description'=>'returns the Kaufman adaptive moving average (KAMA) values.'],
    		['function_name' => 'MAMA','description'=>'returns the MESA adaptive moving average (MAMA) values.'],
    		['function_name' => 'VWAP','description'=>'returns the volume weighted average price (VWAP) for intraday time series.'],
    		['function_name' => 'T3','description'=>'returns the triple exponential moving average (T3) values.'],
    		['function_name' => 'MACD','description'=>'returns the moving average convergence / divergence (MACD) values. '],
    		['function_name' => 'MACDEXT','description'=>'returns the moving average convergence / divergence values with controllable moving average type. '],
    		['function_name' => 'STOCH','description'=>'returns the stochastic oscillator (STOCH) values.'],
    		['function_name' => 'STOCHF','description'=>'returns the stochastic fast (STOCHF) values.'],
            ['function_name' => 'RSI','description'=>'returns the relative strength index (RSI) values.'],
            ['function_name' => 'STOCHRSI','description'=>'returns the stochastic relative strength index (STOCHRSI) values.'],
            ['function_name' => 'WILLR','description'=>'returns the Williams %R (WILLR) values'],
            ['function_name' => 'ADX','description'=>'returns the average directional movement index (ADX) values.'],
            ['function_name' => 'ADXR','description'=>' returns the average directional movement index rating (ADXR) values.'],
            ['function_name' => 'APO','description'=>' returns the absolute price oscillator (APO) values.'],
            ['function_name' => 'PPO','description'=>'returns the percentage price oscillator (PPO) values.'],
            ['function_name' => 'MOM','description'=>'returns`the momentum (MOM) values. '],
            ['function_name' => 'BOP','description'=>'returns the balance of power (BOP) values.'],
            ['function_name' => 'CCI','description'=>'returns the commodity channel index (CCI) values. '],
            ['function_name' => 'CMO','description'=>'returns the Chande momentum oscillator (CMO) values.'],
            ['function_name' => 'ROC','description'=>'returns the rate of change (ROC) values.'],
            ['function_name' => 'ROCR','description'=>'returns the rate of change ratio (ROCR) values.'],
            ['function_name' => 'AROON','description'=>'returns the Aroon (AROON) values.'],
            ['function_name' => 'AROONOSC','description'=>'returns the Aroon oscillator (AROONOSC) values.'],
            ['function_name' => 'MFI','description'=>'returns the money flow index (MFI) values. '],
            ['function_name' => 'TRIX','description'=>' returns the 1-day rate of change of a triple smooth exponential moving average (TRIX) values.'],
            ['function_name' => 'ULTOSC','description'=>' returns the ultimate oscillator (ULTOSC) values.'],
            ['function_name' => 'DX','description'=>'returns the directional movement index (DX) values.'],
            ['function_name' => 'MINUS_DI','description'=>'returns the minus directional indicator (MINUS_DI) values.'],
            ['function_name' => 'PLUS_DI','description'=>'returns the plus directional indicator (PLUS_DI) values.'],
            ['function_name' => 'MINUS_DM','description'=>'returns the minus directional movement (MINUS_DM) values.'],
            ['function_name' => 'PLUS_DM','description'=>'returns the plus directional movement (PLUS_DM) values.'],
            ['function_name' => 'BBANDS','description'=>'returns the Bollinger bands (BBANDS) values.'],
            ['function_name' => 'MIDPOINT','description'=>' returns the midpoint (MIDPOINT) values. MIDPOINT = (highest value + lowest value)/2.'],
            ['function_name' => 'MIDPRICE','description'=>'returns the midpoint price (MIDPRICE) values. MIDPRICE = (highest high + lowest low)/2.'],
            ['function_name' => 'SAR','description'=>'returns the parabolic SAR (SAR) values.'],
            ['function_name' => 'TRANGE','description'=>'returns the true range (TRANGE) values. '],
            ['function_name' => 'ATR','description'=>' returns the average true range (ATR) values. '],
            ['function_name' => 'NATR','description'=>' returns the normalized average true range (NATR) values. '],
            ['function_name' => 'AD','description'=>' returns the Chaikin A/D line (AD) values.'],
            ['function_name' => 'ADOSC','description'=>'returns the Chaikin A/D oscillator (ADOSC) values'],
            ['function_name' => 'OBV','description'=>'returns the on balance volume (OBV) values.'],
            ['function_name' => 'HT_TRENDLINE','description'=>'returns the Hilbert transform, instantaneous trendline (HT_TRENDLINE) values.'],
            ['function_name' => 'HT_SINE','description'=>' returns the Hilbert transform, sine wave (HT_SINE) values.'],
            ['function_name' => 'HT_TRENDMODE','description'=>'returns the Hilbert transform, trend vs cycle mode (HT_TRENDMODE) values.'],
            ['function_name' => 'HT_DCPERIOD','description'=>'returns the Hilbert transform, dominant cycle period (HT_DCPERIOD) values.'],
            ['function_name' => 'HT_DCPHASE','description'=>'returns the Hilbert transform, dominant cycle phase (HT_DCPHASE) values.'],
            ['function_name' => 'HT_PHASOR','description'=>'returns the Hilbert transform, phasor components (HT_PHASOR) values.'],
    	];

    	foreach ($indicators as $indicator) {
    		
    		$indicator['created_at'] = now();

    		DB::table('indicators')->insert($indicator);
    	}
      
    }
}
