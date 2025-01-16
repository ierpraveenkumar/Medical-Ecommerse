<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Lead extends Model
{
    use HasFactory;

    protected $fillable = [
        'first_name',
        'last_name',
        'email'
    ];

    public function order()
    {
        return $this->hasOne(Order::class);
    }
    public function PrescriptionToken()
    {
        return $this->hasOne(PrescriptionToken::class);
    }
    public function PaymentToken()
    {
        return $this->hasOne(PaymentToken::class);
    }
   
}
