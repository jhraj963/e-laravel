<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AddProduct extends Model
{
    use HasFactory;

    protected $fillable=['productname', 'description', 'price', 'quantity', 'category_id', 'photo','is_featured'];

        public function category()
    {
        return $this->belongsTo(Category::class, 'category_id');
    }
}
