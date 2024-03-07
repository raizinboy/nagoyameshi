<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Shop;

class ShopsTableseeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $names = ['あいう店', 'かきく宛', 'さしす亭', 'たちつ屋', 'なにヌードル', 'はひふレストラン', 'まみむカフェ', 
        'やゆよ食堂', 'らりるうどん', 'ワオンパスタ'
        ];

        $furigana = ['あいうてん', 'かきくえん', 'さしすてい', 'たちつや', 'なにぬーどる', 'はひふれすとらん', 'まみむかふぇ', 
        'やゆよしょくどう', 'らりるうどん', 'わおんぱすた'
        ];

        $category_id_lists = ['3', '2', '5', '17', '4', '16', '7', 
        '5', '20', '11' 
        ];

        $descriptions = ['お寿司屋あいう店です。', '焼肉屋かきくえんです。', '定食屋さしす亭です。', 'はんばーぐ専門店たちつ屋です。', 'ラーメン屋なにヌードルです。', 'ステーキ専門店はひふレストランです。', 'おしゃれなまみむカフェです。',
        '定食屋やゆよ食堂です。', 'うどん屋らりるうどんです。', 'フランス料理屋ワオンパスタです。'
        ];

        $prices = ['1000~2000', '1000~2000', '1000~2000', '1000~2000', '1000~2000', '2000~3000', '2000~3000',
        '5000~6000', '5000~6000', '5000~6000'
        ];

        $business_hours_lists = [ '9:00 ~ 22:00', '9:00 ~ 22:00','9:00 ~ 22:00', '9:00 ~ 22:00', '11:00 ~ 22:00', '11:00 ~ 22:00', '11:00 ~ 22:00', 
        '11:00 ~ 24:00', '11:00 ~ 24:00', '11:00 ~ 24:00'
        ];

        $postal_codes = [ '111-1111', '222-2222', '333-3333', '444-4444', '555-5555', '666-6666', '777-7777',
        '888-8888', '999-9999', '123-4567'
        ];

        $addresses = ['愛知県名古屋市〇〇〇町〇丁目〇〇', '愛知県名古屋市〇〇〇町〇丁目〇〇', '愛知県名古屋市〇〇〇町〇丁目〇〇', '愛知県名古屋市〇〇〇町〇丁目〇〇', '愛知県名古屋市〇〇〇町〇丁目〇〇', '愛知県名古屋市〇〇〇町〇丁目〇〇', '愛知県名古屋市〇〇〇町〇丁目〇〇', 
        '愛知県名古屋市〇〇〇町〇丁目〇〇', '愛知県名古屋市〇〇〇町〇丁目〇〇', '愛知県名古屋市〇〇〇町〇丁目〇〇',
        ];

        $phones = ['090-1234-1234', '090-1111-1111', '090-2222-2222', '090-3333-3333', '090-4444-4444', '090-5555-5555', '090-6666-6666',
        '090-7777-7777', '090-8888-8888', '090-9999-9999'
        ];

        $regular_holidays = ['月曜日', '火曜日', '水曜日', '木曜日', '金曜日', '月曜日、火曜日', '水曜日', 
        '土曜日', '火曜日、木曜日', '日曜日'
        ];

        $num = 0;
        foreach($names as $name){
            Shop::create([
                'name' => $name,
                'furigana' => $furigana[$num],
                'category_id' => $category_id_lists[$num],
                'description' => $descriptions[$num],
                'price' => $prices[$num],
                'business_hours' => $business_hours_lists[$num],
                'postal_code' => $postal_codes[$num],
                'address' => $addresses[$num],
                'phone' => $phones[$num],
                'regular_holiday' => $regular_holidays[$num],
            ]);
            $num += 1;
        };
    }
}