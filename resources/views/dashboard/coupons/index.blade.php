<x-dashboard title="Coupons">

    <a class="back-button" href="{{ route('admin.coupons.create') }}">
        <i class="fas fa-plus"></i>
        <span>Add Coupon</span>
    </a>

    <section class="all-cart-section coupons-page">
        <div class="container">

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
                        <th>Actions</th>
                    </tr>
                </thead>

                <tbody>
                    @forelse($coupons as $coupon)
                    <tr>
                        <td>{{ $coupon->code }}</td>
                        <td>{{ ucfirst($coupon->type) }}</td>

                        <td>
                            {{ $coupon->type == 'percentage'
                            ? $coupon->value.'%'
                            : '₪'.$coupon->value }}
                        </td>

                        <td>₪{{ $coupon->min_order }}</td>

                        <td>
                            {{ $coupon->used_count }}
                            /
                            {{ $coupon->max_uses ?? '∞' }}
                        </td>

                        <td>
                            {{ $coupon->expires_at ?? 'No expiry' }}
                        </td>

                        <td>
                            {{ $coupon->is_active ? 'Active' : 'Inactive' }}
                        </td>

                        <td class="actions">

                            <form action="{{ route('admin.coupons.destroy',$coupon) }}"
                                method="POST"
                                style="display:inline;">
                                @csrf
                                @method('DELETE')

                                <button type="submit">
                                    <i class="fas fa-trash"></i>
                                    Delete
                                </button>
                            </form>

                        </td>
                    </tr>

                    @empty
                    <tr>
                        <td colspan="8">
                            No Coupons Found
                        </td>
                    </tr>
                    @endforelse

                </tbody>

            </table>

        </div>
    </section>
    ```

</x-dashboard>