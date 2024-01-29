<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Student extends Model
{
    use HasFactory;

    protected $table = 'students';
    protected $primaryKey = 'studentId';

    public $timestamps = false;

    public function books() : BelongsToMany{
        return $this->belongsToMany(Book::class,'borrows','studentId','bookId')
            ->withPivot('takenDate','broughtDate')
            ->using(Borrow::class);
    }
}
