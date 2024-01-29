<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\Pivot;

class Borrow extends Pivot // !!!!!!!!!!!
{
    use HasFactory;

    protected $table = 'borrows';
    protected $primaryKey = 'borrowId';

    public $timestamps = false;

    public function student(): BelongsTo{
        return $this->belongsTo(Student::class,'studentId');
    }

    public function book(): BelongsTo{
        return $this->belongsTo(Book::class,'bookId');
    }

}
