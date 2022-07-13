<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Penjualan;
use App\Models\Produk;

class IndexController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    

    public function index()
    {

        return view('index',[
            'penjualan'=> Penjualan::all(),
            'produk' => Produk::all(),
        ]);
    }
    //
}
