<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Hotels in {{ $city->name }} - BookYourStay</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">

    <link rel="stylesheet" href="/assets/css/cityHotels.css">
    <link rel="stylesheet" href="/assets/css/home.css">
</head>

<body>
    <x-layout>

        <div class="city-header" style="background-image: url('/assets/images/cities/{{ $city->image }}');">
            <div class="container">
                <a href="{{ route('home') }}" class="back-link">
                    <i class="fas fa-arrow-left"></i> Back to Cities
                </a>
                <h1><i class="fas fa-hotel me-2"></i>Hotels in {{ $city->name }}</h1>
                <p>Choose your perfect hotel in {{ $city->name }}, {{ $city->country }}</p>
            </div>
        </div>

        <section class="hotels-section">
            <div class="container">
                @if ($hotels->count() > 0)
                    <div class="row">
                        @foreach ($hotels as $hotel)
                            @if ($hotel->status === 'active')
                                <div class="col-lg-4 col-md-6">
                                    <div class="hotel-card">
                                        <div class="hotel-image">
                                            <img src="/assets/images/hotels/{{ $hotel->image }}"
                                                alt="{{ $hotel->name }}">
                                            <span class="hotel-badge">Available</span>
                                        </div>
                                        <div class="hotel-content">
                                            <h3>{{ $hotel->name }}</h3>
                                            <p class="hotel-description">{{ $hotel->description }}</p>
                                            <div class="hotel-address">
                                                <i class="fas fa-map-marker-alt me-2"></i>{{ $hotel->address }}
                                            </div>
                                            <div class="hotel-footer">
                                                <a href="{{ route('hotelRooms', $hotel->id) }}" class="btn-view-rooms">
                                                    <i class="fas fa-door-open me-2"></i>View Rooms
                                                </a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            @endif
                        @endforeach
                    </div>
                @else
                    <div class="no-hotels">
                        <i class="fas fa-hotel"></i>
                        <h3>No Hotels Available</h3>
                        <p>There are no hotels in {{ $city->name }} yet. Check back later!</p>

                        <a href="{{ route('home') }}" class="btn-back-cities">Browse Other Cities</a>
                    </div>
                @endif
            </div>
        </section>
    </x-Layout>
    <script>
        // Quick Link Modals
        document.querySelectorAll('[data-modal]').forEach(function(link) {
            link.addEventListener('click', function(e) {
                e.preventDefault();
                var id = this.getAttribute('data-modal');
                document.getElementById('modal-' + id)?.classList.add('active');
            });
        });

        document.querySelectorAll('.quick-modal-overlay').forEach(function(overlay) {
            // close on X button
            overlay.querySelector('.quick-modal-close')?.addEventListener('click', function() {
                overlay.classList.remove('active');
            });

            // close on backdrop click
            overlay.addEventListener('click', function(e) {
                if (e.target === overlay) overlay.classList.remove('active');
            });
        });

        // close on Escape key
        document.addEventListener('keydown', function(e) {
            if (e.key === 'Escape') {
                document.querySelectorAll('.quick-modal-overlay.active')
                    .forEach(function(m) {
                        m.classList.remove('active');
                    });
            }
        });
    </script>
</body>

</html>
