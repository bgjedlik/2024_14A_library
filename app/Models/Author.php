<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

use function Symfony\Component\String\b;

class Author extends Model
{
    use HasFactory;

    protected $table = 'authors';
    protected $primaryKey = 'authorId';

    public $timestamps = false;

    protected $appends = ['full_name'];

    public function getFullNameAttribute(){
        return $this->name.' '.$this->surname;
    }

    // public function fullname(){
    //     return $this->name.' '.$this->surname;
    // }

    // 1 -> N
    public function books(): HasMany
    {
        return $this->hasMany(Book::class, 'authorId');
    }
}
