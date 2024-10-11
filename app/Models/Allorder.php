<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Allorder extends Model
{
    use HasFactory;

    protected $fillable=['order_id', 'customer_name', 'order_date','total_amount','status'];
}
