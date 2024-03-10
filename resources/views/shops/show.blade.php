@extends('layouts.app')

@section('content')    
<div class="container mb-5">
    @if(session('message'))
    <div class="alert alert-success p-5 m-2 fs-1 fw-bold text-center ">{{session('message')}}</div>
    @endif
    <div>
        <a class="fs-5 ms-2" href="{{ route('shops.index') }}">店舗一覧</a> > <span class="fs-5">{{ $shop->name }}</span>
    </div>
    <div class="row">
        <h1 class="display-1 pt-2 ms-2 col-md-9">{{ $shop->name }}</h1>
        @auth
        @if (auth()->user()->subscribed('default'))
            @if($shop->isFavoritedBy(Auth::user()))
            <a href="{{ route('shops.favorite', $shop) }}" class="btn d-flex mt-4 mb-4  align-items-center favorite_btn col-md-2">
                <i class="fa fa-heart"></i>
                お気に入り解除
            </a>
            @else
            <a href="{{ route('shops.favorite', $shop) }}" class="btn d-flex mt-4 mb-4 align-items-center favorite_btn col-md-2">
                <i class="fa fa-heart"></i>
                お気に入り
            </a>
            @endif
        @endif
        @endauth
    </div>
    <div class="card border-dark border-4 mb-5">
        <img src="{{ asset('img/sample1.jpeg') }}" class="card-img-top" alt="サンプル1">
        <div class="card-body">
            <h2 class="card-title ms-4">●{{ $shop->category->name }}</h2>
            <p class="card-text ms-4">　 {{ $shop->description }}</p>
            <h3 class="ms-4"> ●お店情報 </h6>
            <ul class="list-group list-group-flush ms-4">
                <li class="list-group-item">郵便番号：{{ $shop->postal_code }}</li>
                <li class="list-group-item">住所：{{ $shop->address }}</li>
                <li class="list-group-item">電話番号：{{ $shop->phone }}</li>
                <li class="list-group-item">営業時間：{{ $shop->business_hours }}</li>
                <li class="list-group-item">定休日：
                    @foreach($shop->regular_holiday as $regular_holiday)
                    {{ $week[$regular_holiday] }}
                    @endforeach
                </li>
                <li class="list-group-item">価格帯：{{ $price_lists[ $shop->price] }}円</li>
            </ul>
            <h3 class="mt-3 ms-4 ">●みんなのレビュー <span class="ms-2">★{{ $review_average }}</span></h3>
            <div class="row">
                @foreach($reviews as $review)
                <div class="col-md-8 col-10 mt-3 ms-5 pt-2 ps-3 border border-dark border-2 rounded">
                    <h3 class="review-score-color">{{ str_repeat('★', $review->score) }}</h3>
                    <p class="h3">{{ $review->content}}</p>
                    <label>{{ $review->created_at}} {{$review->user->name}}</label>
                </div>
                @endforeach
            </div><br>

            @auth
            @if (auth()->user()->subscribed('default'))
            <h3 class="mt-3 ms-4 ">●レビューを投稿（有料会員限定）</h3>
            <div class="row">
                <div class="col-md-8 col-10 ms-5 mt-3 ps-2 ">
                    <form method="POST" action="{{ route('review.store') }}">
                        @csrf
                        <h4>評価</h4>
                        <select name="score" class="form-control m-2 review-score-color">
                            <option value="5" class="review-score-color">★★★★★</option>
                            <option value="4" class="review-score-color">★★★★</option>
                            <option value="3" class="review-score-color">★★★</option>
                            <option value="2" class="review-score-color">★★</option>
                            <option value="1" class="review-score-color">★</option>
                        </select>
                        <h4>レビュー内容</h4>
                        
                        <textarea name="content" required class="form-control me-5"></textarea>
                        <input type="hidden" name="shop_id" value="{{ $shop->id }}">
                        <button type="submit" class="btn btn-primary mt-2">レビューを追加</button>
                    </form>
                </div>
            </div>
            <hr>
            <h3 class="mt-3 ms-4 ">●予約（有料会員限定）</h3>
            <form method="POST" action="{{ route('reservation.store') }}">
            @csrf
            <input type="hidden" name="shop_id" value="{{ $shop->id }}">
            <div class="row d-flex justify-content-center">
                <div class="p-1 col-md-6 border border-dark border-2 rounded">
                    <div class="m-1 row d-flex justify-content-center">

                        <div class="col-md-5 d-flex justify-content-center">
                            <label for="reserve_day"> 予約日</label>
                        </div>
                        <select class="col-md-5" required name="reserve_day">
                            <option value="" selected>選択してください</option>
                            @foreach( $addDayLists as $addDayList )
                            <option value="{{ $addDayList }}">{{ $addDayList }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="m-1 row d-flex justify-content-center">
                        <div class=" col-md-5 d-flex justify-content-center">
                            <label for="reserve_time"> 予約時間</label>
                        </div>
                        <select  class="col-md-5" required name="reserve_time">
                            <option value="" selected>選択してください</option>
                            @foreach( $addTimes as $addTime)
                            <option value="{{ $addTime }}">{{ $addTime}}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="m-1 row d-flex justify-content-center"> 
                        <div class="col-md-5 d-flex justify-content-center">
                            <label for="reserve_people"> 予約人数</label>
                        </div>
                        <select class="col-md-5" required name="reserve_people" placeholder="選択してください">
                            <option value="" selected>選択してください</option>
                            <option value="1">1名</option>
                            <option value="2">2名</option>
                            <option value="3">3名</option>
                            <option value="4">4名</option>
                            <option value="5">5名</option>
                            <option value="6">6名</option>
                            <option value="7">7名</option>
                            <option value="8">8名</option>
                            <option value="9">9名</option>
                            <option value="10">10名</option>
                        </select>
                    </div>
                    <div class="m-1 row d-flex justify-content-center"> 
                        <div class="col-md-5 d-flex justify-content-center">
                            <label for="reserve_message"> 店舗へのお知らせ</label>
                        </div>
                        <textarea class="col-md-5" name="reserve_message"></textarea>

                    <div class="mt-3 row d-flex justify-content-center">
                        <button type="submit" class="card-link btn btn-success col-md-4" >予約する</button>
                    </div>
                </div>
            </div>
            </form>
            @endif
            @endauth
        </div>
    </div>
</div>
@endsection