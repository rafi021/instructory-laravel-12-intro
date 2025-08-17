<?php

namespace App\Models;

use App\Models\TaskImage;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Task extends Model
{
    /** @use HasFactory<\Database\Factories\TaskFactory> */
    use HasFactory;
    protected $fillable = ['name', 'date', 'status', 'image'];

    public function images(): HasMany
    {
        return $this->hasMany(TaskImage::class);
    }
    // protected $guarded = ['id'];
}
