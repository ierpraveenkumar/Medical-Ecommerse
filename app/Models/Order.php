<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;


class Order extends Model
{
    use HasFactory;

    protected $fillable = ['lead_id','shipping_address','billing_address','status'] ;
    public function lead(){
        return $this->belongsTo(Lead::class);
    }
    public function invoice(){
        return $this->hasOne(Invoice::class);
    }
    public function prescription()
{
    return $this->hasOne(PrescriptionToken::class);
}
}
