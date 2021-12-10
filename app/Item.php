<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Item extends Model
{
    protected $fillable = [
        'name', 'description', 'price', 'image', 'user_id', 'type_id'
    ];

    protected $hidden = [
        'user_id', 'type_id',
    ];

    public $timestamps = false;

    public function user(){
        return $this->belongsTo(User::class, 'user_id', 'id');
    }

    public function type(){
        return $this->belongsTo(Type::class, 'type_id', 'id');
    }
}
