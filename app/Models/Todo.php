<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Todo extends Model
{
    use HasFactory, SoftDeletes;


    protected $fillable = [
        'task',
        'image',
        'description',
        'is_complete',
        'category_id',
    ];

    public function Category()
    {
        return $this->belongsTo(Category::class);
    }
}
