@extends('layouts.app')
 
 @section('content')
 <div class="container">
     <div class="row justify-content-center">
         <div class="col-md-5">
            @if(Session::has('message'))
                {{ session('message') }}
            @endif
             <h3 class="mt-3 mb-3 text-center">新規会員登録</h3>
 
             <hr>
 
             <form method="POST" action="{{ route('register') }}">
                 @csrf
 
                 <div class="form-group row">
                     <label for="name" class="col-md-6 col-form-label text-md-left fs-3">氏名</label>
 
                     <div class="col-md-6 d-flex align-items-center">
                         <input id="name" type="text" class="form-control @error('name') is-invalid @enderror samuraimart-login-input" name="name" value="{{ old('name') }}" required autocomplete="name" autofocus placeholder="名古屋飯太郎">
 
                         @error('name')
                         <span class="invalid-feedback" role="alert">
                             <strong>氏名を入力してください</strong>
                         </span>
                         @enderror
                     </div>
                 </div>

                 <div class="form-group row">
                     <label for="name" class="col-md-6 col-form-label text-md-left fs-3">ふりがな</label>
 
                     <div class="col-md-6 d-flex align-items-center">
                         <input id="furigana" type="text" class="form-control @error('furigana') is-invalid @enderror " name="furigana" value="{{ old('furigana') }}" required autocomplete="furigana" autofocus placeholder="なごやめしたろう">
 
                         @error('name')
                         <span class="invalid-feedback" role="alert">
                             <strong>氏名を入力してください</strong>
                         </span>
                         @enderror
                     </div>
                 </div>
 
                 <div class="form-group row">
                     <label for="email" class="col-md-6 col-form-label text-md-left fs-3">メールアドレス</label>
 
                     <div class="col-md-6 d-flex align-items-center">
                         <input id="email" type="email" class="form-control @error('email') is-invalid col-md-12 @enderror " name="email" value="{{ old('email') }}" required autocomplete="email" placeholder="nagoyameshi@nagoyameshi.com">
 
                        
                    @error('email')
                        @foreach ($errors->get('email') as $message)
                        <h6 class="invalid-feedback col-md-6 ms-3" role="alert">
                            <strong>{{$message}}</strong>
                        </h6>
                        @endforeach
                    @enderror
                    </div>
                 </div>
 
                 <div class="form-group row">
                     <label for="phone" class="col-md-6 col-form-label text-md-left fs-3">電話番号</label>
 
                     <div class="col-md-6 d-flex align-items-center">
                         <input type="text" class="form-control @error('phone') is-invalid @enderror " name="phone" required placeholder="03-5790-9039">
                     </div>
                 </div>
 
                 <div class="form-group row">
                     <label for="password" class="col-md-6 col-form-label text-md-left fs-3">パスワード</label>
 
                     <div class="col-md-6 d-flex align-items-center">
                         <input id="password" type="password" class="form-control @error('password') is-invalid @enderror " name="password" required autocomplete="new-password">
 
                         @error('password')
                         <span class="invalid-feedback" role="alert">
                             <strong>{{ $message }}</strong>
                         </span>
                         @enderror
                     </div>
                 </div>
 
                 <div class="form-group row">
                     <label for="password-confirm" class="col-md-6 col-form-label text-md-left fs-3">パスワード(確認用)</label>
 
                     <div class="col-md-6 d-flex align-items-center">
                         <input id="password-confirm" type="password" class="form-control " name="password_confirmation" required autocomplete="new-password">
                     </div>
                 </div>
 
                 <div class="form-group">
                     <button type="submit" class="btn btn-primary mt-2 w-100">
                         アカウント作成
                     </button>
                 </div>
             </form>
         </div>
     </div>
 </div>
 @endsection

