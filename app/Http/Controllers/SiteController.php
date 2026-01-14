<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Redirect;
use App\Models\Admin;;
use App\Models\Menu;
use App\Models\Cart;
use App\Models\Order_Item;
use App\Models\Orders;
use App\Models\Payment;

class SiteController extends Controller
{
    #-------------------------------- Cart Functions ---------------------------------#
    public function cart(Request $request)
    {
        $user_id = session('user_id');
        if (!$user_id) {
            return Redirect::to('/login')->with('flash', 'Login dulu untuk melihat cart.');
        }

        $cart_items = DB::table('cart as c')
            ->join('menu as m', 'c.id_menu', '=', 'm.id_menu')
            ->where('c.user_id', $user_id)
            ->select('c.id_cart', 'c.quantity', 'm.id_menu', 'm.nama_menu', 'm.harga_menu', 'm.desc_menu', 'm.product_img')
            ->get();

        $grandTotal = 0;
        foreach ($cart_items as $item) {
            $grandTotal += ($item->harga_menu * $item->quantity);
        }

        return view('cart', compact('cart_items', 'grandTotal'));
    }

    #-------------------------------- Add to Cart Functions ---------------------------------#
    public function addToCart($id)
    {
        $user_id = session('user_id');
        if (!$user_id) {
            return Redirect::to('/login')->with('flash', 'Silakan login terlebih dahulu.');
        }

        $exists = DB::table('cart')->where('user_id', $user_id)->where('id_menu', $id)->first();
        if ($exists) {
            DB::table('cart')->where('id_cart', $exists->id_cart)->increment('quantity');
        } else {
            DB::table('cart')->insert([
                'user_id' => $user_id,
                'id_menu' => $id,
                'quantity' => 1,
                'created_at' => now(),
            ]);
        }

        return Redirect::back();
    }
    #-------------------------------- Serve Image Functions ---------------------------------#

    public function serveImage($id)
    {
        $menu = DB::table('menu')->where('id_menu', $id)->first();

        if (!$menu || !$menu->product_img) {
            abort(404);
        }

        return response($menu->product_img)
            ->header('Content-Type', 'image/jpeg'); // or image/png
    }

    #-------------------------------- Checkout Functions ---------------------------------#
    public function checkout(Request $request)
    {
        $user_id = session('user_id');
        if (!$user_id) {
            return Redirect::to('/login')->with('flash', 'Silakan login terlebih dahulu.');
        }

        if ($request->isMethod('post')) {
            $nama = $request->input('nama');
            $no_hp = $request->input('no_hp');
            $alamat = $request->input('alamat');

            $cartItems = DB::table('cart')->where('user_id', $user_id)->get();
            if ($cartItems->isEmpty()) {
                return Redirect::back()->with('flash', 'Cart kosong');
            }

            $orderId = DB::table('orders')->insertGetId([
                'user_id' => $user_id,
                'order_date' => now(),
                'nama_penerima' => $nama,
                'no_hp' => $no_hp,
                'alamat_lengkap' => $alamat,
                'created_at' => now(),
                'updated_at' => now(),
            ]);

            foreach ($cartItems as $ci) {
                DB::table('order_item')->insert([
                    'order_id' => $orderId,
                    'id_menu' => $ci->id_menu,
                    'jml_order' => $ci->quantity,
                    'total_harga' => ($ci->quantity * DB::table('menu')->where('id_menu', $ci->id_menu)->value('harga_menu')),
                    'created_at' => now(),
                    'updated_at' => now(),
                ]);
            }

            DB::table('cart')->where('user_id', $user_id)->delete();

            return Redirect::to('/')->with('flash', 'Pesanan berhasil dibuat');
        }

        return view('checkout');
    }
    #-------------------------------- Authentication Functions ---------------------------------#

    public function showLogin()
    {
        return view('login');
    }

    public function processAuth(Request $request)
    {
        if ($request->has('register')) {
            $username = $request->input('username');
            $psw = $request->input('psw_user');
            $email = $request->input('email_user');

            $exists = DB::table('users')->where('username', $username)->first();
            if ($exists) {
                return Redirect::back()->with('flash', 'Username sudah terdaftar');
            }

            DB::table('users')->insert([
                'username' => $username,
                'psw_user' => $psw,
                'email_user' => $email,
                'role' => 'user',
            ]);

            \Log::info('User registered: ' . $username);

            return Redirect::to('/login')->with('flash', 'Akun berhasil dibuat!');
        }

        if ($request->has('login')) {
            $username = $request->input('username');
            $password = $request->input('psw_user');

            $admin = DB::table('admin')->where('username', $username)->first();
            if ($admin && $admin->password === $password) {
                session(['username' => $admin->username, 'role' => 'admin']);
                return Redirect::to('/admin');
            }

            $user = DB::table('users')->where('username', $username)->first();
            if ($user && $user->psw_user === $password) {
                session(['username' => $user->username, 'user_id' => $user->user_id, 'role' => 'admin']);
                return Redirect::to('/')->with('flash', 'Login berhasil!');
            }

            return Redirect::back()->with('flash', 'Akun tidak ditemukan atau password salah');
        }
        return Redirect::back();
    }

    #-------------------------------- Logout Functions ---------------------------------#
    public function logout()
    {
        session()->flush();
        return Redirect::to('/');
    }
    
}

