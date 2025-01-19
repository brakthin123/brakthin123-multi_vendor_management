<section id="header">
    {{-- <a href="#"><img src="{{ asset('assets/shop/img/logo.png') }}" class="logo" alt=""></a> --}}

    <!-- Highlighting the shop name -->
    <a href="#" class="shop-name-link">
        <h4 class="shop-name">{{ Auth::user()->vendor->shop_name }}</h4>
    </a>

    <div>
        <ul id="navbar">
            <li><a class="{{ request()->routeIs('home.list') ? 'active' : '' }}"
                    href="{{ route('home.list', ['name' => Auth::user()->vendor->shop_name]) }}">Home</a></li>
            <li><a class="{{ request()->routeIs('shop') ? 'active' : '' }}" href="{{ route('shop', ['name' => Auth::user()->vendor->shop_name]) }}">Shop</a></li>
            <li><a href="blog.html">Blog</a></li>
            <li><a href="about.html">About</a></li>
            <li><a href="contact.html">Contact</a></li>
            <li id="lg-bag"><a href="cart.html"><i class="far fa-shopping-bag"></i></a></li>
            <a href="#" id="close"><i class="far fa-times"></i></a>
        </ul>
    </div>
    <div id="mobile">
        <a href="{{ route('cart.index', ['name' => Auth::user()->vendor->shop_name]) }}">
            <i class="far fa-shopping-bag"></i>
        </a>



        <i id="bar" class="fas fa-outdent"></i>
    </div>
</section>
