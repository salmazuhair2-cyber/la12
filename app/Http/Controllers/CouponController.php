<?php

namespace App\Http\Controllers;

use App\Models\Coupon;
use Illuminate\Http\Request;

class CouponController extends Controller
{
    public function apply(Request $request)
    {
        $request->validate(['code' => 'required|string']);

        $coupon = Coupon::where('code', strtoupper($request->code))->first();

        if (!$coupon || !$coupon->isValid()) {
            return response()->json([
                'success' => false,
                'message' => 'Coupon "' . strtoupper($request->code) . '" is invalid or expired.'
            ]);
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

        // احسبي الخصم عشان نرجعه للـ JS
        // بنحتاج السبتوتال — بنبعثه من الـ JS
        $subtotal = $request->subtotal ?? 0;
        $discount = 0;
        if ($subtotal >= $coupon->min_order) {
            if ($coupon->type === 'percentage') {
                $discount = round($subtotal * ($coupon->value / 100), 2);
            } else {
                $discount = min($coupon->value, $subtotal);
            }
        }

        return response()->json([
            'success'  => true,
            'message'  => 'Coupon "' . $coupon->code . '" applied!',
            'code'     => $coupon->code,
            'discount' => number_format($discount, 2),
            'total'    => number_format($subtotal - $discount, 2),
        ]);
    }

    public function remove()
    {
        session()->forget('coupon');
        return back()->with('coupon_success', 'Coupon removed.');
    }
}
