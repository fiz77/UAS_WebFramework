<?php

namespace App\Models;
use Illuminate\Database\Eloquent\Model;
use App\Models\Orders;
use App\models\Menu;

class Order_Item extends Model
{
    protected $table = 'order_item';
    protected $primaryKey = 'id_detail_order';

    protected $fillable = [
        'jml_order',
        'total_harga',
        'order_id',
        'id_menu'
    ];
    public function order() {
        return $this->belongsTo(Orders::class, 'order_id');
    }
    
    public function menu() {
        return $this->belongsTo(Menu::class, 'id_menu');
    }
}