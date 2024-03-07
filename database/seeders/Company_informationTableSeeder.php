<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\CompanyInformation;

class Company_informationTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $company_name = '名古屋飯株式会社';
        $company_establishment = '2011年 11月11日 設立';
        $company_representative = '名古屋 太郎';
        $company_postal_code = '555-5555';
        $company_address = '愛知県名古屋市中区〇丁目〇〇ー〇〇';
        $company_business = '飲食店の検索・予約';

        CompanyInformation::create([
            'name' => $company_name,
            'establishment' => $company_establishment,
            'representative' => $company_representative,
            'postal_code' => $company_postal_code,
            'address' => $company_address,
            'business' => $company_business,
        ]);

    }
}
