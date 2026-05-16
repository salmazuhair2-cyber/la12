<x-site>
    <section class="checkout-section">
        <div class="spacial-content">
            <h1>My Checkout</h1>
        </div>

        <form action="{{ route('website.orders.store') }}" method="POST" class="form">
            @csrf

            <div class="container grid">
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

                <div class="checkout-group">
                    <h3 class="section-title">Cart Totals</h3>

                    @if ($cartItems->isEmpty())
                    <p id="no-product-msg">No Product in The Cart...</p>
                    @endif

                    <table class="order-table" id="order-table">
                        <tbody>
                            <tr>
                                <th colspan="2">Products</th>
                                <th>Total</th>
                            </tr>

                            @php $subtotal = 0; @endphp

                            @foreach ($cartItems as $item)
                            @php
                            $total = $item->price * $item->quantity;
                            $subtotal += $total;
                            @endphp

                            <tr>
                                <td>
                                    <img src="{{ $item->product->img_path }}" alt="{{ $item->product->name }}" class="order-img">
                                </td>
                                <td>
                                    <h3 class="order-title">{{ $item->product->name }}</h3>
                                    <p class="table-quality">x {{ $item->quantity }}</p>
                                </td>
                                <td>
                                    <span class="table-price">${{ number_format($total, 2) }}</span>
                                </td>
                            </tr>
                            @endforeach

                            <tr>
                                <td><span class="order-subtitle">SubTotal</span></td>
                                <td colspan="2">
                                    <span class="table-price" id="checkout-subtotal">${{ number_format($subtotal, 2) }}</span>
                                </td>
                            </tr>

                            <tr>
                                <td><span class="order-subtitle">Shipping</span></td>
                                <td colspan="2"><span class="table-price">Free Shipping</span></td>
                            </tr>

                            <tr>
                                <td><span class="order-subtitle">Total</span></td>
                                <td colspan="2">
                                    <span class="order-grand-total" id="checkout-total">${{ number_format($subtotal, 2) }}</span>
                                </td>
                            </tr>
                        </tbody>
                    </table>

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

                            <input type="text"
                                name="transaction_number"
                                id="transaction_number"
                                class="form-input"
                                placeholder="Transaction / Transfer Number">
                        </div>
                    </div>

                    <div class="add place">
                        <button type="submit" class="shopping-cart">Place Order</button>
                    </div>
                </div>
            </div>
        </form>
    </section>

    <script>
        function togglePaymentInfo() {
            const method = document.querySelector('input[name="payment_method"]:checked').value;
            const box = document.getElementById('payment-info');
            const instructions = document.getElementById('payment-instructions');
            const transactionInput = document.getElementById('transaction_number');

            if (method === 'cash') {
                box.style.display = 'none';
                transactionInput.removeAttribute('required');
                transactionInput.value = '';
                return;
            }

            box.style.display = 'block';
            transactionInput.setAttribute('required', 'required');

            if (method === 'mahwazti') {
                instructions.innerHTML = 'حوّلي المبلغ عبر محفظتي إلى الرقم: <strong>0590000000</strong> ثم أدخلي رقم العملية.';
            } else if (method === 'bank_of_palestine') {
                instructions.innerHTML = 'حوّلي المبلغ عبر تطبيق بنك فلسطين إلى الحساب: <strong>000000000</strong> ثم أدخلي رقم العملية.';
            } else if (method === 'arab_islamic_bank') {
                instructions.innerHTML = 'حوّلي المبلغ عبر تطبيق البنك العربي الإسلامي إلى الحساب: <strong>000000000</strong> ثم أدخلي رقم العملية.';
            }
        }
    </script>
</x-site>