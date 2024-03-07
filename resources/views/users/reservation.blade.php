@extends('layouts.app')
 
 @section('content')
 <div class="container  d-flex justify-content-center mt-3">
     <div class="w-75">
         <h1>予約一覧</h1>
 
         <hr class="mt-2 mb-2">
 
         <div class="row">
             @foreach ($reservations as $reservation)
             <div class="col-md-9 mt-2 mb-2">
                 <div class="row d-inline-flex">
                     <a href=# class="col-md-5">
                        @if ($reservation->shop->image != '')
                        <img src="{{ asset( $reservation->shop->image) }}" class="img-fluid w-100" alt="店舗写真">
                        @else
                        <img src="{{ asset('img/sample1.jpeg') }}" class="img-fluid w-100" alt="サンプル画像">
                        @endif
                     </a>
                     <div class="col-md-7 mt-1">
                        <h5 class="w-100 fs-2 fw-bold"><span class="fw-bold">店名：</span>{{ $reservation->shop->name }}</h5>
                        <h6 class="w-100 mt-1 mb-0"><span class="fw-bold">予約ID：</span>{{ $reservation->id }}</h6>
                        <h6 class="w-100 mt-1 mb-0"><span class="fw-bold">予約日：</span>{{ $reservation->reserve_day }}</h6>
                        <h6 class="w-100 mt-1 mb-0"><span class="fw-bold">予約時間：</span>{{ $reservation->reserve_time }}</h6>
                        <h6 class="w-100 mt-1 mb-0"><span class="fw-bold">予約人数：</span>{{ $reservation->reserve_people }}人</h6>
                        <h6 class="w-100 mt-1 mb-0"><span class="fw-bold">店舗へのメッセージ：</span>{{ $reservation->reserve_message }}</h6>
                        <h6 class="w-100 mt-1 mb-0"->{{ $reservation->created_at }}</h6>
                     </div>
                 </div>
             </div>
             <div class="row col-md-3">
                <div class="col-md-6 p-0 d-flex align-items-center justify-content-end">
                    <a href="{{ route('shops.show', $reservation->shop->id) }}" class="btn btn-primary">
                        店舗詳細
                    </a>
                </div>   
                <div class="col-md-6 p-0 d-flex align-items-center justify-content-end">
                    <form action="{{ route('reservation.destroy') }}" method="POST">
                        @csrf
                        <input type="hidden" name="_method" value="DELETE">
                        <input type="hidden" name="id" value="{{ $reservation->id }}">
                        <div class="btn btn-warning" data-bs-toggle="modal" data-bs-target="#delete-reservation-modal">予約取消</div>
            
                        <!-- 予約削除モーダル-->
                        <div class="modal fade" id="delete-reservation-modal" data-backdrop="static" data-keyboard="false" tabindex="-1" role="dialog" aria-labelledby="staticBackdropLabel" aria-hidden="true">
                            <div class="modal-dialog">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title ms-5 fs-3" id="staticBackdropLabel"><label>本当に予約を取り消しますか？</label></h5>
                                        <button type="button" class="close btn btn-light" data-bs-dismiss="modal" aria-label="閉じる">
                                            <span aria-hidden="true">&times;</span>
                                        </button>
                                    </div>
                                    <div class="modal-body">
                                        <p class="fs-5 text-center">一度取り消しすると予約を復元することはできません。</p>
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-light dashboard-delete-link" data-bs-dismiss="modal">キャンセル</button>
                                        <button type="submit" class="btn btn-danger me-3">予約を取り消す</button>
                                    </div>
                                </div>
                            </div>
                        </div>

                    </form>
                </div>  
            </div> 
             <hr class="mt-2 mb-2">
             @endforeach
         </div>
         <div class=" d-flex justify-content-center mb-3">
            <a href="{{ route('top') }}" class="btn mt-4 mb-5 fs-3 btn-info w-75">TOPに戻る</a>
        </div>

     </div>
 </div>
 @endsection