<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>PRINTEX | Beranda</title>
    
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">
      <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css">
    <link rel="stylesheet" href="{{ asset('css/pel.css') }}">
</head>
<body>

    <!-- NAVBAR -->
    <nav>
        @include('layouts.navbar')
    </nav>

   @include('layouts.slider')

    <!-- LAYANAN SECTION -->
    <section id="service" class="printex-section">
        <div class="printex-top">
            <div class="printex-left">
                <div class="printex-logo">
                    <img src="{{ asset('img/p.png') }}" alt="Logo">
                </div>
                <div class="printex-title">
                    <h1>Produk<br>Layanan</h1>
                    <div class="printex-arrow">
                        <img src="{{ asset('img/panahkebawah.png') }}" alt="Panah">
                    </div>
                </div>
            </div>
            <div class="printex-right">
                <div class="printex-desc">
                    Sebagai penyedia solusi cetak tekstil terpercaya, Printex menawarkan berbagai layanan dengan kualitas terbaik yang disesuaikan untuk kebutuhan industri fashion, konveksi, hingga bisnis skala kecil dan menengah. Dengan dukungan teknologi modern dan tenaga profesional, kami siap membantu kebutuhan produksi tekstil secara cepat, presisi, dan berkualitas tinggi.
                </div>
            </div>
        </div>

        <div class="printex-services">
            @forelse($services as $service)
                <div class="printex-card">
                    <h3>{{ $service->judul }}</h3>
                    <p>{!! $service->isi !!}</p>
                </div>
            @empty
                <p class="empty-text">Belum ada layanan.</p>
            @endforelse
        </div>
    </section>

    <!-- GRID PRODUCTS ("THE PRODUCTS") -->
    <div id="theproduk" class="ks-full-page-container"> 
        @if($theprodukimage)
            <div class="ks-box-top-left" style="background-image: url('{{ asset($theprodukimage->gambar) }}');"></div>
        @else
            <div class="ks-box-top-left" style="background-color: #222222;"></div>
        @endif

        <div class="ks-box-top-right">
            <div class="ks-products-header">
                <span>the products</span>
                <div class="ks-arrow-circle">
                    <svg viewBox="0 0 24 24" fill="none" stroke="#d80c18" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round">
                        <line x1="7" y1="7" x2="17" y2="17"></line>
                        <polyline points="17 7 17 17 7 17"></polyline>
                    </svg>
                </div>
            </div>
            
            <div class="ks-products-grid">
                @forelse($theproduk as $item)
                    <div class="ks-product-card">
                        <h3>{{ $item->judul }}</h3>
                        <p>{!! $item->isi !!}</p>
                    </div>
                @empty
                    <div class="ks-product-card">
                        <h3>Belum Ada Produk</h3>
                        <p>Silakan tambahkan data melalui halaman admin.</p>
                    </div>
                @endforelse
            </div>
        </div>
    </div> 

    @foreach($product as $item)

<section id="produk{{ $item->urutan }}" class="item-section">

    <div class="item-left">

        <div class="item-badge">
            <div class="item-icon">
                <img src="{{ asset('img/panah ke atas.png') }}" alt="">
            </div>

            <span class="item-badge-text">
                the process
            </span>
        </div>

        <div class="item-content">

            <div class="item-header">

                <span class="item-num">
                    {{ str_pad($item->urutan,2,'0',STR_PAD_LEFT) }}
                </span>

                <h2 class="item-title">
                    {{ $item->judul }}
                </h2>

            </div>

            <p class="item-desc">
                {!! $item->isi !!}
            </p>

        </div>

    </div>

    <div class="item-right">

        <div class="item-frame">

            <img class="item-img"
                 src="{{ asset($item->gambar) }}"
                 alt="{{ $item->judul }}">

        </div>

    </div>

</section>

@endforeach


     
  
  @include('layouts.floating')
    <!-- FOOTER -->
    <footer class="printex-footer">
        @include('layouts.footer')
    </footer>

    <!-- JAVASCRIPT SLIDER -->
    <script>
        let slider = document.getElementById('slider');
        let slides = document.querySelectorAll('.slide');
        let index = 0;

        function nextSlide() {
            if(slides.length <= 1) return;
            index++;
            if(index >= slides.length) {
                index = 0;
            }
            updateSliderPosition();
        }

        function prevSlide() {
            if(slides.length <= 1) return;
            index--;
            if(index < 0) {
                index = slides.length - 1;
            }
            updateSliderPosition();
        }

        function updateSliderPosition() {
            slider.style.transform = `translateX(-${index * 100}%)`;
        }

        if(slides.length > 1) {
            setInterval(nextSlide, 4000);
        }
    </script>
</body>
</html>