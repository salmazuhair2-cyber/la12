<x-site>
  <div class="view" id="product" style="transform: translateY(7%);">
    <div class="spacial-content">
      <h1 id="font">Our various departments</h1>
      <p>In our store, you will find a wide range of clothing,
        accessories, shoes and bags for men and women, carefully selected to
        meet the needs of everyone.</p>
    </div>
    <div class="container grid">
      <div class="image">
        <a href="{{ route('website.products.index', ['category' => 'Clothing']) }}">
          <img src="{{ asset('web/images/view1.png') }}" alt="" />
          <button class="button">Clothings</button>
        </a>
      </div>
      <div class="image">
        <a href="{{ route('website.products.index', ['category' => 'Shoes']) }}">
          <img src="{{ asset('web/images/view2.png') }}" alt="" />
          <button class="button">Shoes</button>
        </a>
      </div>
      <div class="image">
        <a href="{{ route('website.products.index', ['category' => 'Glasses']) }}">
          <img src="{{ asset('web/images/view3.png') }}" alt="" />
          <button class="button">Sun Glasses</button>
        </a>
      </div>
      <div class="image">
        <a href="{{ route('website.products.index', ['category' => 'Accessories']) }}">
          <img src="{{ asset('web/images/view6.png') }}" alt="" />
          <button class="button">Accessories</button>
        </a>
      </div>
      <div class="image">
        <a href="{{ route('website.products.index', ['category' => 'MakeUp']) }}">
          <img src="{{ asset('web/images/view5.png') }}" alt="" />
          <button class="button">MakeUp</button>
        </a>
      </div>
      <div class="image">
        <a href="{{ route('website.products.index', ['category' => 'HandBag']) }}">
          <img src="{{ asset('web/images/view4.png') }}" alt="" />
          <button class="button">HandBag</button>
        </a>
      </div>
    </div>
  </div>
</x-site>