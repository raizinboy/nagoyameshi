@extends('layouts.app')

@section('content')
<div class="container mb-5">
    <div class="carousel-container ms-4 me-4">
        <div id="carouselExampleCaptions" class="carousel slide" data-bs-ride="carousel">
            <div class="carousel-indicators">
                <button type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide-to="0" class="active" aria-current="true" aria-label="Slide 1"></button>
                <button type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide-to="1" aria-label="Slide 2"></button>
                <button type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide-to="2" aria-label="Slide 3"></button>
            </div>
            <div class="carousel-inner">
                <div class="carousel-item active position-relative vh-75">
                    <img src={{ asset('img/restaurant.jpeg') }} class="d-block w-100" alt="おしゃれなレストラン">
                    <div class="carousel-caption d-none d-md-block position-absolute start-50 translate-middle mt-5 w-100">
                        <p class="mt-5 ms-4 d-none d-md-block display-1 text-light">素敵なお店と！</p>
                        <a href="{{ route('shops.index') }}" class="d-none d-md-inline btn btn-primary pt-3 pb-3 w-25 fs-2">お店を探す</a>
                    </div>
                </div>
                    <div class="carousel-item">
                    <img src={{ asset('img/yakiniku.jpg') }} class="d-block w-100" alt="焼肉">
                    <div class="carousel-caption d-sm-none d-md-block  position-absolute start-50 translate-middle mt-5 w-100">
                        <p class="mt-5 ms-4 d-none d-md-block display-1 text-white"">美味しい料理で！</p>
                        <a href="{{ route('shops.index') }}" class="d-none d-md-inline btn btn-primary pt-3 pb-3 w-25 fs-2">お店を探す</a>
                    
                    </div>
                </div>
                <div class="carousel-item h-75">
                    <img src={{ asset('img/hito.jpg') }} class="d-block w-100" alt="食事を楽しむ女性">
                    <div class="carousel-caption d-sm-none d-md-block position-absolute start-50 translate-middle mt-5 w-100">
                        <p class="mt-5 ms-4 d-none d-md-block display-1 text-white"">最高のひとときを！</p>
                        <a href="{{ route('shops.index') }}" class="d-none d-md-inline btn btn-primary pt-3 pb-3 w-25 fs-2">お店を探す</a>
                    </div>
                </div>
            </div>
            <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide="prev">
                <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                <span class="visually-hidden">Previous</span>
            </button>
            <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide="next">
                <span class="carousel-control-next-icon" aria-hidden="true"></span>
                <span class="visually-hidden">Next</span>
            </button>
        </div>
    </div>
    <div class="d-md-none row justify-content-center">
        <a href="{{ route('shops.index') }}" class="btn btn-primary mt-3 col-8 col-offset-2 fs-2">お店を探す</a>
    </div>
    <div class="mt-3 mb-3">
        <h1 class="fs-1">★おすすめのお店★</h1>
    </div>

    @foreach ($recommend_shops as $recommend_shop)
    <div class="row m-3 p-3 border border-dark border-2 rounded">
        <div class="col-md-5">
            @if ($recommend_shop->image !== "")
                <img src="{{ asset($recommend_shop->image) }}" class="img-thumbnail p-0">
            @else
                <img src="{{ asset('img/sample1.jpeg') }}" class="img-thumbnail p-0" alt="サンプル画像">
            @endif
        </div>
        <div class="col-md-5">
            <h2 class="mt-3">{{ $recommend_shop->name }}<span class="review-score-color ms-5">★ {{ $review_average_lists[$recommend_shop->id] }}</span></h2>
            <h3>{{ $recommend_shop->category->name }}</h3>
            <p>{{ $recommend_shop->description }}</p>
        </div>
        <div class="col-md-2 d-flex align-items-center justify-content-center">
            <a href="{{ route('shops.show', $recommend_shop->id) }}" class="btn btn-primary d-flex align-items-center">店舗詳細</a>
        </div>
    </div>
    @endforeach
</div>
@endsection