<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Relation\HasMany;

class Type extends Model
{
    //
    public $timestamps = false;

    public function item(){
        return $this->hasMany(Item::class, 'type_id', 'id');
    }
}
