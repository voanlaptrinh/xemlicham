<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    use HasFactory;
    protected $table = 'categorys';
    protected $fillable = ['title', 'metaTitle','metaDescription', 'parent_id'];

    // Một danh mục có thể có nhiều danh mục con
    public function children()
    {
        return $this->hasMany(Category::class, 'parent_id');
    }

    // Một danh mục có thể thuộc về một danh mục cha
    public function parent()
    {
        return $this->belongsTo(Category::class, 'parent_id');
    }
}
