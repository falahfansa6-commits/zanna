<?php
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\SliderController;
use App\Http\Controllers\BerandaController;
use App\Http\Controllers\PelayananController;
use App\Http\Controllers\LocationController;
use App\Http\Controllers\KontakController;
use App\Http\Controllers\TentangController;
use App\Http\Controllers\OurValueController;
use App\Http\Controllers\OurValueImageController;
use App\Http\Controllers\SecoundController;
use App\Http\Controllers\ServiceController;
use App\Http\Controllers\TheprodukController;
use App\Http\Controllers\Admin\BaruController;
use App\Models\Location;
use App\Models\Tentang;
use App\Http\Controllers\TeleponController;
use App\Http\Controllers\TheprodukimageController;
use App\Http\Controllers\HubKamiController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\AboutController;
use App\Http\Controllers\Admin\LayananController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\admin\HubKontakController;
use App\Http\Controllers\SearchController;
use App\Http\Controllers\WebsiteKontakController;
use App\Http\Controllers\ProductController;

Route::resource('products', ProductController::class);



Route::get('/kontak', [WebsiteKontakController::class, 'index']);


// Halaman kontak (form)
Route::get('/kontak', function () {
    return view('kontak');
})->name('kontak');




Route::get('/', [BerandaController::class, 'index'])
    ->name('beranda');

Route::get('/pelayanan', [PelayananController::class, 'index'])
    ->name('pelayanan');

Route::get('/about', function () {
    $locations = Location::latest()->get();
    $tentang = Tentang::latest()->first();
    return view('about', compact('locations', 'tentang'));
})->name('about');

Route::get('/kontak', [KontakController::class, 'index'])
    ->name('kontak');

    






Route::get('/admin/baru', [BaruController::class, 'index'])->name('admin.baru');
Route::post('/admin/baru', [BaruController::class, 'store'])->name('admin.baru.store');
Route::post('/admin/baru/update', [BaruController::class, 'update'])->name('admin.baru.update');





Route::get('/telepon', [TeleponController::class, 'index'])
    ->name('telepon');

Route::get('/kontak', [KontakController::class, 'index'])
    ->name('kontak');



// Login
Route::get('/login', [AuthController::class, 'index'])->name('login');
Route::post('/login', [AuthController::class, 'authenticate']);
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

// Semua halaman admin wajib login
Route::middleware('admin.auth')->prefix('admin')->group(function () {

    Route::get('/dashboard', [DashboardController::class, 'index'])
        ->name('admin.dashboard');

    Route::get('/about', [AboutController::class, 'index'])
        ->name('admin.about');

    Route::get('/layanan', [LayananController::class, 'index'])
        ->name('admin.layanan');

    Route::get('/kontak', [HubKontakController::class, 'index'])
           ->name('admin.hubkontak');

    Route::resource('slider', SliderController::class);
   
Route::resource('location', LocationController::class);
Route::resource('tentang', TentangController::class);
Route::resource('ourvalues', OurValueController::class);
Route::resource('ourvalueimage', OurValueImageController::class);
Route::resource('secound', SecoundController::class);
Route::resource('service', ServiceController::class);
Route::resource('theproduk', TheprodukController::class);
Route::resource('theprodukimage', TheprodukimageController::class);


Route::post('/hub_kami', [HubKamiController::class, 'store'])
    ->name('hub_kami.store');

Route::get('/hub_kami', [HubKamiController::class, 'index'])
    ->name('hub.index');
    Route::resource('hub_kami', HubKamiController::class);
    Route::resource('empat-kontak', App\Http\Controllers\EmpatKontakController::class);
  
 });

//search
Route::get('/search', [SearchController::class, 'index'])->name('search');