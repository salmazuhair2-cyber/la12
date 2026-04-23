<x-site>
    <section class="checkout-section">
        <div class="spacial-content">
            <h1>My Checkout</h1>
        </div>
        <form action="{{ route('website.orders.store') }}" method="POST" class="form">
            @csrf
            <div class="container grid">
                <div class="checkout-group">
                    <h3 class="section-title">Billing Details</h3>
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
                                <td colspan="2"><span class="table-price" id="checkout-subtotal">${{ number_format($subtotal, 2) }}</span></td>
                            </tr>
                            <tr>
                                <td><span class="order-subtitle">Shipping</span></td>
                                <td colspan="2"><span class="table-price">Free Shipping</span></td>
                            </tr>
                            <tr>
                                <td><span class="order-subtitle">Total</span></td>
                                <td colspan="2"><span class="order-grand-total" id="checkout-total">${{ number_format($subtotal, 2) }}</span></td>
                            </tr>
                        </tbody>
                    </table>

                    <div class="payment-method">
                        <h3 class="checkout-title payment-title">Payment</h3>
                        <div class="payment-option flex">
                            <input type="radio" name="payment_method" value="bank" checked class="payment-input">
                            <label class="payment-label">Direct Bank Transfer</label>
                        </div>
                        <div class="payment-option flex">
                            <input type="radio" name="payment_method" value="check" class="payment-input">
                            <label class="payment-label">Checked Payment</label>
                        </div>
                        <div class="payment-option flex">
                            <input type="radio" name="payment_method" value="paypal" class="payment-input">
                            <label class="payment-label">Paypal</label>
                        </div>
                    </div>

                    <div class="add place">
                        <button type="submit" class="shopping-cart">Place Order</button>
                    </div>
                </div>
            </div>
        </form>
    </section>
</x-site>