<?php

namespace App\Rules;

use Illuminate\Contracts\Validation\Rule;
use App\Models\Schedule;
use App\Models\Scanner;

class ScheduleLimitValidation implements Rule
{
    /**
     * Create a new rule instance.
     *
     * @return void
     */
    protected $message;
    protected $scanner_id;

    public function __construct($scanner_id)
    {
        $this->message = ' ';
        $this->scanner = Scanner::find($scanner_id);
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
        $request_per_minute = getSetting('request_per_minute'); 

        foreach ($value as $key => $time) 
        {
            $requests = $this->scanner->request_list;

            $schedules = Schedule::where('time', $time)->where('scanner_id', '!=', $this->scanner->id)->get();

            foreach ($schedules as $schedule) 
            {
                $requests = $requests+$schedule->scanner->request_list;
            }

            if ($requests>$request_per_minute) {
                $this->message = 'El horario '.$time.' supera el limite de peticiones por minuto.';
                return false;
            }

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
