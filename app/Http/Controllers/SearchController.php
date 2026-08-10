<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\Slider;
use App\Models\OurValue;
use App\Models\Secound;
use App\Models\Service;
use App\Models\Tentang;
use App\Models\Location;
use App\Models\Theproduk;
use App\Models\Product;
use App\Models\EmpatKontak;
use App\Models\Hub_kami;

class SearchController extends Controller
{
    public function index(Request $request)
    {
        $keyword = trim($request->k);

        if (!$keyword) {
            return back();
        }

        $search = [

            // ================= BERANDA =================

            [
                'model' => Slider::class,
                'route' => route('beranda'),
                'anchor' => 'slider',
                'columns' => ['judul'],
            ],

            [
                'model' => OurValue::class,
                'route' => route('beranda'),
                'anchor' => 'ourvalue',
                'columns' => ['judul','isi'],
            ],

            [
                'model' => Secound::class,
                'route' => route('beranda'),
                'anchor' => 'secound',
                'columns' => ['judul','isi'],
            ],

            // ================= ABOUT =================

            [
                'model' => Tentang::class,
                'route' => route('about'),
                'anchor' => 'tentang',
                'columns' => ['judul','isi'],
            ],

            [
                'model' => Location::class,
                'route' => route('about'),
                'anchor' => 'location',
                'columns' => ['nama_kota', 'alamat'],
            ],

            // ================= LAYANAN =================

            [
                'model' => Service::class,
                'route' => route('pelayanan'),
                'anchor' => 'service',
                'columns' => ['judul','isi'],
            ],

            [
                'model' => Theproduk::class,
                'route' => route('pelayanan'),
                'anchor' => 'theproduk',
                'columns' => ['judul','isi'],
            ],

            [
                'model' => Product::class,
                'route' => route('pelayanan'),
                'anchor' => 'product',
                'columns' => ['judul','isi'],
            ],

            // ================= KONTAK =================

            [
                'model' => EmpatKontak::class,
                'route' => route('kontak'),
                'anchor' => 'empatkontak',
                'columns' => ['judul','isi','link'],
            ],

            [
                'model' => Hub_kami::class,
                'route' => route('kontak'),
                'anchor' => 'hubkami',
                'columns' => ['nama','no_wa','email','isi'],
            ],

        ];

        foreach ($search as $item) {

            $query = $item['model']::query();

            $query->where(function ($q) use ($item,$keyword){

                foreach($item['columns'] as $column){

                    $q->orWhere($column,'LIKE',"%{$keyword}%");

                }

            });

            if($query->exists()){

                return redirect($item['route'].'#'.$item['anchor']);

            }

        }

        return redirect()->back()
    ->with('error', 'Tidak ada hasil yang ditemukan untuk "' . $keyword . '"');
    }
}