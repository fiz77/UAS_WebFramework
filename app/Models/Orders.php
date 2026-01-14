<?php

namespace App\Models;
use Illuminate\Database\Eloquent\Model;
use App\Models\User;

class Orders extends Model
{
    protected $table = 'orders';
    protected $primaryKey = 'order_id';

    protected $fillable = [
        'user_id',
        'order_date',
        'nama_penerima',
        'no_hp', 
        'alamat_lengkap'
    ];
    public function user() {
        return $this->belongsTo(User::class, 'user_id');
    }
}