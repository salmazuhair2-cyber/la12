<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Coupon;
use Illuminate\Http\Request;

class CouponController extends Controller
{
    public function index()
    {
        $coupons = Coupon::latest()->paginate(10);
        return view('dashboard.coupons.index', compact('coupons'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'code' => 'required|unique:coupons,code',
            'type' => 'required|in:percentage,fixed',
            'value' => 'required|numeric|min:1',
            'min_order' => 'nullable|numeric',
            'max_uses' => 'nullable|integer',
            'expires_at' => 'nullable|date',
        ]);

        Coupon::create([
            'code' => strtoupper($request->code),
            'type' => $request->type,
            'value' => $request->value,
            'min_order' => $request->min_order ?? 0,
            'max_uses' => $request->max_uses,
            'expires_at' => $request->expires_at,
            'is_active' => true,
        ]);

        return redirect()->back()->with('success', 'Coupon created!');
    }

    public function destroy(Coupon $coupon)
    {
        $coupon->delete();
        return redirect()->back()->with('success', 'Coupon deleted!');
    }
}
