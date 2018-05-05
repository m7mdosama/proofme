<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ItemProofer extends Model
{
    protected $fillable = [
        'user_id',
        'item_id'
    ];

    public function item()
    {
        return $this->belongsTo(\App\Item::class, 'item_id');
    }

    public function proofer()
    {
        return $this->belongsTo(\App\User::class, 'user_id');
    }
}
