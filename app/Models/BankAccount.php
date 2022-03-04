<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class BankAccount extends Model
{
    protected $table = 'bank_account';

    protected $fillable = [
        'user_id', 'type', 'amount'
    ];

    /**
     * Retorna o usuario do extrato.
     */
    public function bankAccountUser()
    {
        return $this->hasOne('App\Models\User', 'id', 'user_id');
    }
}
