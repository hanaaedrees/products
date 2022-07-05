<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class orders extends Model
{
    use HasFactory;
    protected $guarded = [];

    public function orders_user(){
        return $this->belongsTo(user::class);
    }

    public function orders_product(){
        return $this->belongsTo(product::class);
    }
}
