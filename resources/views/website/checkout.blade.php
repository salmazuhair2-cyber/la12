<x-site>
    <section class="checkout-section">
        <div class="spacial-content">
            <h1>My Checkout</h1>
        </div>

        <form action="{{ route('website.orders.store') }}" method="POST" class="form">
            @csrf
            <div class="container grid">

                {{-- GROUP 1: Delivery --}}
                <div class="checkout-group">
                    <div class="checkout-card-header">
                        <span class="checkout-step">1</span>
                        <div>
                            <h3 class="section-title">Delivery Information</h3>
                            <p class="checkout-muted">Tell us where to deliver your order.</p>
                        </div>
                    </div>
                    <div class="grid">
                        <input type="text" name="name" value="{{ old('name') }}" placeholder="Name" class="form-input" required>
                        <input type="text" name="address" value="{{ old('address') }}" placeholder="Address" class="form-input" required>
                        <input type="text" name="city" value="{{ old('city') }}" placeholder="City" class="form-input" required>
                        <input type="text" name="country" value="{{ old('country') }}" placeholder="Country" class="form-input" required>
                        <input type="text" name="postcode" value="{{ old('postcode') }}" placeholder="Postcode" class="form-input">
                        <input type="text" name="phone" value="{{ old('phone') }}" placeholder="Phone" class="form-input" required>
                        <input type="email" name="email" value="{{ old('email') }}" placeholder="Email" class="form-input" required>
                        <h3 class="checkout-title">Additional Information</h3>
                        <textarea name="note" placeholder="Order note" class="form-input textarea">{{ old('note') }}</textarea>
                    </div>
                </div>

                {{-- GROUP 2: Cart + Payment --}}
                <div class="checkout-group">
                    <h3 class="section-title">Cart Totals</h3>

                    @if ($cartItems->isEmpty())
                    <p id="no-product-msg">No Product in The Cart...</p>
                    @endif

                    @php
                    $subtotal = 0;
                    foreach ($cartItems as $item) {
                    $subtotal += $item->price * $item->quantity;
                    }
                    $discount = 0;
                    $coupon = session('coupon');
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
                    @endphp

                    <table class="order-table" id="order-table">
                        <tbody>
                            <tr>
                                <th colspan="2">Products</th>
                                <th>Total</th>
                            </tr>

                            @foreach ($cartItems as $item)
                            @php $itemTotal = $item->price * $item->quantity; @endphp
                            <tr>
                                <td><img src="{{ $item->product->img_path }}" alt="{{ $item->product->name }}" class="order-img"></td>
                                <td>
                                    <h3 class="order-title">{{ $item->product->name }}</h3>
                                    <p class="table-quality">x {{ $item->quantity }}</p>
                                </td>
                                <td><span class="table-price">{{ number_format($itemTotal, 2) }}₪</span></td>
                            </tr>
                            @endforeach

                            <tr>
                                <td><span class="order-subtitle">SubTotal</span></td>
                                <td colspan="2"><span class="table-price">{{ number_format($subtotal, 2) }}₪</span></td>
                            </tr>

                            @if($discount > 0)
                            <tr>
                                <td><span class="order-subtitle" style="color:#55aade;">Discount ({{ session('coupon.code') }})</span></td>
                                <td colspan="2"><span style="color:#55aade; font-weight:700;">- {{ number_format($discount, 2) }}₪</span></td>
                            </tr>
                            @endif

                            <tr>
                                <td><span class="order-subtitle">Shipping</span></td>
                                <td colspan="2"><span class="table-price">Free Shipping</span></td>
                            </tr>

                            <tr>
                                <td><span class="order-subtitle">Total</span></td>
                                <td colspan="2"><span class="order-grand-total">{{ number_format($total, 2) }}₪</span></td>
                            </tr>
                        </tbody>
                    </table>

                    {{-- COUPON --}}
                    <div style="margin: 20px 0;">
                        @if(session('coupon'))
                        <div style="background:#f0fff4; border:1px solid #55aade; border-radius:8px; padding:12px 16px; margin-bottom:12px; display:flex; justify-content:space-between; align-items:center;">
                            <div>
                                <span style="font-weight:700; color:#55aade;">✓ Coupon Applied:</span>
                                <span style="font-weight:600; margin-left:6px;">{{ session('coupon.code') }}</span>
                                <span style="color:#888; font-size:13px; margin-left:8px;">
                                    @if(session('coupon.type') === 'percentage')
                                    ({{ session('coupon.value') }}% off)
                                    @else
                                    ({{ number_format(session('coupon.value'), 2) }}₪ off)
                                    @endif
                                </span>
                            </div>
                            {{-- فورم منفصلة للإزالة --}}
                            <button type="button"
                                onclick="document.getElementById('remove-coupon-form').submit()"
                                style="background:none; border:none; color:#e55353; cursor:pointer; font-size:18px; font-weight:700;">✕</button>
                        </div>
                        @endif

                        @if(session('coupon_error'))
                        <div style="background:#ffebee; color:#d32f2f; padding:10px 14px; border-radius:8px; margin-bottom:12px; font-size:14px;">
                            ✕ {{ session('coupon_error') }}
                        </div>
                        @endif

                        @if(session('coupon_success'))
                        <div style="background:#f0fff4; color:#2e7d32; padding:10px 14px; border-radius:8px; margin-bottom:12px; font-size:14px;">
                            ✓ {{ session('coupon_success') }}
                        </div>
                        @endif

                        @if(!session('coupon'))
                        <p style="font-size:14px; margin-bottom:10px;">
                            <span style="color:#55aade; cursor:pointer; text-decoration:underline;"
                                onclick="document.getElementById('coupon-box').style.display='block'; this.parentElement.style.display='none';">
                                🏷️ Have a coupon? Click here
                            </span>
                        </p>
                        <div id="coupon-box" style="display:none; margin-bottom:10px;">
                            {{-- hidden input عشان نبعث الكوبون كـ field في الفورم الرئيسية --}}
                            <div style="display:flex; gap:8px;">
                                <input type="text" id="coupon-input" placeholder="Enter coupon code"
                                    class="form-input" style="flex:1; text-transform:uppercase;">
                                <button type="button" onclick="submitCoupon()"
                                    style="padding:10px 20px; background:#ff3496; color:#fff; border:none; border-radius:8px; cursor:pointer; font-weight:600; white-space:nowrap;">
                                    Apply
                                </button>
                            </div>
                        </div>
                        @endif
                    </div>

                    {{-- PAYMENT --}}
                    <div class="payment-method">
                        <div class="checkout-card-header">
                            <span class="checkout-step">2</span>
                            <div>
                                <h3 class="checkout-title payment-title">Payment Method</h3>
                                <p class="checkout-muted">Choose how you want to pay.</p>
                            </div>
                        </div>

                        <div class="payment-option flex">
                            <input type="radio" name="payment_method" value="cash" checked class="payment-input" onchange="togglePaymentInfo()">
                            <label class="payment-label">Cash on Delivery - الدفع عند الاستلام</label>
                        </div>
                        <div class="payment-option flex">
                            <input type="radio" name="payment_method" value="mahwazti" class="payment-input" onchange="togglePaymentInfo()">
                            <label class="payment-label">محفظتي</label>
                        </div>
                        <div class="payment-option flex">
                            <input type="radio" name="payment_method" value="bank_of_palestine" class="payment-input" onchange="togglePaymentInfo()">
                            <label class="payment-label">Bank of Palestine - بنك فلسطين</label>
                        </div>
                        <div class="payment-option flex">
                            <input type="radio" name="payment_method" value="arab_islamic_bank" class="payment-input" onchange="togglePaymentInfo()">
                            <label class="payment-label">Arab Islamic Bank - البنك العربي الإسلامي</label>
                        </div>

                        <div id="payment-info" style="display:none; margin-top:15px;">
                            <p><strong>Payment Instructions:</strong></p>
                            <p id="payment-instructions"></p>
                            <input type="text" name="transaction_number" id="transaction_number"
                                class="form-input" placeholder="Transaction / Transfer Number">
                        </div>
                    </div>

                    <div class="add place">
                        <button type="submit" class="shopping-cart">Place Order</button>
                    </div>

                </div>
            </div>
        </form>

        {{-- فورم منفصلة لإزالة الكوبون --}}
        <form id="remove-coupon-form" action="{{ route('coupon.remove') }}" method="POST" style="display:none;">
            @csrf
        </form>

        {{-- فورم منفصلة لتطبيق الكوبون --}}
        <form id="apply-coupon-form" action="{{ route('coupon.apply') }}" method="POST" style="display:none;">
            @csrf
            <input type="hidden" name="code" id="coupon-code-hidden">
        </form>

    </section>

    <script>
        function submitCoupon() {
            const code = document.getElementById('coupon-input').value.trim();
            if (!code) return;

            // خذي الـ subtotal من الصفحة
            const subtotalText = document.getElementById('checkout-subtotal').innerText.replace('₪', '').replace(',', '');
            const subtotal = parseFloat(subtotalText) || 0;

            fetch("{{ route('coupon.apply') }}", {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                        'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
                    },
                    body: JSON.stringify({
                        code: code,
                        subtotal: subtotal
                    })
                })
                .then(res => res.json())
                .then(data => {
                    if (data.success) {
                        document.getElementById('coupon-success-msg').style.display = 'block';
                        document.getElementById('coupon-success-msg').innerText = '✓ ' + data.message;
                        document.getElementById('coupon-error-msg').style.display = 'none';
                        document.getElementById('coupon-box').style.display = 'none';
                        document.getElementById('discount-row').style.display = 'table-row';
                        document.getElementById('discount-amount').innerText = '- ' + data.discount + '₪';
                        document.getElementById('discount-code').innerText = 'Discount (' + data.code + ')';
                        document.getElementById('checkout-total').innerText = data.total + '₪';
                    } else {
                        document.getElementById('coupon-error-msg').style.display = 'block';
                        document.getElementById('coupon-error-msg').innerText = '✕ ' + data.message;
                        document.getElementById('coupon-success-msg').style.display = 'none';
                    }
                });
        }
    </script>

</x-site>