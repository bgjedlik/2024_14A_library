<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Book extends Model
{
    use HasFactory;

    protected $table = 'books';
    protected $primaryKey = 'bookId';

    public $timestamps = false;

    // N -> 1
    public function type(): BelongsTo
    {
        return $this->belongsTo(Type::class, 'typeId');
    }

    public function author(): BelongsTo
    {
        return $this->belongsTo(Author::class, 'authorId');
    }

    public function students() : BelongsToMany{
        return $this->belongsToMany(Student::class,'borrows','bookId','studentId')
        ->withPivot('takenDate','broughtDate')
        ->using(Borrow::class);
    }
}
