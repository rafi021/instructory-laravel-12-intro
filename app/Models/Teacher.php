<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Database\Eloquent\Relations\HasOneThrough;

class Teacher extends Model
{
    /** @use HasFactory<\Database\Factories\TeacherFactory> */
    use HasFactory;

    protected $guarded = ['id'];

    public function student(): HasOne
    {
        return $this->hasOne(Student::class);
    }

    public function parent(): HasOneThrough
    {
        return $this->hasOneThrough(Parents::class, Student::class);
    }
}
