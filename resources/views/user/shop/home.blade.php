@extends('user.layout.main')

@section('content')
    {{-- hero --}}
     <section id="hero">
        <h4>{{ $vendor->shop_name }}</h4>
        <h2>Welcome to {{ $vendor->shop_name }}</h2>
        <p>Explore our exclusive products!</p>
    </section>
    {{-- end --}}

   <section id="product1" class="section-p1">
        <h2>Products from {{ $vendor->shop_name }}</h2>
        <div class="pro-container">
            @if($products->isEmpty())
                <p>No products available for this vendor.</p>
            @else
                @foreach ($products as $product)
                    <div class="pro">
                        <img src="{{ asset('storage/' . $product->image_url) }}" alt="{{ $product->name }}">
                        <div class="des">
                            <span>{{ $product->brand }}</span>
                            <h5>{{ $product->name }}</h5>
                            <div class="star">
                                @for ($i = 0; $i < 5; $i++)
                                    <i class="fas fa-star{{ $i < $product->rating ? '' : '-o' }}"></i>
                                @endfor
                            </div>
                            <h4>${{ $product->price }}</h4>
                        </div>
                        <a href="#"><i class="fal fa-shopping-cart cart"></i></a>
                    </div>
                @endforeach
            @endif
        </div>
    </section>

    <section id="product1" class="section-p1">
        <h2>Featured Products</h2>
        <p>Summer Collection New Modern Design</p>
        <div class="pro-container">
            @foreach ($products as $product)
                <div class="pro">
                    <img src="{{ asset('storage/' . $product->image_url) }}" alt="{{ $product->name }}">
                    <div class="des">
                        <span>{{ $product->brand }}</span> <!-- Assuming you have a 'brand' field in your Product model -->
                        <h5>{{ $product->name }}</h5>
                        <div class="star">
                            <!-- Assuming you have a 'rating' field in your Product model -->
                            @for ($i = 0; $i < 5; $i++)
                                <i class="fas fa-star{{ $i < $product->rating ? '' : '-o' }}"></i>
                                <!-- Use solid star for rated, outline for unrated -->
                            @endfor
                        </div>
                        <h4>${{ $product->price }}</h4> <!-- Assuming you have a 'price' field in your Product model -->
                    </div>
                    <a href="#"><i class="fal fa-shopping-cart cart"></i></a>
                </div>
            @endforeach
        </div>
    </section>


    <section id="banner" class="section-m1">
        <h4>Repair Services </h4>
        <h2>Up to <span>70% Off</span> – All t-Shirts & Accessories</h2>
        <button class="normal">Explore More</button>
    </section>

    <section id="product1" class="section-p1">
        <h2>New Arrivals</h2>
        <p>Summer Collection New Morden Design</p>
        <div class="pro-container">
            <div class="pro">
                <img src="{{ asset('assets/shop/img/products/n1.jpg') }}" alt="">
                <div class="des">
                    <span>adidas</span>
                    <h5>Cartoon Astronaut T-Shirts</h5>
                    <div class="star">
                        <i class="fas fa-star"></i>
                        <i class="fas fa-star"></i>
                        <i class="fas fa-star"></i>
                        <i class="fas fa-star"></i>
                        <i class="fas fa-star"></i>
                    </div>
                    <h4>$78</h4>
                </div>
                <a href="#"><i class="fal fa-shopping-cart cart"></i></a>
            </div>
            
        </div>
    </section>

    <section id="sm-banner" class="section-p1">
        <div class="banner-box">
            <h4>crazy deals</h4>
            <h2>buy 1 get 1 free</h2>
            <span>The best classic dress is on sale at cara</span>
            <button class="white">Learn More</button>
        </div>
        <div class="banner-box banner-box2">
            <h4>spring/summer</h4>
            <h2>upcomming season</h2>
            <span>The best classic dress is on sale at cara</span>
            <button class="white">Collection</button>
        </div>
    </section>

    <section id="banner3">
        <div class="banner-box">
            <h2>SEASONAL SALE</h2>
            <h3>Winter Collection -50% OFF</h3>
        </div>
        <div class="banner-box banner-box2">
            <h2>NEW FOOTWEAR COLLECTION </h2>
            <h3>Spring / Summer 2022</h3>
        </div>
        <div class="banner-box banner-box3">
            <h2>T-SHIRTS</h2>
            <h3>New Trendy Prints</h3>
        </div>
    </section>

    <section id="newsletter" class="section-p1 section-m1">
        <div class="newstext">
            <h4>Sign Up For Newsletters</h4>
            <p>Get E-mail updates about our latest shop and <span>special offers.</span> </p>
        </div>
        <div class="form">
            <input type="text" placeholder="Your email address">
            <button class="normal">Sign Up</button>
        </div>
    </section>
@endsection
