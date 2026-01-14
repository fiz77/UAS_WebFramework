<?php

namespace App\Models;
use Illuminate\Database\Eloquent\Model;
use App\Models\Orders;

class Payment extends Model
{
    protected $table = 'payment';
    protected $primaryKey = 'id_payment';

    protected $fillable = [
        'order_id',
        'waktu_pembayaran',
    ];
    public function order() {
        return $this->belongsTo(Orders::class, 'order_id');
    }
}