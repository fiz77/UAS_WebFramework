<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class HomeController extends Controller
{
    public function index()
    {
        $all_product = DB::table('menu')->get()->map(function ($item) {
            if (isset($item->product_img) && $item->product_img) {
                try {
                    $imageData = null;

                    if (is_resource($item->product_img)) {
                        // Get stream metadata
                        $meta = stream_get_meta_data($item->product_img);
                        \Log::info('Stream metadata: ' . json_encode($meta));

                        // Rewind the stream to the beginning
                        rewind($item->product_img);

                        // Read all data from the stream
                        $imageData = stream_get_contents($item->product_img);

                        \Log::info('Image data length: ' . strlen($imageData));
                        \Log::info('Image data preview: ' . substr($imageData, 0, 50));

                        // Close the stream
                        fclose($item->product_img);
                    } else {
                        $imageData = $item->product_img;
                    }

                    // Handle PostgreSQL bytea formats if it's a string
                    if (is_string($imageData)) {
                        // Check if it's hex format (\x...)
                        if (str_starts_with($imageData, '\\x')) {
                            $hexData = substr($imageData, 2); // Remove \x prefix
                            $imageData = hex2bin($hexData);
                        }
                        // Check if it contains escape sequences (PostgreSQL escape format)
                        elseif (strpos($imageData, '\\\\') !== false || strpos($imageData, '\\0') !== false) {
                            // Decode PostgreSQL escape format
                            if (function_exists('pg_unescape_bytea')) {
                                $imageData = pg_unescape_bytea($imageData);
                            }
                        }
                        // If it's already binary data, use as is
                    }

                    // Validate that we have valid image data
                    if (!empty($imageData) && strlen($imageData) > 100) { // Minimum reasonable image size
                        // Detect image type
                        $imageType = 'jpeg'; // default
                        if (str_starts_with($imageData, "\x89PNG")) {
                            $imageType = 'png';
                        } elseif (str_starts_with($imageData, "\xFF\xD8\xFF")) {
                            $imageType = 'jpeg';
                        } elseif (str_starts_with($imageData, 'GIF')) {
                            $imageType = 'gif';
                        } elseif (str_starts_with($imageData, "BM")) {
                            $imageType = 'bmp';
                        }

                        $item->image_src = 'data:image/' . $imageType . ';base64,' . base64_encode($imageData);
                    } else {
                        \Log::info('Invalid or empty image data for item: ' . $item->nama_menu);
                        $item->image_src = asset('img/placeholder.png');
                    }
                } catch (\Exception $e) {
                    \Log::error('Image processing error: ' . $e->getMessage());
                    // If anything goes wrong with image processing, use placeholder
                    $item->image_src = asset('img/placeholder.png');
                }
            } else {
                $item->image_src = asset('img/placeholder.png');
            }
            return $item;
        });

        $cart_count = session('cart_count', 0);

        return view('home', compact('all_product', 'cart_count'));
    }

    public function showMenu($id)
    {
        $product = DB::table('menu')->where('id_menu', $id)->first();

        if (!$product) {
            abort(404);
        }

        if (isset($product->product_img) && $product->product_img) {
            try {
                $imageData = null;

                if (is_resource($product->product_img)) {
                    // Get stream metadata
                    $meta = stream_get_meta_data($product->product_img);
                    \Log::info('Stream metadata: ' . json_encode($meta));

                    // Rewind the stream to the beginning
                    rewind($product->product_img);

                    // Read all data from the stream
                    $imageData = stream_get_contents($product->product_img);

                    \Log::info('Image data length: ' . strlen($imageData));
                    \Log::info('Image data preview: ' . substr($imageData, 0, 50));

                    // Close the stream
                    fclose($product->product_img);
                } else {
                    $imageData = $product->product_img;
                }

                // Handle PostgreSQL bytea formats if it's a string
                if (is_string($imageData)) {
                    // Check if it's hex format (\x...)
                    if (str_starts_with($imageData, '\\x')) {
                        $hexData = substr($imageData, 2); // Remove \x prefix
                        $imageData = hex2bin($hexData);
                    }
                    // Check if it contains escape sequences (PostgreSQL escape format)
                    elseif (strpos($imageData, '\\\\') !== false || strpos($imageData, '\\0') !== false) {
                        // Decode PostgreSQL escape format
                        if (function_exists('pg_unescape_bytea')) {
                            $imageData = pg_unescape_bytea($imageData);
                        }
                    }
                    // If it's already binary data, use as is
                }

                // Validate that we have valid image data
                if (!empty($imageData) && strlen($imageData) > 100) { // Minimum reasonable image size
                    // Detect image type
                    $imageType = 'jpeg'; // default
                    if (str_starts_with($imageData, "\x89PNG")) {
                        $imageType = 'png';
                    } elseif (str_starts_with($imageData, "\xFF\xD8\xFF")) {
                        $imageType = 'jpeg';
                    } elseif (str_starts_with($imageData, 'GIF')) {
                        $imageType = 'gif';
                    } elseif (str_starts_with($imageData, "BM")) {
                        $imageType = 'bmp';
                    }

                    $product->image_src = 'data:image/' . $imageType . ';base64,' . base64_encode($imageData);
                } else {
                    \Log::info('Invalid or empty image data for item: ' . $product->nama_menu);
                    $product->image_src = asset('img/placeholder.png');
                }
            } catch (\Exception $e) {
                \Log::error('Image processing error: ' . $e->getMessage());
                // If anything goes wrong with image processing, use placeholder
                $product->image_src = asset('img/placeholder.png');
            }
        } else {
            $product->image_src = asset('img/placeholder.png');
        }

        return view('menu.detail', compact('product'));
    }
}