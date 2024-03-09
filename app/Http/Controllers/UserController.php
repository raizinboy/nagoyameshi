<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Shop;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;

class UserController extends Controller
{
    public function mypage()
    {
        $user = Auth::user();

        return view('users.mypage', compact('user'));
    }
    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    public function edit(User $user)
    {
        $user = Auth::user();

        return view('users.edit', compact('user'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, User $user)
    {
        $user = Auth::user();

        $user->name = $request->input('name') ? $request->input('name') : $user->name;
        $user->furigana = $request->input('furigana') ? $request->input('furigana') : $user->furigana;
        $user->email = $request->input('email') ? $request->input('email') : $user->email;
        $user->phone = $request->input('phone') ? $request->input('phone') : $user->phone;
        $user->update();

        return to_route('mypage');

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request)
    {
        Auth::user()->forceDelete();
        return redirect('/home');
    }

    public function update_password(Request $request)
    {
        $validatedData = $request->validate([
            'password' => 'required|confirmed',
        ]);

        $user = Auth::user();

        if( $request->input('password') == $request->input('password_confirmation')) {
            $user->password = bcrypt($request->input('password'));
            $user->update();
        }   else{
            return to_route('mypage.edit_password');
        }

        return to_route('mypage');
    }

    public function edit_password()
    {
        return view('users.edit_password');
    }

    public function favorite()
    {
        $user = Auth::user();

        $favorites = $user->favorites(Shop::class)->get();

        return view('users.favorite', compact('favorites'));
    }

    public function getPaymentMethod()
    {
        $success = "";
        //クレジットカードの登録に必要なシークレットをStripeから取得する
        return view('users.payment_method', [
            'intent' => Auth::user()->createSetupIntent(),
            'user' => Auth::user()
        ])->with('success');
    }

    public function postPaymentMethod(Request $request)
    {
        $user = Auth::user();

        if($user->stripe_id){
        } else {
        // Stripe顧客を作成する
        $stripeCustomer = Auth::user()->createAsStripeCustomer();
        }
        //トークンを受け取り、stripeに検証したうえで、usersテーブルに、支払い状況を登録する。
        Auth::user()->updateDefaultPaymentMethod($request->payment_method);
        $paymentMethod = Auth::user()->defaultPaymentMethod()->paymentMethod;
        Auth::user()->newSubscription('default', 'price_1OpAXaEGtiTwOKkt8euYUjuS')->create($paymentMethod);

        return response()->redirectTo('/users/payment_method')->with(['success' => "サブスクリプションを登録しました。"]);
        
    }

    public function cancelsubscription(Request $request){
        $user = Auth::user();
        $user->subscription('default')->cancel();

        return back()->with(['success' => "サブスクリプションを解約しました。"]);
    }

    public function resumesubscription(Request $request){
        $user = Auth::user();
        $user->subscription('default')->resume();
        return back()->with(['success' => "サブスクリプションの解約をとりけしました。"]);
    }

    /*
    public function postSubscriptions(Request $request)
    {
        //登録済みのデフォルト支払い方法を使用
        $paymentMethod = Auth::user()->defaultPaymentMethod()->paymentMethod;
        Auth::user()->newSubscription('default', 'price_1OpAXaEGtiTwOKkt8euYUjuS')->create($paymentMethod);
        return response()->redirectTo('users/subscrioptions');
    }
    */
}
