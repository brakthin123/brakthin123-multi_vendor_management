@extends('user.layout.main')

@section('content')
   <section id="page-header">

        <h2>#stayhome</h2>

        <p>Save more with coupons &amp; up to 70% off!</p>

    </section>

    <section id="product1" class="section-p1">
        <div class="pro-container">

            @foreach ($products as $item )
            <div class="pro" onclick="window.location.href='sproduct.html';">
                            <img src="{{ asset('storage/' . $item->image_url) }}" alt="{{ $item->image_url }}" alt="{{ $item->name }}" style="height: 450px">
                            <div class="des">
                                <span>{{ $item->name }}</span>
                                <h5>Cartoon Astronaut T-Shirts</h5>
                                <div class="star">
                                    <i class="fas fa-star"></i>
                                    <i class="fas fa-star"></i>
                                    <i class="fas fa-star"></i>
                                    <i class="fas fa-star"></i>
                                    <i class="fas fa-star"></i>
                                </div>
                                <h4>{{ $item->price }}</h4>
                            </div>
                            <a href="#"><i class="fal fa-shopping-cart cart"></i></a>
                        </div>
            @endforeach


        </div>
    </section>
@endsection
