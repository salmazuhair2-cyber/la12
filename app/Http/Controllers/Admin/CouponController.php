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

    public function create()
    {
        $coupon = new Coupon();
        $existingCodes = Coupon::pluck('code')->toArray();
        return view('dashboard.coupons.create', compact('coupon', 'existingCodes'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'code'      => 'required|unique:coupons,code',
            'type'      => 'required|in:percentage,fixed',
            'value'     => 'required|numeric|min:1',
            'min_order' => 'nullable|numeric',
            'max_uses'  => 'nullable|integer',
            'expires_at' => 'nullable|date',
        ]);

        Coupon::create([
            'code'       => strtoupper($request->code),
            'type'       => $request->type,
            'value'      => $request->value,
            'min_order'  => $request->min_order ?? 0,
            'max_uses'   => $request->max_uses,
            'expires_at' => $request->expires_at,
            'is_active'  => true,
        ]);

        return redirect()->route('admin.coupons.index')->with('alert', [
            'action'         => 'create',
            'message'        => 'Coupon created successfully!',
            'back_route'     => route('admin.coupons.index'),
            'continue_route' => route('admin.coupons.create'),
        ]);
    }

    public function edit(Coupon $coupon)
    {
        return view('dashboard.coupons.edit', compact('coupon'));
    }

    public function update(Request $request, Coupon $coupon)
    {
        $request->validate([
            'code'      => 'required|unique:coupons,code,' . $coupon->id,
            'type'      => 'required|in:percentage,fixed',
            'value'     => 'required|numeric|min:1',
            'min_order' => 'nullable|numeric',
            'max_uses'  => 'nullable|integer',
            'expires_at' => 'nullable|date',
        ]);

        $coupon->update([
            'code'       => strtoupper($request->code),
            'type'       => $request->type,
            'value'      => $request->value,
            'min_order'  => $request->min_order ?? 0,
            'max_uses'   => $request->max_uses,
            'expires_at' => $request->expires_at,
            'is_active'  => $request->has('is_active'),
        ]);

        return redirect()->route('admin.coupons.index')->with('alert', [
            'action'         => 'update',
            'message'        => 'Coupon updated successfully!',
            'back_route'     => route('admin.coupons.index'),
            'continue_route' => route('admin.coupons.edit', $coupon),
        ]);
    }

    public function destroy(Coupon $coupon)
    {
        $coupon->delete();

        return redirect()->route('admin.coupons.index')->with('alert', [
            'action'         => 'delete',
            'message'        => 'Coupon deleted successfully!',
            'back_route'     => route('admin.coupons.index'),
            'continue_route' => null,
        ]);
    }
}
