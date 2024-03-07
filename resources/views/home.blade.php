@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-6">
            <div class="card">
                <div class="card-header text-center">{{ __('Dashboard') }}</div>

                <div class="card-body text-center">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif

                    メールアドレスの認証が完了しました。
                    <br>
                    <div class="text-center">
                        <a href={{ route('top') }} class="btn btn-primary">トップに戻る</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
