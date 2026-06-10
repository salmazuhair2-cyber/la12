@extends('components.dashboard')

@section('content')
<div class="card">
    <h2>Coupons</h2>

    @if(session('success'))
    <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <form action="{{ route('admin.coupons.store') }}" method="POST" style="display:flex; gap:10px; flex-wrap:wrap; margin-bottom:20px;">
        @csrf
        <input type="text" name="code" placeholder="Code e.g. SAVE10" class="form-input" required style="width:150px;">
        <select name="type" class="form-input" style="width:130px;">
            <option value="percentage">Percentage %</option>
            <option value="fixed">Fixed ₪</option>
        </select>
        <input type="number" name="value" placeholder="Value" class="form-input" required style="width:100px;">
        <input type="number" name="min_order" placeholder="Min Order" class="form-input" style="width:120px;">
        <input type="number" name="max_uses" placeholder="Max Uses" class="form-input" style="width:100px;">
        <input type="date" name="expires_at" class="form-input" style="width:150px;">
        <button type="submit" class="btn" style="background:#fa1a8a; color:white; padding:10px 20px; border:none; border-radius:5px; cursor:pointer;">Add Coupon</button>
    </form>

    <table class="table">
        <thead>
            <tr>
                <th>Code</th>
                <th>Type</th>
                <th>Value</th>
                <th>Min Order</th>
                <th>Uses</th>
                <th>Expires</th>
                <th>Status</th>
                <th>Action</th>
            </tr>
        </thead>
        <tbody>
            @forelse($coupons as $coupon)
            <tr>
                <td><strong>{{ $coupon->code }}</strong></td>
                <td>{{ $coupon->type }}</td>
                <td>{{ $coupon->type == 'percentage' ? $coupon->value.'%' : '₪'.$coupon->value }}</td>
                <td>₪{{ $coupon->min_order }}</td>
                <td>{{ $coupon->used_count }} / {{ $coupon->max_uses ?? '∞' }}</td>
                <td>{{ $coupon->expires_at ?? 'No expiry' }}</td>
                <td>{{ $coupon->is_active ? '✅' : '❌' }}</td>
                <td>
                    <form action="{{ route('admin.coupons.destroy', $coupon) }}" method="POST">
                        @csrf @method('DELETE')
                        <button type="submit" style="background:red; color:white; border:none; padding:5px 10px; border-radius:5px; cursor:pointer;">Delete</button>
                    </form>
                </td>
            </tr>
            @empty
            <tr>
                <td colspan="8">No coupons yet.</td>
            </tr>
            @endforelse
        </tbody>
    </table>
</div>
@endsection