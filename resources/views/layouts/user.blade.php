<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Readora - Online Bookstore')</title>

    <link rel="stylesheet" href="{{ asset('css/style.css') }}">
    @stack('styles')
    @yield('styles')

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
</head>
<body>

    {{-- ===== Navbar dùng component Blade ===== --}}
    <x-navbar />

    {{-- ===== Nội dung từng trang (thay đổi động) ===== --}}
    <main class="page-content" style="min-height: 70vh; padding: 40px 0;">
        @yield('content')
    </main>

    {{-- ===== Footer cố định, không dính nội dung ===== --}}
    <footer class="footer mt-auto py-4 bg-light border-top">
        <div class="container footer-container d-flex flex-wrap justify-content-between gap-4">

            <div>
                <h3 class="mb-2">Readora</h3>
                <p>Your best online bookstore for all genres.</p>
            </div>

            <div>
                <h4 class="mb-2">Catalog</h4>
                <ul class="list-unstyled">
                    <li><a href="#" class="footer-link">Authors</a></li>
                    <li><a href="#" class="footer-link">Publishers</a></li>
                    <li><a href="#" class="footer-link">Categories</a></li>
                </ul>
            </div>

            <div>
                <h4 class="mb-2">Support</h4>
                <ul class="list-unstyled">
                    <li><a href="#" class="footer-link">Contact Us</a></li>
                    <li><a href="#" class="footer-link">FAQ</a></li>
                    <li><a href="#" class="footer-link">Privacy Policy</a></li>
                </ul>
            </div>

            <div>
                <h4 class="mb-2">Follow Us</h4>
                <p>
                    <a href="#" class="me-2 text-dark"><i class="fab fa-facebook"></i></a>
                    <a href="#" class="me-2 text-dark"><i class="fab fa-instagram"></i></a>
                    <a href="#" class="me-2 text-dark"><i class="fab fa-twitter"></i></a>
                    <a href="#" class="text-dark"><i class="fab fa-tiktok"></i></a>
                </p>
            </div>

        </div>

        <div class="text-center mt-3 small text-muted">
            © {{ date('Y') }} Readora Bookstore. All rights reserved.
        </div>
    </footer>

    {{-- ===== Optional: Bootstrap JS (nếu cần) ===== --}}
    {{-- <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script> --}}
</body>
</html>
