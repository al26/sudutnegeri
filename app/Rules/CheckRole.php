<?php

namespace App\Rules;

use Illuminate\Contracts\Validation\Rule;
use Illuminate\Support\Facades\DB;


class CheckRole implements Rule
{
    protected $role;
    protected $table;

    /**
     * Create a new rule instance.
     *
     * @return void
     */
    public function __construct($table, $role)
    {
        $this->table = $table;
        $this->role = $role;
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
        $role = DB::table($this->table)
                    ->select('role')
                    ->where($attribute, $value)->first();
        return $role->role === $this->role;
    }

    /**
     * Get the validation error message.
     *
     * @return string
     */
    public function message()
    {
        return "Please use account listed as $this->role";
    }
}
