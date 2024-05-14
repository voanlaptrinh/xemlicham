<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    use HasFactory;
    protected $table = 'posts';
    protected $fillable = ['title', 'description', 'image', 'content', 'category_id', 'status', 'schedule'];

    public function category()
    {
        return $this->belongsTo(Category::class);
    }
}
