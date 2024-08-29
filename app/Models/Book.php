<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Book extends Model
{
    use HasFactory;

    protected $table = 'books';

    protected $fillable = [
        'title',
        'categories_id',
        'description',
        'quantity',
        'file_path',
        'cover_path',
        'user_id',
    ];
    public function category()
    {
        return $this->belongsTo(Category::class, 'categories_id');
    }
    // Book.php
    public function likedByUsers()
    {
        return $this->belongsToMany(User::class, 'favorites');
    }
}
