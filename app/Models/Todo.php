<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Todo extends Model
{
    use HasFactory, SoftDeletes;


    protected $fillable = [
        'user_id',
        'task',
        'image',
        'description',
        'is_complete',
    ];

    public function Categories()
    {
        return $this->belongsToMany(Category::class);
    }
}
