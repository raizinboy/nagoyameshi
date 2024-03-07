@extends('layouts.app')

@section('content')
    <div class="container">
        
        <h1 class="w-50 m-auto mt-2">有料会員の登録</h1>

        @if(Session::has('success'))
            <h3 class="w-50 m-auto mt-3 mb-3 text-center fw-bold text-warning">{{ session('success') }}</h1>
        @endif

        @auth
        @if (auth()->user()->subscribed('default'))
        <div class="w-100 d-flex justify-content-center">
            <div class="w-50 text-center p-5 m-2 border border-3 border-success rounded">
                <h2> あなたは有料会員登録済みです。</h2>
                @if (auth()->user()->subscription()->ends_at)
                
                <p class="mt-3"> サブスクリプション解約手続き済みです。</p>
                <p> サブスクリプションは{{ auth()->user()->subscription()->ends_at }}までです。<p>
                @endif
            </div>
        </div>

        @else
        <h4 class="w-50 m-auto mt-2 mb-3">有料会員になると以下の機能がご利用いただけます。</h4>
        <div class="w-50 m-auto border border-2 border-black rounded">
            <p class="mt-2 mb-2 fw-bold fs-4">・店舗予約機能</p> 
            <p class="mb-2 fw-bold fs-4">・お気に入り店舗追加機能</p>
            <p class="mb-2  fw-bold fs-4"> ・レビュー投稿機能</p> 
        </div>
        <h2 class="w-50 m-auto mt-4">クレジットカード情報を登録する。</h2>
        <p class="w-50 m-auto mt-2 mb-2">クレジットカードを登録すると自動でお支払いが行われます。</p>
        <div class="w-50 p-2 m-auto border border-2 border-primary rounded row">
            <label class="col-md-3 pe-0 pt-1 ps-4"> カード名義人：</label>
            <input class="col-md-9" id="card-holder-name" type="text" placeholder="NAGOYA MESHI">
            <div class="row">
                <div class="m-2 p-0 fs-1 col-md-12" id="card-element"></div>
            </div>
            <div class="row m-0">
                <div class="col-md-3 p-0"></div>
                <button class="col-md-6 w-50 p-2 fw-bold " id="card-button" data-secret="{{ $intent->client_secret }}">
                    有料会員登録する（500円/月）
                </button>
                <div class="col-md-3 p-0"></div>
            </div>
        </div>
        @endif
        @endauth

            <form method="post" action="{{ route('mypage.postPaymentMethod') }}" id="updateForm">
                @csrf
                <input type="hidden" name="payment_method">
            </form>

        <div class="d-flex justify-content-center w-100">
            @auth
            @if (auth()->user()->subscribed('default') && auth()->user()->subscription()->ends_at)
            <div class="me-2 w-25">
                <form method="POST" action="{{ route('subscription.resume') }}">
                    @csrf
                    <button class="btn mt-4 mb-5 fs-6 btn-danger w-100" >サブスクリプションを再開する</button>
                </form>
            </div>
            @elseif(auth()->user()->subscribed('default'))
            <div class="me-2 w-25">
                <form method="POST" action="{{ route('subscription.cancel') }}">
                    @csrf
                    <button class="btn mt-4 mb-5 fs-6 btn-danger w-100" >有料会員をやめる</button>
                </form>
            </div>
            @else

            @endif
            @endauth

            <div class="ms-2 w-25">
                <a href="{{ route('top') }}" class="btn ps-4 pe-4 mt-4 mb-5 fs-6 btn-info w-100">TOPに戻る</a>
            </div>
                
        </div>

        <script src="https://js.stripe.com/v3/"></script>

        <script>
            const stripe = Stripe('{{ env('STRIPE_KEY') }}');

            const elements = stripe.elements();
            const cardElement = elements.create('card',{hidePostalCode: true });

            cardElement.mount('#card-element');

            const cardHolderName = document.getElementById('card-holder-name');
            const cardButton = document.getElementById('card-button');
            const clientSecret = cardButton.dataset.secret;

            cardButton.addEventListener('click', async (e) => {
                //　カード情報の登録(Stripeとの通信)
                const { setupIntent, error} = await stripe.confirmCardSetup(
                    clientSecret, {
                        payment_method: {
                            card: cardElement,
                            billing_details: { name: cardHolderName.value }
                        }
                    }
                );

                if (error) {
                    alert(error.message);
                } else {
                    // クレジットカードの登録に成功したので、Laravel側にトークンをPostする
                    const updateForm = document.getElementById('updateForm');
                    updateForm.payment_method.value = setupIntent.payment_method;
                    updateForm.submit();
                }
            });

        </script>
    </div>
@endsection
