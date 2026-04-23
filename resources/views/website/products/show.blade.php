<x-site>
    <div class="content-products" data-aos="fade-up" data-aos-duration="2000">
        <div class="container">
            <div class="left-side">
                <div class="images">
                    <img src="{{ $product->img_path }}" height="100%" id="product-image" alt="{{ $product->name }}">
                </div>
                <div class="main-content">
                    <h2 id="product-title">{{ $product->name }}</h2>
                    <div class="stars">
                        @for ($i = 1; $i <= 5; $i++)
                            <i class="fas fa-star {{ $product->reviews->avg('star') >= $i ? 'filled' : '' }}" aria-hidden="true"></i>
                            @endfor
                            <span class="review-count">({{ $product->reviews->count() }} Reviews)</span>
                    </div>

                    <p id="product-description">{{ $product->description }}</p>
                    <h3 class="price" id="product-price">${{ number_format($product->price, 2) }}</h3>

                    <div class="add" data-product-id="{{ $product->id }}">
                        <button class="shopping-cart add-cart-details" onclick="addProductToCart(event)">
                            <i class="fas fa-shopping-cart"></i>
                            <span class="add-to-cart"> Add to Cart</span>
                            <span class="added"> ADDED :)</span>
                            <i class="fas fa-shopping-cart"></i>
                            <i class="fas fa-box"></i>
                        </button>

                        <button class="wishlist-button" onclick="addProductToWishlist(event)" data-product-id="{{ $product->id }}">
                            <i class="fas fa-heart"></i> Add to Wishlist
                        </button>
                    </div>

                    <div class="tags">
                        <p>Category: <a href="{{ route('website.products.index', ['category' => $product->category_id]) }}">{{ $product->category->name }}</a></p>
                    </div>
                </div>

                <div class="product-container">
                    <div class="tabs">
                        <button class="tab-button" onclick="showTab('description')">DESCRIPTION</button>
                        <button class="tab-button active" onclick="showTab('reviews')">REVIEWS ({{ $product->reviews->count() }})</button>
                    </div>
                    <div id="description" class="tab-content" style="display: none;">
                        <p>{{ $product->description }}</p>
                    </div>
                    <div id="reviews" class="tab-content" style="display: block;">
                        @forelse ($product->reviews as $review)
                        <div class="review">
                            <strong>{{ $review->user->name ?? 'Anonymous' }}</strong>
                            <div class="stars">
                                @for ($i = 1; $i <= 5; $i++)
                                    <i class="fas fa-star {{ $review->star >= $i ? 'filled' : '' }}"></i>
                                    @endfor
                            </div>
                            <p>{{ $review->comment }}</p>
                        </div>
                        @empty
                        <p>There are no reviews yet.</p>
                        <p>Be the first to review ..</p>
                        @endforelse

                        @auth
                        <form class="review-form" action="{{ route('website.products.storeReviews', $product->id) }}" method="POST">
                            @csrf
                            <input type="hidden" name="product_id" value="{{ $product->id }}">
                            <label for="star">Your rating:</label>
                            <div class="rating" id="strar">
                                @for ($i = 1; $i <= 5; $i++)
                                    <div class="group" data-value="{{ $i }}">
                                    @for ($j = 1; $j <= $i; $j++)
                                        <span class="star">★</span>
                                        @endfor
                            </div>
                            @endfor
                    </div>
                    <input type="hidden" name="star" id="rating-value" value="{{ old('star') }}">
                    <label for="comment">Your review:</label>
                    <textarea id="comment" name="comment" class="form-input" required>{{ old('comment') }}</textarea>
                    <button type="submit">Submit</button>
                    </form>
                    @else
                    <p><a href="{{ route('customer.login') }}">Login</a> to write a review.</p>
                    @endauth
                </div>
            </div>
        </div>

        <div class="right-side">
            <div class="best-sellers">
                <h3>Best Sellers</h3>
                @foreach ($bestSellers as $bestSeller)
                <div class="product">
                    <a href="{{ route('website.products.show', $bestSeller->id) }}">
                        <img src="{{ $bestSeller->img_path }}" alt="{{ $bestSeller->name }}" />
                    </a>
                    <div class="info">
                        <p>{{ $bestSeller->name }}</p>
                        <div class="stars">
                            @for ($i = 1; $i <= 5; $i++)
                                <i class="fas fa-star{{ $bestSeller->reviews->avg('star') >= $i ? ' filled' : '' }}"></i>
                                @endfor
                        </div>
                        <div class="price">${{ number_format($bestSeller->price, 2) }}</div>
                    </div>
                </div>
                @endforeach
            </div>
        </div>
    </div>
    </div>

    <!-- Start New arrivals -->
    <div class="new-arrivals" data-aos="fade-up" data-aos-duration="2000">
        <div class="spacial-content">
            <h1 id="font">New arrivals</h1>
            <p>We offer you a new range of products that are characterized by high quality and comfort.</p>
        </div>
        <div class="container">
            @foreach ($newProducts as $newProduct)
            <div class="image">
                <a href="{{ route('website.products.show', $newProduct->id) }}">
                    <img src="{{ $newProduct->img_path }}" alt="{{ $newProduct->name }}" />
                </a>
                <div class="content">
                    <a href="{{ route('website.products.index', ['category' => $newProduct->category_id]) }}">{{ $newProduct->category->name }}</a>
                    <h2>{{ $newProduct->name }}</h2>
                    <span>${{ number_format($newProduct->price, 2) }}</span>
                </div>
                <div class="event" data-product-id="{{ $newProduct->id }}">
                    <a onclick="addProductToCart(event)">
                        <i class="fas fa-cart-plus" data-text="Add To Cart" aria-hidden="true"></i>
                    </a>
                    <a onclick="addProductToWishlist(event)" data-product-id="{{ $newProduct->id }}">
                        <i class="fas fa-heart" data-text="WatchList"></i>
                    </a>
                </div>
            </div>
            @endforeach
        </div>
    </div>
    <!-- End New arrivals -->

    @push('scripts')
    <script>
        window.addEventListener("load", function() {
            toastr.options = {
                "closeButton": true,
                "progressBar": true,
                "positionClass": "toast-bottom-right",
                "timeOut": "3000",
            };

            @if(session('success'))
            toastr.success("{{ session('success') }}");
            @endif
            @if(session('error'))
            toastr.error("{{ session('error') }}");
            @endif
        });

        document.addEventListener("DOMContentLoaded", function() {
            const groups = document.querySelectorAll(".group");
            groups.forEach((group) => {
                group.addEventListener("click", () => {
                    groups.forEach((g) => g.classList.remove("active"));
                    group.classList.add("active");
                    const ratingInput = document.getElementById("rating-value");
                    if (ratingInput) {
                        ratingInput.value = group.getAttribute("data-value");
                    }
                });
            });
        });
    </script>
    @endpush

    @push('scripts')
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
    <script>
        window.addEventListener("load", function() {
            toastr.options = {
                "closeButton": true,
                "progressBar": true,
                "positionClass": "toast-bottom-right",
                "timeOut": "3000",
            };

            @if(session('success'))
            toastr.success("{{ session('success') }}");
            @endif
            @if(session('error'))
            toastr.error("{{ session('error') }}");
            @endif
        });

        document.addEventListener("DOMContentLoaded", function() {
            const groups = document.querySelectorAll(".group");
            groups.forEach((group) => {
                group.addEventListener("click", () => {
                    groups.forEach((g) => g.classList.remove("active"));
                    group.classList.add("active");
                    const ratingInput = document.getElementById("rating-value");
                    if (ratingInput) {
                        ratingInput.value = group.getAttribute("data-value");
                    }
                });
            });
        });
    </script>
    @endpush
</x-site>