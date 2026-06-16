<x-site>


    <!-- Start Landing -->

    <button id="top-btn"><i class="fa-solid fa-arrow-up"></i></button>
    <div class="scroll"></div>
    <div class="landing" id="landing">
        <div class="overlay2"></div>
        <div class="container">
            <h5>handbag new collection</h5>
            <h3>New arrivals!</h3>
            <h1>amazing Anywhere</h1>
            <p>
                Enjoy a wide range of high-quality products that suit all tastes and
                keep up with the latest fashion trends. Here, you will find everything
                you are looking for and more!
            </p>
            <a href="{{ route('website.products.index') }}"><button>Shop Now</button></a>
        </div>
    </div>

    <!-- Start Who we are -->
    <div class="about" id="about" data-aos="fade-up" data-aos-duration="2000">
        <div class="container">
            <div class="spacial-content">
                <p>Who We Are</p>
                <h1>
                    Welcome To AnyWhere <span></span><span></span><span></span><span></span>
                </h1>
                <div class="content">
                    <p>
                        Welcome to our website! We are here to provide you with an
                        exceptional shopping experience that includes everything you need
                        to complete your look with elegance. From luxury clothing for men
                        and women to distinctive accessories, amazing bags, and various
                        shoes, we have everything you need to add a unique touch to your
                        look.
                    </p>
                    <span>S & - </span><span>CEO AnyWhere</span>
                </div>
            </div>
        </div>
    </div>
    <!-- End Who we are -->
    <!-- start view product -->
    <div class="view" id="product">
        <div class="spacial-content">
            <h1 id="font">Our various departments</h1>
            <p>
                In our store, you will find a wide range of clothing,
                accessories,shoes and bags for men and women, carefully selected to
                meet the needs of everyone.
            </p>
        </div>
        <div class="container grid">
            @forelse($categories as $category)
            <div class="image">
                <a href="{{ route('website.products.index',['category'=> $category->id] ) }}">
                    <img src="{{ asset('images/' . $category->image()->first()?->path) }}"
                        alt="{{ $category->name }}" />
                    <button class="button">{{ $category->name }}</button>
                </a>
            </div>
            @empty
            <p>{{ __('No Categries Found') }}</p>
            @endforelse


        </div>
    </div>
    <!-- end view product -->
    <!-- Start Categories -->

    <div class="latest" data-aos="fade-up" data-aos-duration="2000" style="padding-bottom:0">
        <div class="spacial-content">
            <h1 id="font">Explore our collections</h1>

        </div>
        <h2 class="category-title" style="margin-top: 0px">For Women's</h2>
        <div class="container grid" style="margin-top: 10px" id="product-container">
            @foreach($women_products as $product)

            <div class="image">
                <a href="{{ route('website.products.show',$product->id) }}">
                    <img src="{{ $product->img_path }}" width="274px" height="274px" alt="{{ $product->name }}" />
                </a>
                <div class="content">
                    <a href="{{ route('website.products.show',$product->id) }}">{{ $product->category->name }}</a>
                    <h2>{{ $product->name }}</h2>
                    <span>${{number_format($product->price,2) }}</span>
                </div>
                <div class="event" data-product-id="{{ $product->id }}">
                    <a onclick="addProductToCart(event)">
                        <i class="fas fa-cart-plus" data-text="Add To Cart"></i>
                    </a>

                    <a onclick="addProductToWishlist(event)" data-product-id="{{ $product->id }}">
                        <i class="fas fa-heart" data-text="WatchList"></i>
                    </a>
                </div>

            </div>
            @endforeach
        </div>
    </div>
    <div class="latest" data-aos="fade-up" data-aos-duration="2000">

        <h2 class="category-title">For Men's</h2>
        <div class="container grid" style="margin-top: 10px" id="product-container">
            @foreach ($men_products as $product)
            <div class="image">
                <a href="{{ route('website.products.show',$product->id) }}">
                    <img src="{{ $product->img_path }}" width="274px" height="274px" alt="{{ $product->name }}" />
                </a>
                <div class="content">
                    <a href="{{ route('website.products.show',$product->id) }}">{{ $product->category->name }}</a>
                    <h2>{{ $product->name }}</h2>
                    <span>${{ number_format($product->price,2) }}</span>
                </div>
                <div class="event" data-product-id="{{ $product->id }}">
                    <a onclick="addProductToCart(event)">
                        <i class="fas fa-cart-plus" data-text="Add To Cart"></i>
                    </a>

                    <a onclick="addProductToWishlist(event)" data-product-id="{{ $product->id }}">
                        <i class="fas fa-heart" data-text="WatchList"></i>
                    </a>
                </div>

            </div>
            @endforeach

        </div>
    </div>
    <!-- <div class="pagination-container">
      <button id="prev-btn" onclick="prevPage()">Prev</button>
      <div id="pagination-numbers"></div>
      <button id="next-btn" onclick="nextPage()">Next</button>
    </div> -->
    <div class="see">
        <a href="{{ route('website.products.index') }}"><button>See more </button></a>
    </div>
    <!-- End Categories -->
    <!-- Start designer -->
    <div class="designer" data-aos="fade-up" data-aos-duration="2000">
        <div class="container">



        </div>
    </div>
    </div>
    </div>
    <!-- End designer -->
    <!-- Start latest arrivals -->
    <div class="latest" data-aos="fade-up" data-aos-duration="2000">
        <div class="spacial-content">
            <h1 id="font">Latest product</h1>
            <p>
                Enjoy our latest products carefully selected to meet your daily needs.
                Find out what suits you now!
            </p>
        </div>
        <div class="container">
            @forelse($latest_products as $latest_product)
            <div class="image">
                <a href="{{ route('website.products.show',$latest_product->id) }}"><img src="{{ $latest_product->img_path }}" alt="clothing30"
                        style="width:100%;height: 250px;" /></a>
                <div class="content">
                    <a href="{{ route('website.products.show',$latest_product->id) }}">{{ $latest_product->category->name }}</a>
                    <h2>{{ $latest_product->name }}</h2>
                    <span>{{ number_format($latest_product->price, 2) }}$</span>
                </div>
                <div class="event" data-product-id="{{ $latest_product->id }}">
                    <a onclick="addProductToCart(event)">
                        <i class="fas fa-cart-plus" data-text="Add To Cart" aria-hidden="true"></i>
                    </a>
                    <a onclick="addProductToWishlist(event)" data-product-id="{{ $latest_product->id }}">
                        <i class="fas fa-heart" data-text="WatchList"></i>
                    </a>
                </div>
            </div>
            @empty
            <p>{{ __('No Products Found') }}</p>
            @endforelse

        </div>
    </div>
    <!-- End latest arrivals -->
    <!-- Start New arrivals -->
    {{-- <div class="new-arrivals" data-aos="fade-up" data-aos-duration="2000">
        <div class="spacial-content">
            <h1 id="font">New arrivals</h1>
            <p>
                We offer you a new range of products that are characterized by high
                quality and comfort.
            </p>
        </div>
        <div class="container">
            <div class="image">
                <a href="details.html?id=Clot-W-091">
                    <img src="{{ asset('web/images/clothing2.png') }}" alt="clothing2" /></a>
    <div class="content">
        <a href="products.html?category=Clothing">Clothing</a>
        <h2>Comfortable and beautiful blouse</h2>
        <span>$60.00</span>
    </div>
    <div class="event" data-product-id="Clot-W-091">
        <a onclick="addProductToCart(event)">
            <i class="fas fa-cart-plus" data-text="Add To Cart"></i>
        </a>

        <a onclick="addProductToWishlist(event)" data-product-id="Clot-W-091">
            <i class="fas fa-heart" data-text="WatchList"></i>
        </a>
    </div>
    </div>
    <div class="image">
        <a href="details.html?id=Clot-M-070">
            <img src="{{ asset('web/images/clothing9.jpg') }}" alt="clothing9" /></a>
        <div class="content">
            <a href="products.html?category=Clothing">Clothing</a>
            <h2>Full formal suit excellent material</h2>
            <span>150$</span>
        </div>
        <div class="event" data-product-id="Clot-M-070">
            <a onclick="addProductToCart(event)">
                <i class="fas fa-cart-plus" data-text="Add To Cart"></i>
            </a>

            <a onclick="addProductToWishlist(event)" data-product-id="Clot-M-070">
                <i class="fas fa-heart" data-text="WatchList"></i>
            </a>
        </div>
        <div class="discount">-30%</div>
    </div>
    <div class="image">
        <a href="details.html?id=Clot-M-054">
            <img src="{{ asset('web/images/clothing38.png') }}" alt="clothing38" /></a>
        <div class="content">
            <a href="products.html?category=Clothing">Clothing</a>
            <h2>Grey sports tracksuit, excellent quality</h2>
            <span>$150.00</span>
        </div>
        <div class="event" data-product-id="Clot-M-054">
            <a onclick="addProductToCart(event)">
                <i class="fas fa-cart-plus" data-text="Add To Cart"></i>
            </a>

            <a onclick="addProductToWishlist(event)" data-product-id="Clot-M-054">
                <i class="fas fa-heart" data-text="WatchList"></i>
            </a>
        </div>
    </div>
    <div class="image">
        <a href="details.html?id=Clot-W-066">
            <img src="{{ asset('web/images/clothing13.jpg') }}" alt="clothing13" />
        </a>
        <div class="content">
            <a href="products.html?category=Clothing">Clothing</a>
            <h2>Modern design skirt</h2>
            <span>$60.00</span>
        </div>
        <div class="event" data-product-id="Clot-W-066">
            <a onclick="addProductToCart(event)">
                <i class="fas fa-cart-plus" data-text="Add To Cart"></i>
            </a>

            <a onclick="addProductToWishlist(event)" data-product-id="Clot-W-066">
                <i class="fas fa-heart" data-text="WatchList"></i>
            </a>
        </div>
    </div>
    </div>
    </div> --}}
    <!-- End New arrivals -->
    <!-- Start available -->
    <div class="available" data-aos="fade-up" data-aos-duration="2000">
        <div class="spacial-content">
            <h1 id="font">Our Services</h1>
        </div>
        <div class="container">
            <div class="details">
                <i class="fa fa-truck"></i>
                <i class="fa fa-shipping-fast"></i>
                <h2>Free Shipping Worldwide</h2>
                <p>
                    Enjoy fast and reliable delivery, wherever you are. We ensure your
                    orders reach you safely, without any extra charges
                </p>
            </div>
            <div class="details">
                <i class="fa fa-sync-alt"></i>
                <i class="fa fa-piggy-bank"></i>
                <h2>Money Back Guarantee</h2>
                <p>
                    Your satisfaction is our priority. If you're not happy with your
                    purchase, return it within 30 days for a full refund
                </p>
            </div>
            <div class="details">
                <i class="fa fa-phone-volume"></i>
                <i class="fa fa-comment-dots"></i>
                <h2>online support 24/7</h2>
                <p>
                    Get assistance anytime, anywhere. Our team is available round the
                    clock to help you with any questions or concerns
                </p>
            </div>
        </div>
    </div>
    <!-- End available -->

    <div class="popup hide-popup">
        <div class="popup-content">
            <button id="closeBtn" class="closeBtn close-popup">
                <i class="fas fa-times"></i>
            </button>
            <div class="popup-left">
                <div class="popup-img-container">
                    <img class="popup-img" src="{{ asset('web/images/shop2.png') }}" alt="">
                </div>
            </div>
            <div class="popup-right">
                <div class="right-content">
                    <h1>Get Discount <span>50%</span>off </h1>
                    <p>Sign up to our newsletter and save 30% for your next purchase. No spam, We promise </p>
                    <form action="">
                        <input type="email" placeholder="Enter Your Email...." class="popup-form">
                        <a href="">Subscribe</a>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-site>