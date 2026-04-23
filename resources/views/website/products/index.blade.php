@php
$items = auth()->check()
? \App\Models\Cart::with('product')
->where('user_id', auth()->id())
->get()
: collect();
$subtotal = $items->sum(function ($item) {
return $item->price * $item->quantity;
});
$wishlistItems = auth()->check() ? auth()->user()->wishlist()->with('product')->get() : collect();
$subtotalWishlist = $wishlistItems->sum(function ($item) {
return $item->product->price;
});
@endphp
<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>{{ config('app.name') }}</title>
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <link rel="stylesheet" href="{{ asset('web/css/style.css') }}?v={{ time() }}">
    <link rel="stylesheet" href="{{ asset('web/CSS/normalize.css') }}" />
    <link rel="stylesheet" href="{{ asset('web/CSS/all.min.css') }}" />
    <link rel="preconnect" href="https://fonts.googleapis.com" />
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
    <link href="https://fonts.googleapis.com/css2?family=Cairo:wght@200..1000&family=Concert+One&family=Open+Sans:ital,wght@0,300..800;1,300..800&family=Roboto:ital,wght@0,100;0,300;0,400;0,500;0,700;0,900;1,100;1,300;1,400;1,500;1,700;1,900&family=Work+Sans:ital,wght@0,100..900;1,100..900&display=swap" rel="stylesheet" />
    <script src="https://kit.fontawesome.com/c1a12a9bed.js" crossorigin="anonymous"></script>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons/font/bootstrap-icons.css" rel="stylesheet" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css">
</head>

