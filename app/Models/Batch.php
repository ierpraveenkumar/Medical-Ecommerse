<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Batch extends Model
{
    use HasFactory;
    protected $fillable = [
        'product_type',
        'batch_no',
        'mfg_date',
        'expiry_date'
    ];
    
    public function products()
    {
        return $this->hasOne(Product::class);
    }
  
}
