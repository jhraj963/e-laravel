<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Allorder extends Model
{
    use HasFactory;

    protected $fillable=['customer_id', 'customer_name', 'order_date','total_amount','email','mobile_no','address','country','city','state','zip_code','discount','shipping_charge','shipping_date','shipping_method_id','status'];

    public function customer()
    {
        return $this->belongsTo(Customer::class, 'customer_id');
    }
}
