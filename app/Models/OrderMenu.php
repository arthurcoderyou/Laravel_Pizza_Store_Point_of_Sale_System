<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class OrderMenu extends Model
{
    use HasFactory;
    protected $table = 'order_menus';
    protected $fillable = [
        'order_id',
        'menu_id',
        'menu_name',
        'menu_price',
        'menu_quantity',
        'menu_total_payment'
    ];
}
