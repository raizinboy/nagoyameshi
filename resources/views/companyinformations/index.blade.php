@extends('layouts.app')

@section('content')
<div class="container">
    <h1 class="text-center mt-5">会社概要</h1>
    <table id="company_table" class="mt-4 m-auto">
        <tr>
            <th class="h4 col-md-6 pt-2 pb-2 ps-2">会社名：</th>
            <td class="h4 col-md-6 ps-2">{{ $companyinformation->name }}</td>
        </tr>
        <tr>
            <th class="h4 col-md-6 pt-2 pb-2 ps-2">代表者：</th>
            <td class="h4 col-md-6 ps-2">{{ $companyinformation->representative }}</td>
        </tr>
        <tr>
            <th class="h4 col-md-6 pt-2 pb-2 ps-2">設立日：</th>
            <td class="h4 col-md-6 ps-2">{{ $companyinformation->establishment }}</td>
        </tr>
        <tr>
            <th class="h4 com-md-6 pt-2 pb-2 ps-2">郵便番号：</th>
            <td class="h4 col-md-6 ps-2">{{ $companyinformation->postal_code }}</td>
        </tr>
        <tr>
            <th class="h4 col-md-6 pt-2 pb-2 ps-2">住所：</th>
            <td class="h4 col-md-6 ps-2">{{ $companyinformation->address }}</td>
        </tr>
        <tr>
            <th class="h4 col-md-6 pt-2 pb-2 ps-2">事業内容：</th>
            <td class="h4 col-md-6 ps-2">{{ $companyinformation->business }}</td>
        <tr>
    </table>
    <div class="text-center mt-5">
    <a class="btn btn-primary text-center" href="{{ route('top') }}">TOPに戻る</a>
    </div>
</div>
@endsection

