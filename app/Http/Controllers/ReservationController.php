<?php

namespace App\Http\Controllers;

use App\Models\Reservation;
use Illuminate\Http\Request;
use App\Models\Shop;
use Illuminate\Support\Facades\Auth;

class ReservationController extends Controller
{
    
    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        
        $request->validate([
            'reserve_day' => 'required',
            'reserve_time' => 'required',
            'reserve_people' => 'required',
        ]);

        $currentDate = now();
        $dateNow = strtotime($currentDate);
        $reserveTime = strtotime($request->input('reserve_time'));
        $reserveDay = strtotime($request->input('reserve_day'));
        $date = date("w", strtotime($request->input('reserve_day')));

        $shop_regular_holiday = Shop::where('id', $request->input('shop_id'))->pluck('regular_holiday');


        if ( $dateNow >= $reserveDay && $dateNow >= $reserveTime ) { 
        return back()->with('message', '予約時間は現在時刻より未来の時間を選択してください。');
        } elseif( strpos($shop_regular_holiday ,$date)) {
            return back()->with('message', '予約日が定休日のため予約できませんでした。');
        } else { 
        $reservation = new Reservation();
        $reservation->shop_id = $request->input('shop_id');
        $reservation->user_id = Auth::user()->id;
        $reservation->reserve_day = $request->input('reserve_day');
        $reservation->reserve_time = $request->input('reserve_time');
        $reservation->reserve_people = $request->input('reserve_people');
        $reservation->reserve_message = $request->input('reserve_message');
        $reservation->save();

        return back()->with('message', '予約が完了しました。');
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Reservation  $reservation
     * @return \Illuminate\Http\Response
     */
    public function show()
    {
        $reservations = Reservation::where('user_id', Auth::user()->id)->get();

        return view('users.reservation', compact('reservations'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Reservation  $reservation
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request)
    {
        $reservation=Reservation::find($request->input('id'));
        $reservation->delete();

        return to_route('reservation.show');
    }
}
