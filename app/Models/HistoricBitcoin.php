<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class HistoricBitcoin extends Model
{
    protected $table = 'historic_bitcoin';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'buy', 'sell'
    ];

}
