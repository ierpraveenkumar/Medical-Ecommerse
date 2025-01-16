<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PrescriptionToken extends Model
{
    use HasFactory;
    
    // Define the relationship
    public function lead()
    {
        return $this->belongsTo(Lead::class);
    }
}
