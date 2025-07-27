<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class inventories extends Model
{
    use HasFactory;
    protected $fiallable = [
        'user_id',
        'ingredient_id',
        'in_stock',
    ]
}
