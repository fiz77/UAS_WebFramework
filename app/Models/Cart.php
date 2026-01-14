<?php

namespace App\Models;
use Illuminate\Database\Eloquent\Model;
use App\Models\User;
use App\Models\Menu;
class Cart extends Model
{
    protected $table = 'cart';
    protected $primaryKey = 'id_cart';

    protected $fillable = [
        'user_id',
        'id_menu',
        'quantity'
    ];
    public function user() {
        return $this->belongsTo(User::class, 'user_id');
    }
    
    public function menu() {
        return $this->belongsTo(Menu::class, 'id_menu');
    }
}