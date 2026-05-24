@extends('layouts.user')

@section('title', 'Readora - Online Bookstore')

@section('content')

    {{-- ===== Banner Section ===== --}}
    <section class="banner py-5 bg-light">
        <div class="container banner-container d-flex flex-wrap align-items-center justify-content-between">
            <div class="banner-left">
                <h1 class="fw-bold mb-3">
                    Find & Search Your <br>
                    <span class="text-primary">Favorite</span> Book
                </h1>
                <p class="mb-4">Discover thousands of books from top authors.</p>
                <a href="#shop" class="btn btn-primary">Read More</a>
            </div>
            <div class="banner-right mt-4 mt-md-0">
                <img src="{{ asset('images/banner-books.png') }}" alt="Books" class="img-fluid" style="max-width: 450px;">
            </div>
        </div>
    </section>

    {{-- ===== Services Section ===== --}}
    <section class="services py-5 text-center">
        <div class="container services-container d-flex flex-wrap justify-content-around gap-4">
            <div>
                <h3 class="fw-semibold mb-2">Reliable Shipping</h3>
                <p>Fast and safe delivery nationwide.</p>
            </div>
            <div>
                <h3 class="fw-semibold mb-2">You’re Safe with Us</h3>
                <p>Secure payment and data protection.</p>
            </div>
            <div>
                <h3 class="fw-semibold mb-2">Best Quality & Pricing</h3>
                <p>Affordable books with high quality.</p>
            </div>
        </div>
    </section>

    {{-- ===== Bookstore Section ===== --}}
    <section id="shop" class="bookstore py-5 bg-light">
        <div class="container">
            <h2 class="text-center fw-bold mb-4">Best Online Bookstore to Buy Books</h2>

            <div class="book-tabs text-center mb-4">
                <button class="tab active btn btn-outline-primary me-2">Best Sellers</button>
                <button class="tab btn btn-outline-primary me-2">Bundles & Promotions</button>
                <button class="tab btn btn-outline-primary">On Sale</button>
            </div>

            <div class="book-list d-flex flex-wrap justify-content-center gap-4">
                @forelse ($products as $book)
                    <div class="book-item text-center p-3 border rounded shadow-sm" style="width: 200px;">
                        <img src="{{ asset($book->image) }}" alt="{{ $book->name }}" class="img-fluid mb-2" style="height: 250px; object-fit: cover;">
                        <h5 class="mb-2">{{ $book->name }}</h5>
                        <p class="price text-primary fw-bold mb-3">{{ number_format($book->price) }} VNĐ</p>
                        <a href="{{ route('user.products.show', $book->id) }}" class="btn btn-sm btn-success">
                            📖 Xem chi tiết
                        </a>
                    </div>
                @empty
                    <p class="text-center text-muted">No books available at the moment.</p>
                @endforelse
            </div>
        </div>
    </section>

    {{-- ===== Testimonials Section ===== --}}
    <section class="testimonials py-5">
        <div class="container text-center">
            <h2 class="fw-bold mb-4">Customer Testimonials</h2>
            <div class="testimonial-list d-flex flex-wrap justify-content-center gap-3">
                <div class="testimonial bg-white shadow-sm p-3 rounded" style="width: 280px;">
                    "Great bookstore, fast delivery!" ⭐⭐⭐⭐⭐
                </div>
                <div class="testimonial bg-white shadow-sm p-3 rounded" style="width: 280px;">
                    "Amazing variety of books." ⭐⭐⭐⭐⭐
                </div>
                <div class="testimonial bg-white shadow-sm p-3 rounded" style="width: 280px;">
                    "Excellent customer service." ⭐⭐⭐⭐⭐
                </div>
            </div>
        </div>
    </section>

    {{-- ===== Refer a Friend Section ===== --}}
    <section class="refer py-5 bg-light text-center">
        <div class="container">
            <h3 class="fw-bold mb-3">Refer a Friend</h3>
            <p class="mb-3">And get <span class="text-success fw-bold">$30</span></p>
            <button class="btn btn-outline-success">Refer Here</button>
        </div>
    </section>

    {{-- ===== How to Order Section ===== --}}
    <section class="how-to-order py-5">
        <div class="container text-center">
            <h2 class="fw-bold mb-4">How to Order Books Online</h2>
            <div class="steps d-flex flex-wrap justify-content-center gap-4">
                <div class="step border rounded p-3 w-25"> <h4>Register</h4> </div>
                <div class="step border rounded p-3 w-25"> <h4>Shop</h4> </div>
                <div class="step border rounded p-3 w-25"> <h4>Make Payment</h4> </div>
                <div class="step border rounded p-3 w-25"> <h4>Relax</h4> </div>
            </div>
        </div>
    </section>

    {{-- ===== Recently Added Section (DỮ LIỆU TỪ DB) ===== --}}
    <section class="recent py-5 bg-light">
        <div class="container text-center">
            <h2 class="fw-bold mb-4">Recently Added</h2>
            <div class="recent-list d-flex flex-wrap justify-content-center gap-3">
                @forelse ($recentBooks as $recent)
                    <div>
                        <img src="{{ asset($recent->image) }}" alt="{{ $recent->name }}" class="img-fluid">
                        <p>{{ $recent->name }}</p>
                    </div>
                @empty
                    <p class="text-muted">No recent books available.</p>
                @endforelse
            </div>
        </div>
    </section>

@endsection
