<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>BookYourStay - Luxury Hotel Booking</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">
 
    <link rel="stylesheet" href="/assets/css/home.css">

</head>

<body>

    <x-Layout>

        <section class="hero-section">
            <div class="container">
                <div class="hero-content">
                    <h1>Find Your Perfect <span>Hotel</span></h1>
                    <p>Discover the best hotels around the world at the best prices</p>
                </div>

                <div class="search-box mt-4">
                    <p class="search-label">Where are you going?</p>
                    <div class="search-row">
                        <div class="search-input-wrapper">
                            <i class="fas fa-map-marker-alt search-icon"></i>
                            <input type="text" class="form-control"
                                placeholder="Search destinations, hotels, cities...">
                        </div>
                        <button type="submit" class="btn btn-search">
                            <i class="fas fa-search"></i> Search
                        </button>
                    </div>
                    <div class="popular-tags">
                        <span>Popular:</span>
                        <button type="button" class="tag-btn">Paris</button>
                        <button type="button" class="tag-btn">Dubai</button>
                        <button type="button" class="tag-btn">New York</button>
                        <button type="button" class="tag-btn">Lebanon</button>
                        <button type="button" class="tag-btn">London</button>
                    </div>
                </div>
        </section>

        <section class="cities-section" id="cities">
            <div class="container">
                <div class="section-title">
                    <h2>Popular <span>Destinations</span></h2>
                    <p>Choose your perfect destination</p>
                </div>

                <div class="row">
                    @php
                        $cities = App\Models\City::latest()->get();
                    @endphp

                    @foreach ($cities as $city)
                        <div class="col-lg-4 col-md-6" data-name="{{ strtolower($city->name) }}"
                            data-country="{{ strtolower($city->country) }}">
                            <a href="{{ route('cityHotels', $city->id) }}" class="city-card">
                                <div class="city-image">
                                    <img src="/assets/images/cities/{{ $city->image }}" alt="{{ $city->name }}">
                                    <div class="city-overlay">
                                        <h3>{{ $city->name }}</h3>
                                        <p>{{ $city->country }}</p>
                                    </div>
                                </div>
                            </a>
                        </div>
                    @endforeach
                </div>
            </div>
        </section>
        <br>
        <hr>

        <section class="features-section">
            <div class="container">
                <div class="section-title">
                    <h2>Why Choose <span>Us</span>?</h2>
                    <p>We provide the best service for your perfect stay</p>
                </div>

                <div class="row">
                    <div class="col-lg-4 col-md-6">
                        <div class="feature-box">
                            <div class="feature-icon">
                                <i class="fas fa-shield-alt"></i>
                            </div>
                            <h4>Secure Booking</h4>
                            <p>Your payment and personal information are always protected with us.</p>
                        </div>
                    </div>
                    <div class="col-lg-4 col-md-6">
                        <div class="feature-box">
                            <div class="feature-icon">
                                <i class="fas fa-tags"></i>
                            </div>
                            <h4>Best Prices</h4>
                            <p>We guarantee the best prices for all our featured hotels worldwide.</p>
                        </div>
                    </div>
                    <div class="col-lg-4 col-md-6">
                        <div class="feature-box">
                            <div class="feature-icon">
                                <i class="fas fa-headset"></i>
                            </div>
                            <h4>24/7 Support</h4>
                            <p>Our support team is available round the clock to assist you anytime.</p>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <!-- ============ STATS SECTION ============ -->
        <section class="stats-section">
            <div class="container">
                <div class="row">
                    <div class="col-6 col-lg-3">
                        <div class="stat-item">
                            <span class="stat-number">500+</span>
                            <span class="stat-label">Hotels Listed</span>
                        </div>
                    </div>
                    <div class="col-6 col-lg-3">
                        <div class="stat-item">
                            <span class="stat-number">10K+</span>
                            <span class="stat-label">Happy Customers</span>
                        </div>
                    </div>
                    <div class="col-6 col-lg-3">
                        <div class="stat-item">
                            <span class="stat-number">50+</span>
                            <span class="stat-label">Countries</span>
                        </div>
                    </div>
                    <div class="col-6 col-lg-3">
                        <div class="stat-item">
                            <span class="stat-number">100%</span>
                            <span class="stat-label">Satisfaction</span>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <!-- ============ NEWSLETTER SECTION ============ -->
        <section class="hotels-carousel-section">
            <div class="carousel-title">
                <h2>Featured <span>Stays</span></h2>
                <p>A glimpse of the hotels waiting for you</p>
            </div>

            <div class="carousel-wrapper">
                <div class="carousel-track">
                    @foreach ($hotels->take(6) as $hotel)
                        <img src="/assets/images/hotels/{{ $hotel->image }}" alt="{{ $hotel->name }}">
                    @endforeach
                </div>
            </div>
        </section>
    </x-Layout>

    <!-- ============ SCROLL TO TOP ============ -->
    <a href="#" class="scroll-top" id="scrollTop">
        <i class="fas fa-arrow-up"></i>
    </a>

    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>

    <script src="/assets/js/home.js"></script>

</body>

</html>
