<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SalesEvent extends Model
{
    use HasFactory;

    protected $fillable=['eventname', 'startdate', 'enddate', 'discount'];
}
