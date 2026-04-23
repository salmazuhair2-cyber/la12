<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
//use Illuminate\Support\Facades\Request as FacadesRequest;

class CartController extends Controller
{
    public function add(Request $request)
    {
        $request->validate([
            'product_id' => 'required|integer|exists:products,id',
        ]);

        $product = Product::findOrFail($request->product_id);

        if (auth()->check()) {
            $user = auth()->user();

            $cartItem = \App\Models\Cart::firstOrNew([
                'user_id' => $user->id,
                'product_id' => $product->id,
            ]);

            $cartItem->quantity = $cartItem->exists ? $cartItem->quantity + 1 : 1;
            $cartItem->price = $product->price;
            $cartItem->save();

            return response()->json([
                'message' => 'تمت إضافة المنتج إلى السلة بنجاح.',
                'cart_count' => $user->cart()->count()
            ]);
        }

        $cart = session()->get('cart', []);

        if (isset($cart[$product->id])) {
            $cart[$product->id]['quantity']++;
        } else {
            $cart[$product->id] = [
                'name' => $product->name,
                'price' => $product->price,
                'image' => $product->img_path,
                'quantity' => 1,
            ];
        }

        session()->put('cart', $cart);

        return response()->json([
            'message' => 'تمت إضافة المنتج إلى السلة.',
            'cart_count' => count($cart)
        ]);
    }

    public function index()
    {
        if (auth()->check()) {
            $cartItems = auth()->user()->cart()->with('product')->get();

            $cart = [];
            foreach ($cartItems as $item) {
                $cart[$item->product_id] = [
                    'name' => $item->product->name,
                    'price' => $item->price,
                    'image' => $item->product->img_path,
                    'quantity' => $item->quantity,
                ];
            }
        } else {
            $cart = session()->get('cart', []);
        }

        return view('website.carts.index', compact('cart'));
    }
    public function update(Request $request)
    {
        $request->validate([
            'product_id' => 'required|integer|exists:products,id',
            'change' => 'required|integer',
        ]);

        $productId = $request->product_id;
        $change = $request->change;

        if (auth()->check()) {
            $user = auth()->user();
            $cartItem = $user->cart()->where('product_id', $productId)->first();

            if ($cartItem) {
                $cartItem->quantity += $change;
                if ($cartItem->quantity <= 0) {
                    $cartItem->delete();
                } else {
                    $cartItem->save();
                }
            }

            return response()->json([
                'message' => 'تم تحديث الكمية.',
                'cart_count' => $user->cart()->count(),
            ]);
        }

        $cart = session()->get('cart', []);
        if (isset($cart[$productId])) {
            $cart[$productId]['quantity'] += $change;
            if ($cart[$productId]['quantity'] <= 0) {
                unset($cart[$productId]);
            }
        }
        session()->put('cart', $cart);

        return response()->json([
            'message' => 'تم تحديث الكمية.',
            'cart_count' => count($cart),
        ]);
    }

    public function remove(Request $request)
    {
        $request->validate([
            'product_id' => 'required|integer|exists:products,id',
        ]);

        $product_id = $request->product_id;

        if (auth()->check()) {
            $user = auth()->user();

            // Delete the item for this user
            $user->cart()->where('product_id', $product_id)->delete();

            return response()->json([
                'message' => 'تمت إزالة المنتج من السلة.',
                'cart_count' => $user->cart()->count()
            ]);
        }

        // Guest user (session cart)
        $cart = session()->get('cart', []);

        if (isset($cart[$product_id])) {
            unset($cart[$product_id]);
            session()->put('cart', $cart);
        }

        return response()->json([
            'message' => 'تمت إزالة المنتج من السلة.',
            'cart_count' => count($cart)
        ]);
    }
}