<body>
    <!-- Start Header -->
    <header>
        <div class="container">
            <a href="{{ route('website.index') }}"><img class="image" src="{{ asset('web/images/logo2.png') }}" alt="logo" /></a>
            <div class="menu-toggle">
                <i class="fa-solid fa-bars-staggered" id="open-btn"></i>
            </div>
            <div class="overlay" id="overlay"></div>
            <div class="sidebar" id="sidebar">
                <div class="quick-navigation">
                    <p><i class="icon" id="close-btn">&times;</i> Quick Navigation</p>
                </div>
                <div class="search-container2">
                    <input type="text" class="searchBox" placeholder="Search..." />
                    <i class="bi bi-search" id="searchBtn1"></i>
                </div>
                <div class="tab-buttons">
                    <button id="mobile-menu-btn" class="tab active">Mobile Menu</button>
                    <button id="categories-btn" class="tab">Categories</button>
                </div>
                <ul class="menu" id="mobile-menu">
                    <li><a href="{{ route('website.index') }}">Home</a></li>
                    <li><a href="{{ route('website.products.index') }}">Products</a></li>
                    <li>
                        <a href="#">My Account <span class="toggle" data-target="account-options">+</span></a>
                        <ul class="submenu" id="account-options">
                            <li><a href="{{ route('website.cart.index') }}"><i class="fas fa-chevron-right icon"></i> My Cart</a></li>
                            <li><a href="{{ route('website.checkout') }}"><i class="fas fa-chevron-right icon"></i> My Checkout</a></li>
                            <li><a href="{{ route('website.wishlist.index') }}"><i class="fas fa-chevron-right icon"></i> My Wishlist</a></li>
                        </ul>
                    </li>
                </ul>
                <div class="social-links">
                    <a href="https://x.com/Shatha72401840" target="_blank"><i class="fab fa-twitter"></i></a>
                    <a href="https://www.facebook.com/share/161bfAfvt4/" target="_blank"><i class="fab fa-facebook"></i></a>
                    <a href="https://myaccount.google.com/" target="_blank"><i class="fab fa-google"></i></a>
                </div>
            </div>

            <ul class="nav">
                <li><a href="{{ route('website.index') }}">Home</a></li>
                <li><a href="{{ route('website.products.index') }}" class="active">Products</a></li>
                <li class="dropdown">
                    <a href="{{ route('website.products.index') }}">Shop <i class="fas fa-chevron-down"></i></a>
                    <div class="mega-menu">
                        <ul class="column">
                            <h3>Shop Page</h3>
                            <li><a href="{{ route('website.cart.index') }}">My Cart</a></li>
                            <li><a href="{{ route('website.checkout') }}">My Checkout</a></li>
                            <li><a href="{{ route('website.wishlist.index') }}">My Wishlist</a></li>
                        </ul>
                        <div class="best-sellers">
                            <h3>Best Sellers</h3>
                            <div class="product">
                                <img src="{{ asset('web/images/shoes10.png') }}" alt="Plain brown shoes" />
                                <div class="info">
                                    <p>Plain brown shoes</p>
                                    <div class="price">$75.00</div>
                                </div>
                            </div>
                            <div class="product">
                                <img src="{{ asset('web/images/shoes5.png') }}" alt="comfortable shoes" />
                                <div class="info">
                                    <p>comfortable shoes</p>
                                    <div class="price">$80.00</div>
                                </div>
                            </div>
                        </div>
                    </div>
                </li>
                <li><a href="{{ route('website.about') }}">About</a></li>
                <li><a href="{{ route('website.contact') }}">Contact</a></li>
            </ul>

            <div class="icons">
                @auth
                <div class="user-dropdown">
                    <a href="#" class="profile-link">
                        <i class="bi bi-person" id="profile-icon"></i>
                        <span class="username">{{ Auth::user()->name }}</span>
                    </a>
                    <div class="dropdown-content">
                        <a href="{{ route('website.wishlist.index') }}"><i class="bi bi-heart"></i> My Wishlist</a>
                        <form action="{{ route('customer.logout') }}" method="POST" class="logout-form">
                            @csrf
                            <button type="submit"><i class="bi bi-box-arrow-right"></i> Logout</button>
                        </form>
                    </div>
                </div>
                @else
                <a href="{{ route('customer.login') }}"><i class="bi bi-person" id="profile-icon"></i></a>
                @endauth

                @include('website.wishlist.wishlist-mnue')
                @include('website.carts.cart-mnue')

                <i class="bi bi-search" id="searchBtn"></i>
                <div class="search-container">
                    <div class="boxSearch" id="searchBox">
                        <input type="text" placeholder="Type your search..." />
                        <select>
                            <option value="Category">Select Category</option>
                            <option value="Bracelets">Bracelets</option>
                            <option value="clothing">clothing</option>
                            <option value="Coats & Jackets">Coats & Jackets</option>
                            <option value="HandBag">HandBag</option>
                        </select>
                        <button id="closeBtn" class="closeBtn">
                            <i class="fas fa-times"></i>
                        </button>
                    </div>
                </div>
            </div>

            <div class="contact">
                <a href="https://x.com/Shatha72401840" target="_blank"><i class="fab fa-twitter"></i></a>
                <a href="https://www.facebook.com/share/161bfAfvt4/" target="_blank"><i class="fab fa-facebook"></i></a>
                <a href="https://myaccount.google.com/" target="_blank"><i class="fab fa-google"></i></a>
            </div>
        </div>
    </header>
    <!-- End Header -->

    <div class="all-products">
        <button id="top-btn"><i class="fa-solid fa-arrow-up"></i></button>
        <div class="scroll"></div>
        <div class="side">
            @if ($category)
            <h3>Products For {{ $category->name }} Category</h3>
            @else
            <h3>All Products</h3>
            @endif

            <ul class="menu" id="mobile-menu">
                <li>
                    <a href="{{ route('website.products.index', ['category' => $category?->id, 'gender' => 'all']) }}">All</a>
                </li>
                <li>
                    <a href="{{ route('website.products.index', ['category' => $category?->id, 'gender' => 'women']) }}">
                        Women's
                    </a>
                </li>
                <li>
                    <a href="{{ route('website.products.index', ['category' => $category?->id, 'gender' => 'men']) }}">
                        Men's
                    </a>
                </li>
            </ul>
        </div>
    </div>

    <div class="details-products" data-aos="fade-up" data-aos-duration="2000">
        <div class="container grid">
            @forelse ($products as $product)
            <div class="image">
                <a href="{{ route('website.products.show', $product->id) }}">
                    <img src="{{ asset($product->img_path) }}" alt="{{ $product->name }}"
                        style="width:100%; height:250px;" />
                </a>
                <div class="content">
                    <a href="{{ route('website.products.index', ['category' => $product->category_id]) }}">
                        {{ $product->category->name ?? '' }}
                    </a>
                    <h2>{{ $product->name }}</h2>
                    <span>{{ number_format($product->price, 2) }}$</span>
                </div>
                <div class="event" data-product-id="{{ $product->id }}">
                    <a onclick="addProductToCart(event)">
                        <i class="fas fa-cart-plus" data-text="Add To Cart" aria-hidden="true"></i>
                    </a>
                    <a onclick="addProductToWishlist(event)" data-product-id="{{ $product->id }}">
                        <i class="fas fa-heart" data-text="WatchList"></i>
                    </a>
                </div>
                @if ($product->discount)
                <div class="discount">-{{ $product->discount }}%</div>
                @endif
            </div>
            @empty
            <p>No Products Found</p>
            @endforelse
        </div>

        <div class="pagination-container">
            <button id="prev-btn"
                @if ($products->onFirstPage()) disabled
                @else onclick="window.location='{{ $products->previousPageUrl() }}'" @endif>
                Prev
            </button>

            <div id="pagination-numbers">
                @for ($i = 1; $i <= $products->lastPage(); $i++)
                    <button @if ($i==$products->currentPage()) class="active" @endif
                        onclick="window.location='{{ $products->url($i) }}'">
                        {{ $i }}
                    </button>
                    @endfor
            </div>

            <button id="next-btn"
                @if ($products->hasMorePages()) onclick="window.location='{{ $products->nextPageUrl() }}'"
                @else disabled @endif>
                Next
            </button>
        </div>
    </div>

    <div class="popup-overlay1" id="popup1">
        <div class="popup1">
            <div class="icon-container">
                <div class="circle"></div>
                <div class="icon">✔</div>
            </div>
            <h2>Item added to your cart</h2>
            <div class="cart-items-list">
                <p>
                    <span id="cart-count">0</span> ITEM IN THE CART (<span class="price">$0.00</span>)
                </p>
                <p>
                    Buy for <span id="totalPrice" class="price">$00.00</span> more and get free shipping
                </p>
                <div class="buttons">
                    <button class="continue" onclick="closePopup()">CONTINUE SHOPPING</button>
                    <button class="cart">GO TO THE CART</button>
                </div>
            </div>
        </div>
    </div>

    <script>
        const IS_LOGGED_IN = {
            {
                auth() - > check() ? 'true' : 'false'
            }
        };
        const APP_ROUTES = {
            cartAdd: "{{ route('website.cart.add') }}",
            login: "{{ route('customer.login') }}",
            cartRemove: "{{ route('website.cart.remove') }}",
            cartUpdate: "{{ route('website.cart.update') }}",
            wishlistAdd: "{{ route('website.wishlist.add') }}",
            wishlistRemove: "{{ route('website.wishlist.remove') }}",
        };
    </script>

    <script src="{{ asset('web/js/loading.js') }}"></script>
    <script src="{{ asset('web/js/products.js') }}" defer></script>
    <script src="{{ asset('web/js/shop-actions.js') }}" defer></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>

</body>

</html>