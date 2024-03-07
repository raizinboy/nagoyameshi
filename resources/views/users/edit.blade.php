@extends('layouts.app')
 
@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-5 mt-3">
            <span>
                 <a href="{{ route('mypage') }}">マイページ</a> > 会員情報の編集
            </span>
 
            <h1 class="mt-3 mb-3">会員情報の編集/削除</h1>
            <hr>
 
           
            <form method="POST" action="{{ route('mypage.update') }}">
                @csrf
                <input type="hidden" name="_method" value="PUT">
                <div class="form-group">
                    <div class="d-flex justify-content-between">
                        <label for="name" class="text-md-left mb-2">氏名</label>
                    </div>
                    <div>
                        <input id="name" type="text" class="form-control @error('name') is-invalid @enderror" name="name" value="{{ $user->name }}" required autocomplete="name" autofocus >
                        @error('name')
                        <span class="invalid-feedback" role="alert">
                            <strong>氏名を入力してください</strong>
                        </span>
                        @enderror
                    </div>
                </div>
                
                <br>

                <div class="form-group">
                    <div class="d-flex justify-content-between">
                        <label for="name" class="text-md-left mb-2">ふりがな</label>
                    </div>
                    <div>
                        <input id="furigana" type="text" class="form-control @error('furigana') is-invalid @enderror" name="furigana" value="{{ $user->furigana }}" required autocomplete="name" autofocus>
                        @error('furigana')
                        <span class="invalid-feedback" role="alert">
                            <strong>ふりがなを入力してください</strong>
                        </span>
                        @enderror
                    </div>
                </div>

                <br>

                <div class="form-group">
                    <div class="d-flex justify-content-between">
                        <label for="email" class="text-md-left mb-2">メールアドレス</label>
                    </div>
                    <div>
                        <input id="email" type="text" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ $user->email }}" required autocomplete="email" autofocus>
                        @error('email')
                        <span class="invalid-feedback" role="alert">
                            <strong>メールアドレスを入力してください</strong>
                        </span>
                        @enderror
                    </div>
                </div>

                <br>

                <div class="form-group">
                    <div class="d-flex justify-content-between">
                        <label for="phone" class="text-md-left mb-2">電話番号</label>
                    </div>
                    <div>
                        <input id="phone" type="text" class="form-control @error('phone') is-invalid @enderror" name="phone" value="{{ $user->phone }}" required autocomplete="phone" autofocus>
                        @error('phone')
                        <span class="invalid-feedback" role="alert">
                            <strong>電話番号を入力してください</strong>
                        </span>
                        @enderror
                    </div>
                </div>

                <hr>

                <div class="d-flex justify-content-center"> 
                    <button type="submit" class="btn btn-primary mt-3 ms-3 w-25 col-md-9">
                        保存
                    </button>
                </div>
            </form>

            <form method="POST" action="{{ route('mypage.destroy') }}" class="col-md-12 d-flex justify-content-center">
                @csrf
                <input type="hidden" name="_method" value="DELETE">
                <div class="btn btn-danger  w-25 ms-3 mt-4 col-md-3 w" data-bs-toggle="modal" data-bs-target="#delete-user-confirm-modal">退会する</div>
            
                <div class="modal fade" id="delete-user-confirm-modal" data-backdrop="static" data-keyboard="false" tabindex="-1" role="dialog" aria-labelledby="staticBackdropLabel" aria-hidden="true">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="staticBackdropLabel"><label>本当に退会しますか？</label></h5>
                                <button type="button" class="close btn btn-light" data-bs-dismiss="modal" aria-label="閉じる">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                            <div class="modal-body">
                                <p class="text-center">一度退会するとデータはすべて削除され復旧はできません</p>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-light dashboard-delete-link" data-bs-dismiss="modal">キャンセル</button>
                                <button type="submit" class="btn btn-danger mt-3 me-3">退会する</button>
                            </div>
                        </div>
                    </div>
                </div>
            </form>
         </div>
     </div>
 </div>
 @endsection