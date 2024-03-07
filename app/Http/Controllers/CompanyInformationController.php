<?php

namespace App\Http\Controllers;

use App\Models\CompanyInformation;
use Illuminate\Http\Request;

class CompanyInformationController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $companyinformation = CompanyInformation::where('id', '1')->first();

        return view('companyinformations.index', compact('companyinformation'));
    }

}
