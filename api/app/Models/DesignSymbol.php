<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DesignSymbol extends Model
{
    use HasFactory;

    protected $fillable = [
        'image',
        'status',
    ];

    public function scopeIsActive($query) {
        return $query->where('status', true);
    }
}
