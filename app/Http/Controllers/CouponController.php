<?php

namespace App\Http\Controllers;

use App\Models\Coupon;
use Illuminate\Http\Request;

class CouponController extends Controller
{
    public function apply(Request $request)
    {
        $request->validate([
            'code' => 'required|string',
        ]);

        $coupon = Coupon::where('code', strtoupper($request->code))->first();

        if (!$coupon || !$coupon->isValid()) {
            return back()->with('coupon_error', 'Invalid or expired coupon code.');
        }

        // احفظ الكوبون في الـ session
        session([
            'coupon' => [
                'code'  => $coupon->code,
                'type'  => $coupon->type,
                'value' => $coupon->value,
                'min_order' => $coupon->min_order,
                'id'    => $coupon->id,
            ]
        ]);

        return back()->with('coupon_success', 'Coupon applied successfully!');
    }

    public function remove()
    {
        session()->forget('coupon');
        return back()->with('coupon_success', 'Coupon removed.');
    }
}
