<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Type extends Model
{
    use HasFactory;

    protected $table = 'types';
    protected $primaryKey = 'typeId';

    public $timestamps = false;

     // 1 -> N
     public function books() : HasMany {
        return $this->hasMany(Book::class,'typeId');
     }
}
