@extends('layouts.app')
 
 @section('content')
 <div class="container  d-flex justify-content-center mt-3">
     <div class="w-75">
         <h1>お気に入り店舗一覧</h1>
 
         <hr class="mt-2 mb-2">
 
         <div class="row">
             @foreach ($favorites as $fav)
             <div class="col-md-9 mt-2 mb-2">
                 <div class="d-inline-flex">
                     <a href="{{route('shops.show', $fav->favoriteable_id)}}" class="w-25">
                        @if (App\Models\Shop::find($fav->favoriteable_id)->image !== "")
                        <img src="{{ asset(App\Models\Shop::find($fav->favoriteable_id)->image) }}" class="img-fluid w-100">
                        @else
                        <img src="{{ asset('img/sample1.jpeg') }}" class="img-fluid w-100" alt="サンプル画像">
                        @endif
                     </a>
                     <div class="container mt-1">
                     <h5 class="w-100">{{App\Models\Shop::find($fav->favoriteable_id)->name}}</h5>
                     <h6 class="w-100">{{App\Models\Shop::find($fav->favoriteable_id)->description}}</h5>
                     </div>
                 </div>
             </div>
             <div class="col-md-1 d-flex align-items-center justify-content-end">
                 <a href="{{ route('shops.show', $fav->favoriteable_id) }}" class="btn btn-primary">
                     詳細
                 </a>
             </div>   
             <div class="col-md-1 d-flex align-items-center justify-content-end">
                 <a href="{{ route('shops.favorite', $fav->favoriteable_id) }}" class="btn btn-warning">
                     削除
                 </a>
             </div>   
             
             <hr class="mt-2 mb-2">
             @endforeach
         </div>
         <div class=" d-flex justify-content-center">
            <a href="{{ route('top') }}" class="btn mt-4 fs-3 btn-info w-75">TOPに戻る</a>
        </div>

     </div>
 </div>
 @endsection