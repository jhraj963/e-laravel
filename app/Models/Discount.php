<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Discount extends Model
{
    use HasFactory;

    protected $fillable=['eventname_id','coupon', 'discount'];

    public function salesEvent()
    {
        return $this->belongsTo(SalesEvent::class, 'eventname_id');
    }
}
