<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class ingredients extends Model
{
    use HasFactory;

    propected $fiallable = [
        'name',
        'description',
        'is_alcoholic',
    ]
}
