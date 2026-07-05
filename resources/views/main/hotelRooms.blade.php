<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Rooms in {{ $hotel->name }} - BookYourStay</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">

    <link rel="stylesheet" href="/assets/css/home.css">
    <link rel="stylesheet" href="/assets/css/hotelRooms.css">
    <link rel="stylesheet" href="/assets/css/bookingModel.css">
</head>

<body>

    <x-layout>

        <div class="hotel-header">
            <div class="container">
                <a href="{{ route('cityHotels', $hotel->city_id) }}" class="back-link">
                    <i class="fas fa-arrow-left"></i> Back to Hotels
                </a>
                <h1>{{ $hotel->name }}</h1>
                <p><i class="fas fa-map-marker-alt me-2"></i>{{ $hotel->address }}</p>
            </div>
        </div>

        <section class="rooms-section">
            <div class="container">
                <h2><i class="fas fa-bed me-2"></i>Available Rooms</h2>

                <div class="rooms-grid">
                    @foreach ($rooms as $room)
                        @php
                            $hasActiveBooking = \App\Models\Booking::where('room_id', $room->id)
                                ->whereIn('status', ['confirmed'])
                                ->exists();
                            $isAvailable = !$hasActiveBooking;
                        @endphp

                        <div class="room-card"
                            onclick="openRoomDetails({{ $room->id }}, '{{ $room->room_type }}', {{ $room->price }}, {{ $room->capacity }}, '{{ $room->image }}', {{ $room->room_number }})">
                            <div class="room-image">
                                <img src="/assets/images/rooms/{{ $room->image }}" alt="{{ $room->room_type }}">
                                @if (!$isAvailable)
                                    <span class="unavailable-badge">Booked</span>
                                @else
                                    <span class="room-type-badge">{{ $room->room_type }}</span>
                                @endif
                            </div>
                            <div class="room-info">
                                <h3>{{ $room->room_type }} Room</h3>
                                <span class="room-number">Room #{{ $room->room_number }}</span>
                                <div class="room-details">
                                    <span><i class="fas fa-user"></i> {{ $room->capacity }} Guests</span>
                                    <span class="price">${{ $room->price }}<small>/night</small></span>
                                </div>

                                @if ($isAvailable)
                                    <button class="btn-book"
                                        onclick="event.stopPropagation(); bookRoom({{ $room->id }})">
                                        <i class="fas fa-calendar-check me-2"></i> Book Now
                                    </button>
                                @else
                                    <button class="btn-disabled" disabled>
                                        <i class="fas fa-times me-2"></i> Not Available
                                    </button>
                                @endif
                            </div>
                        </div>
                    @endforeach
                </div>

                @if ($rooms->count() == 0)
                    <div class="no-rooms">
                        <i class="fas fa-bed"></i>
                        <h3>No Rooms Available</h3>
                    </div>
                @endif
            </div>
        </section>

    </x-layout>

    <div id="detailsModal" class="modal">
        <div class="modal-content">
            <span class="close-btn" onclick="closeModal('detailsModal')">&times;</span>
            <div class="modal-body">
                <div class="modal-left">
                    <div class="room-main-image">
                        <img id="mainImage" src="" alt="Room">
                    </div>
                    <div class="details-info">
                        <h3 id="modalRoomType">Room Type</h3>
                        <p id="modalRoomNumber">Room #0</p>
                        <div class="details-features">
                            <span><i class="fas fa-user"></i> <b id="modalCapacity">0</b> Guests</span>
                            <span class="price">$<b id="modalPrice">0</b> <small>/night</small></span>
                        </div>
                        <div class="description-section">
                            <h4><i class="fas fa-info-circle me-2"></i>Description</h4>
                            <p id="roomDescription">Description here.</p>
                        </div>
                    </div>
                </div>
                <div class="modal-right">
                    <div class="action-box">
                        <h3><i class="fas fa-calendar-check me-2"></i>Book This Room</h3>
                        <p>Click below to reserve</p>
                        <button type="button" class="btn-book-action" onclick="goToBooking()">
                            <i class="fas fa-calendar-check me-2"></i> Book Now
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- MODAL 2: NOT LOGGED IN -->
    <div id="loginModal" class="modal">
        <div class="modal-content modal-small">
            <span class="close-btn" onclick="closeModal('loginModal')">&times;</span>
            <div class="modal-body-login">
                <div class="login-icon">
                    <i class="fas fa-shield-alt"></i>
                </div>
                <h3>Book Your Room Safely</h3>
                <p>Please register to keep your booking secure and safe. It only takes a minute!</p>
                <a href="{{ route('signupPage') }}" class="btn-register">
                    <i class="fas fa-user-plus me-2"></i> Sign Up Now
                </a>
                <p class="login-footer">Already have an account? <a href="{{ route('loginPage') }}">Login</a></p>
            </div>
        </div>
    </div>
    <div id="loginCheck" data-logged="{{ auth()->check() ? '1' : '0' }}" style="display:none;"></div>
    <script>
        var isLoggedIn = {{ auth()->check() ? 'true' : 'false' }};
    </script>
    <script src="/assets/js/booking.js"></script>

</body>

</html>
