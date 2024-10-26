<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Allcustomer extends Model
{
    use HasFactory;

    protected $fillable=['full_name', 'address ', 'state', 'email','phone','registration_date'];
}
