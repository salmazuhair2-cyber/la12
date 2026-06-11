<x-site>
  <section class="cart-section">
    <div class="spacial-content">
      <h1>My Cart</h1>
    </div>
    <div class="container">
      <div class="table-container">
        <table class="table" id="cart-table">
          <thead>
            <tr>
              <th>Image</th>
              <th>Name Product</th>
              <th>Price</th>
              <th>Quantity</th>
              <th>Subtotal</th>
              <th>Remove</th>
            </tr>
          </thead>
          <tbody id="cart-table-body">
            @php $subtotal = 0; @endphp

            @forelse($cart as $id => $item)
            @php
            $itemSubtotal = $item['price'] * $item['quantity'];
            $subtotal += $itemSubtotal;
            @endphp
            <tr>
              <td>
                <img src="{{ asset($item['image']) }}" alt="{{ $item['name'] }}" width="50">
              </td>
              <td>{{ $item['name'] }}</td>
              <td>${{ number_format($item['price'], 2) }}</td>
              <td>
                <div class="counter">
                  <button class="decrement" onclick="updateQuantity('{{ $id }}', -1)">-</button>
                  <input type="number" class="counterValue" value="{{ $item['quantity'] }}" min="1" readonly>
                  <button class="increment" onclick="updateQuantity('{{ $id }}', 1)">+</button>
                </div>
              </td>


              <td id="cart-subTotal">${{ number_format($itemSubtotal, 2) }}</td>
              <td>
                <i class="fa-solid fa-trash table-trash" onclick="removeFromCart({{ $id }})"></i>
              </td>
            </tr>
            @empty
            <tr>
              <td colspan="6">Your cart is empty.</td>
            </tr>
            @endforelse
          </tbody>
        </table>


        <div class="add">
          <a href="{{ route('website.index') }}">
            <button class="shopping-cart">
              <i class="fa-solid fa-shuffle"></i>
              Back To Home
            </button>
          </a>
          <a href="{{ route('website.products.index') }}">
            <button>
              <i class="fas fa-shopping-cart"></i> Continue Shopping
            </button>
          </a>
        </div>
      </div>

      <div class="spacial-content">
        <h1><span></span><span></span><span></span><span></span></h1>
      </div>
      <div class="cart-group grid">
        <div>
          <div class="cart-shipping">
            <h3 class="section-title">Calculate Shipping</h3>
            <form action="" class="form grid">
              <div class="city">
                <input type="text" placeholder="State / Country" class="form-input" name="shipping_address" />
                <i class="fas fa-map-marker-alt form-icon"></i>
              </div>
              <div class="form-group grid">
                <div class="city">
                  <input type="text" placeholder="City" class="form-input" name="city" />
                  <i class="fas fa-flag form-icon"></i>
                </div>
                <input type="text" placeholder="PostCode / ZIP" class="form-input" name="postcode" />
              </div>
              <div class="add">
                <button class="shopping-cart">
                  <i class="fa-solid fa-shuffle"></i>
                  Update
                </button>
              </div>
            </form>
          </div>


          <div class="form-group">

            <div class="add">

            </div>
          </div>
          </form>
        </div>
      </div>

      <div class="cart-total">
        <h3 class="section-title">Cart Totals</h3>
        <table class="cart-total-table">
          <tr>
            <td><span class="cart-total-section">Cart Subtotal</span></td>
            <td><span id="cart-items-subtotal" class="cart-total-price">${{ number_format($subtotal, 2) }}</span></td>
          </tr>
          <tr>
            <td><span class="cart-total-section">Shipping</span></td>
            <td><span id="shipping-cost" class="cart-total-price">Free Shipping</span></td>
          </tr>
          <tr>
            <td><span class="cart-total-section">Total</span></td>
            <td><span id="cart-total" class="cart-total-price">${{ number_format($subtotal, 2) }}</span></td>
          </tr>
        </table>
        <a href="{{ route('website.checkout') }}" class="add">
          <button class="shopping-cart">
            <i class="fa-solid fa-money-check-dollar"></i>
            Proceed To Checkout
          </button>
        </a>
      </div>
    </div>
    </div>
  </section>
</x-site>