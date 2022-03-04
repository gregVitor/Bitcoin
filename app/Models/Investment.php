<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Investment extends Model
{

    use SoftDeletes;
    protected $table = 'investment';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'user_id', 'bitcoin_quantity', 'bitcoin_price', 'applied_money'
    ];

    /**
     * Retorna o usuario do investimento.
     */
    public function investmentUser()
    {
        return $this->hasOne('App\Models\User', 'id', 'user_id');
    }
}
