<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Shop;
use App\Models\Review;
//ここにストアのモデルを追加

class WebController extends Controller
{
    public function index()
    {
        $review_average_lists = [];
        $shops_id = Shop::where('recommend_flag', true)->pluck('id');
        foreach($shops_id as $shop_id) {
            $review_average = 0;
            $review_average = round(Review::where('shop_id', $shop_id )->pluck('score')->avg(),1); 
            $review_average_lists[$shop_id] = $review_average;
        }

        $recommend_shops = Shop::where('recommend_flag', true)->take(4)->get();
        return view('web.index', compact('recommend_shops', 'review_average_lists'));
    }
}


