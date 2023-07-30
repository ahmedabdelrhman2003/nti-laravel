<?php

namespace App\Models;

use App\Http\Controllers\Apis\ProductController;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    public $incrementing = false;
    use HasFactory;
    protected $guarded = [];
}
