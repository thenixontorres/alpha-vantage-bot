<?php

namespace App\Rules;

use Illuminate\Contracts\Validation\Rule;
use App\Abstracts\AlphaVantage;
use App\Models\Asset;

class CurrencyValidation implements Rule
{
    /**
     * Create a new rule instance.
     *
     * @return void
     */
    protected $message;

    public function __construct()
    {
        $this->message = ' ';
    }

    /**
     * Determine if the validation rule passes.
     *
     * @param  string  $attribute
     * @param  mixed  $value
     * @return bool
     */
    public function passes($attribute, $value)
    {
        $symbol = explode('--:', $value);

        /*Verificamos que recibomos un string solo en el formato correcto "name --(symbol)" */
        if (!isset($symbol[1])) 
        {
            $this->message = 'Debe cumplir con el formato "nombre --:"';
            return false;
        }

        $symbol = $symbol[1];

        /*verificamos que el simbolo corresponda a un activo valido de alpha vantage*/
        $respose = AlphaVantage::get('TIME_SERIES_INTRADAY', ['symbol' => $symbol, 'interval'=>'5min']);

        /*Si fallo la consulta a la api*/
        if (!$respose) 
        {
            $this->message = 'Hubo un problema verificando el activo. Reintente luego.';
            return false;
        }

        /*Si no encontro informacion del activo*/
        if (isset($respose['Error Message'])) 
        {
            $this->message = 'El activo seleccionado no esta disponible.';
            return false;
        }

        /* Verificamos que el sybol ya no exista en la base de datos*/
        $othe_asset = Asset::where('symbol', $symbol)->first();

        if (!empty($othe_asset)) 
        {
            $this->message = 'Ya este activo se encuentra en el sistema.';
            return false;
        }

        return true;
    }

    /**
     * Get the validation error message.
     *
     * @return string
     */
    public function message()
    {
        return $this->message;
    }
}
