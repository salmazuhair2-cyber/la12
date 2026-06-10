<?php

namespace App\Http\Controllers;


use App\Models\Cart;
use App\Models\Order;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class OrderController extends Controller
{
    public function index()
    {
        if (auth()->check()) {
            $cartItems = Cart::with('product')
                ->where('user_id', auth()->id())
                ->get();
        } else {
            // For guest users, get cart from session
            $sessionCart = session()->get('cart', []);
            $cartItems = collect();

            foreach ($sessionCart as $productId => $item) {
                $cartItems->push((object)[
                    'product' => (object)[
                        'name' => $item['name'],
                        'img_path' => $item['image'],
                    ],
                    'price' => $item['price'],
                    'quantity' => $item['quantity'],
                ]);
            }
        }

        // Calculate subtotal
        $subtotal = $cartItems->sum(function ($item) {
            return $item->price * $item->quantity;
        });

        return view('website.checkout', compact('cartItems', 'subtotal'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'address' => 'required',
            'city' => 'required',
            'country' => 'required',
            'postcode' => 'required',
            'phone' => 'required',
            'email' => 'required|email',
            'payment_method' => 'required|in:cash,mahwazti,bank_of_palestine,arab_islamic_bank',
        ]);

        $user = auth()->user();
        $cart = $user->cart()->with('product')->get();

        if ($cart->isEmpty()) {
            return back()->with('error', 'Your cart is empty.');
        }

        $total = $cart->sum(fn($item) => $item->price * $item->quantity);

        try {
            DB::beginTransaction();

            // Create the order
            $order = Order::create([
                'user_id' => $user->id,
                'name' => $request->name,
                'address' => $request->address,
                'city' => $request->city,
                'country' => $request->country,
                'postcode' => $request->postcode,
                'phone' => $request->phone,
                'email' => $request->email,
                'note' => $request->note,
                'payment_method' => $request->payment_method,
                'transaction_number' => $request->transaction_number,
                'status' => 'pending',
                'total' => $total,
            ]);
            // Create order items
            foreach ($cart as $item) {
                $order->items()->create([
                    'product_id' => $item->product_id,
                    'quantity' => $item->quantity,
                    'price' => $item->price,
                ]);
            }

            // Clear the cart
            $user->cart()->delete();

            DB::commit();

            return redirect()->route('website.index')->with('success', 'Order confirmed successfully!');
        } catch (\Exception $e) {
            DB::rollBack();

            return back()->with('error', 'Something went wrong. Please try again.');
        }
    }

    public function handleAction(Order $order, string $action)
    {
        if (!in_array($action, ['confirm', 'cancel'])) {
            abort(400, 'Invalid action');
        }

        $status = $action === 'confirm' ? 'confirmed' : 'canceled';
        $order->update(['status' => $status]);

        return redirect()->back()->with('success', "Order has been {$status}.");
    }



    public function myOrders()
    {
        $orders = auth()->user()->orders()->latest()->paginate(10);
        return view('website.orders', compact('orders'));
    }
}
