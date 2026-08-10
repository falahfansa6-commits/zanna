<?php

namespace App\Http\Controllers;

use App\Models\Service;
use App\Models\Slider;
use App\Models\Theproduk;
use App\Models\Product;
use App\Models\Theprodukimage;

class PelayananController extends Controller
{
    public function index()
    {
        $sliderPelayanan = Slider::where('posisi', 'pelayanan')
            ->where('status', 1)
            ->orderBy('urutan', 'asc')
            ->get();

        $services = Service::orderBy('urutan', 'asc')->get();

        $theproduk = Theproduk::orderBy('urutan', 'asc')->get();

       $product = Product::orderBy('urutan', 'asc')->get();
    
        $theprodukimage = Theprodukimage::latest()->first();

        return view('pelayanan', compact(
            'sliderPelayanan',
            'services',
            'theproduk',
            'product',
            'theprodukimage'
        ));
    }
}