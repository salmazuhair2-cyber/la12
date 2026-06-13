<x-dashboard title="Add Coupon">
    @if ($errors->any())
    <div class="alert alert-danger">
        {{ $errors->first() }}
    </div>
    @endif
    <a class="back-button" href="{{ route('admin.coupons.index') }}">
        <i class="fas fa-long-arrow-left"></i>
        <span>All Coupons</span>
    </a>

    <section class="addProduct">
        <div class="container">
            <div class="product-group">

                <form action="{{ route('admin.coupons.store') }}"
                    method="POST"
                    class="form grid">

                    @csrf

                    <div class="form-row">
                        <div class="form-item">
                            <label>Coupon Code</label>

                            <input type="text"
                                name="code"
                                value="{{ old('code') }}"
                                class="form-input">
                        </div>
                    </div>

                    <div class="form-col" style="display:flex; gap:5%;">

                        <div class="form-item">
                            <label>Type</label>

                            <select name="type" class="form-input">
                                <option value="percentage">Percentage %</option>
                                <option value="fixed">Fixed ₪</option>
                            </select>
                        </div>

                        <div class="form-item">
                            <label>Value</label>

                            <input type="number"
                                name="value"
                                value="{{ old('value') }}"
                                class="form-input">
                        </div>

                    </div>

                    <div class="form-col" style="display:flex; gap:5%;">

                        <div class="form-item">
                            <label>Minimum Order</label>

                            <input type="number"
                                name="min_order"
                                value="{{ old('min_order') }}"
                                class="form-input">
                        </div>

                        <div class="form-item">
                            <label>Max Uses</label>

                            <input type="number"
                                name="max_uses"
                                value="{{ old('max_uses') }}"
                                class="form-input">
                        </div>

                    </div>

                    <div class="form-row">
                        <div class="form-item">
                            <label>Expiry Date</label>

                            <input type="date"
                                name="expires_at"
                                class="form-input">
                        </div> 
                    </div>

                    <div class="form-row">
                        <div class="form-item add">
                            <button type="submit" class="add">
                                ➕  Add Coupon
                            </button>
                        </div>
                    </div>

                </form>

            </div>
        </div>
    </section>

</x-dashboard>