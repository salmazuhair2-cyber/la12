<?php

namespace App\Http\Controllers;

use App\Models\Cart;
use App\Models\Order;
use App\Models\Coupon;
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
            $sessionCart = session()->get('cart', []);
            $cartItems = collect();
            foreach ($sessionCart as $productId => $item) {
                $cartItems->push((object)[
                    'product'  => (object)['name' => $item['name'], 'img_path' => $item['image']],
                    'price'    => $item['price'],
                    'quantity' => $item['quantity'],
                ]);
            }
        }

        return view('website.checkout', compact('cartItems'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'name'           => 'required',
            'address'        => 'required',
            'city'           => 'required',
            'country'        => 'required',
            'phone'          => 'required',
            'email'          => 'required|email',
            'payment_method' => 'required|in:cash,mahwazti,bank_of_palestine,arab_islamic_bank',
        ]);

        $user = auth()->user();
        $cart = $user->cart()->with('product')->get();

        if ($cart->isEmpty()) {
            return back()->with('error', 'Your cart is empty.');
        }

        // حساب السبتوتال
        $subtotal = $cart->sum(fn($item) => $item->price * $item->quantity);

        // حساب الخصم
        $discount = 0;
        $coupon   = session('coupon');

        if ($coupon) {
            $minOrder = $coupon['min_order'] ?? 0;
            if ($subtotal >= $minOrder) {
                if ($coupon['type'] === 'percentage') {
                    $discount = round($subtotal * ($coupon['value'] / 100), 2);
                } else {
                    $discount = min($coupon['value'], $subtotal);
                }
            }
        }
        $total = $subtotal - $discount;

        try {

            DB::beginTransaction();

            $order = Order::create([
                'user_id'            => $user->id,
                'name'               => $request->name,
                'address'            => $request->address,
                'city'               => $request->city,
                'country'            => $request->country,
                'postcode'           => $request->postcode,
                'phone'              => $request->phone,
                'email'              => $request->email,
                'note'               => $request->note,
                'payment_method'     => $request->payment_method,
                'transaction_number' => $request->transaction_number,
                'status'             => 'pending',
                'subtotal'           => $subtotal,
                'discount'           => $discount,
                'total'              => $total,
                'coupon_code'        => $coupon['code'] ?? null,
            ]);

            foreach ($cart as $item) {
                $order->items()->create([
                    'product_id' => $item->product_id,
                    'quantity'   => $item->quantity,
                    'price'      => $item->price,
                ]);
            }

            // زيّد الـ used_count للكوبون
            if ($coupon && isset($coupon['id'])) {
                Coupon::where('id', $coupon['id'])->increment('used_count');
                session()->forget('coupon');
            }


            $user->cart()->delete();

            DB::commit();

            return redirect()->route('website.index')->with('order_success', [
                'title'   => 'Order Placed Successfully! 🎉',
                'message' => 'Thank you for your order. Your order is being processed and will be delivered within 2 business days.',
                'order_id' => $order->id,
            ]);
        } catch (\Exception $e) {
            DB::rollBack();
            return back()->with('error', 'Something went wrong. Please try again.');
        }
    }

    public function applyCoupon(Request $request)
    {
        $request->validate(['code' => 'required|string']);

        $coupon = Coupon::where('code', strtoupper($request->code))->first();

        if (!$coupon) {
            return back()->with('coupon_error', 'Coupon "' . strtoupper($request->code) . '" was not found.');
        }

        if (!$coupon->isValid()) {
            return back()->with('coupon_error', 'Coupon "' . $coupon->code . '" is expired or no longer available.');
        }

        session([
            'coupon' => [
                'id'        => $coupon->id,
                'code'      => $coupon->code,
                'type'      => $coupon->type,
                'value'     => $coupon->value,
                'min_order' => $coupon->min_order,
            ]
        ]);

        return back()->with('coupon_success', 'Coupon "' . $coupon->code . '" applied! You saved ' .
            ($coupon->type === 'percentage' ? $coupon->value . '%' : number_format($coupon->value, 2) . '₪') . '.');
    }
    public function removeCoupon()
    {
        session()->forget('coupon');
        return back()->with('coupon_success', 'Coupon removed.');
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
