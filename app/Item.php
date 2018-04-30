<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Item extends Model
{
    protected $fillable = [
        'user_id',
        'item_name',
        'file_path',
        'proofer_id',
        'status',
    ];
}
