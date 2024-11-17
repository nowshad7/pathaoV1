<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    use HasFactory;

    const STATUS_CANCELLED = 0;
    const STATUS_ACTIVE = 1;

    protected $guarded = [];
}
