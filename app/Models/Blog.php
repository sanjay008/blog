<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Blog extends Model
{
    use HasFactory;
    protected $fillable = ['title', 'description', 'category_id', 'image','user_id'];


public function category()
{
    return $this->belongsTo(Category::class); // Belongs to the Category model.
}
public function user()
{
    return $this->belongsTo(User::class); // Belongs to the Category model.
}
}
