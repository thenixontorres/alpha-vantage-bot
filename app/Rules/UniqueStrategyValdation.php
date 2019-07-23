<?php

namespace App\Rules;

use Illuminate\Contracts\Validation\Rule;
use App\Models\Scanner;
class UniqueStrategyValdation implements Rule
{
    protected $message;
    protected $scanner;


    /**
     * Create a new rule instance.
     *
     * @return void
     */
    public function __construct($scanner)
    {
        $this->message = ' ';
        $this->scanner = Scanner::find($scanner);
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
        foreach ($this->scanner->strategies as $strategy) 
        {
            if ($strategy->id == $value) 
            {                
                $this->message = 'Ya este escaner tiene esta estrategia vinculada';
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
