<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login Admin Printex</title>
    <!-- Menambahkan Font Inter untuk kesan modern & premium -->
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&display=swap" rel="stylesheet">
    <!-- Menambahkan Lucide Icons untuk ikon input (Opsional, menggunakan SVG inline di bawah) -->
</head>
<body>
    <link rel="stylesheet" href="{{ asset('css/login.css') }}">

<div class="container">

    <div class="logo-container">
        <img src="{{ asset('img/printexlogo.png') }}" alt="Printex Logo" class="main-logo">
    </div>

    
    <div class="login-box">
        <h2>LOGIN ADMIN PRINTEX</h2>

        @if(session('error'))
            <div class="error-alert">
                {{ session('error') }}
            </div>
        @endif

        <form action="{{ url('/login') }}" method="POST">
            @csrf

            
            <div class="input-group">
                <label for="username">Username</label>
                <div class="input-wrapper">
                    <span class="input-icon">
                     
                        <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M19 21v-2a4 4 0 0 0-4-4H9a4 4 0 0 0-4 4v2"></path><circle cx="12" cy="7" r="4"></circle></svg>
                    </span>
                    <input
                        type="text"
                        id="username"
                        name="username"
                        placeholder="username"
                        value="{{ old('username') }}"
                        required
                        autocomplete="off"
                    >
                </div>
            </div>

          
            <div class="input-group">
                <label for="password">Password</label>
                <div class="input-wrapper">
                    <span class="input-icon">
                     
                        <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><rect x="3" y="11" width="18" height="11" rx="2" ry="2"></rect><path d="M7 11V7a5 5 0 0 1 10 0v4"></path></svg>
                    </span>
                    <input
                        type="password"
                        id="password"
                        name="password"
                        placeholder="Masukan Password"
                        required
                    >
                    <button type="button" class="toggle-password" onclick="togglePasswordVisibility()">
                        
                        <svg id="eye-icon" xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M1 12s4-8 11-8 11 8 11 8-4 8-11 8-11-8-11-8z"></path><circle cx="12" cy="12" r="3"></circle></svg>
                    </button>
                </div>
            </div>

          
            <button type="submit" class="btn-login">
                LOGIN
            </button>
        </form>

        
      <div class="login-footer">
    <a href="#" class="footer-link">Lupa Kata Sandi?</a>

    <p>
        Butuh Bantuan?
        <a href="https://wa.me/6285136436973"
           class="footer-link-highlight"
           target="_blank">
            Hubungi IT Support
        </a>
    </p>
</div>
    
    <div class="copyright">
        copyright © PRINTEX IT Solution
    </div>
</div>

<script>
    // Fungsi untuk memperlihatkan/menyembunyikan password
    function togglePasswordVisibility() {
        const passwordInput = document.getElementById('password');
        const eyeIcon = document.getElementById('eye-icon');
        
        if (passwordInput.type === 'password') {
            passwordInput.type = 'text';
            eyeIcon.style.opacity = '0.5'; // Indikator mata saat password terlihat
        } else {
            passwordInput.type = 'password';
            eyeIcon.style.opacity = '1';
        }
    }
</script>

</body>
</html>