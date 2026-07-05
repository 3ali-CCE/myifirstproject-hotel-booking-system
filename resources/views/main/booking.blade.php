<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Book {{ $room->room_type }} - BookYourStay</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">

    <link rel="stylesheet" href="/assets/css/booking.css">
</head>

<body>

    <div class="booking-page">
        <div class="container">
            <div class="booking-wrapper">
                <a href="{{ route('hotelRooms', $room->hotel_id) }}" class="back-link">
                    <i class="fas fa-arrow-left"></i> Back to Rooms
                </a>

                <div class="booking-grid">
                    <div class="booking-room-info">
                        <div class="room-images">
                            <div class="main-image">
                                <img src="/assets/images/rooms/{{ $room->image }}" alt="{{ $room->room_type }}"
                                    id="mainRoomImage">
                            </div>

                            @if ($roomImages->count() > 0)
                                <div class="thumbnails">
                                    <img src="/assets/images/rooms/{{ $room->image }}" onclick="changeImage(this.src)"
                                        class="active">
                                    @foreach ($roomImages as $image)
                                        <img src="/assets/images/rooms/{{ $image->image }}"
                                            onclick="changeImage(this.src)">
                                    @endforeach
                                </div>
                            @endif
                        </div>
                        <div class="room-details">
                            <span class="room-type">{{ $room->room_type }} Room</span>
                            <span class="room-number">Room #{{ $room->room_number }}</span>
                            <h2>{{ $room->hotel->name }}</h2>
                            <p><i class="fas fa-map-marker-alt"></i> {{ $room->hotel->address }}</p>

                            <div class="room-features">
                                <span><i class="fas fa-user"></i> {{ $room->capacity }} Guests</span>
                                <span><i class="fas fa-bed"></i> {{ $room->room_type }}</span>
                            </div>

                            <div class="room-price">
                                <span class="price-label">Price per night</span>
                                <span class="price-amount">${{ $room->price }}</span>
                            </div>
                        </div>
                    </div>

                    <div class="booking-form-section">
                        <div class="form-header">
                            <h1><i class="fas fa-calendar-check"></i> Complete Your Booking</h1>
                            <p>Fill in the details to reserve your room</p>
                        </div>

                        <form method="POST" action="{{ route('booking.store') }}" id="bookingForm">
                            @csrf
                            <input type="hidden" name="room_id" value="{{ $room->id }}">

                            <div class="form-row">
                                <div class="form-group">
                                    <label><i class="fas fa-calendar"></i> Check-in</label>
                                    <input type="date" name="check_in" id="checkIn" class="form-control" required>
                                </div>
                                <div class="form-group">
                                    <label><i class="fas fa-calendar"></i> Check-out</label>
                                    <input type="date" name="check_out" id="checkOut" class="form-control" required>
                                </div>
                            </div>

                            <div class="form-group">
                                <label><i class="fas fa-users"></i> Number of Guests</label>
                                <select name="total_guests" class="form-control" id="guestsSelect">
                                    @for ($i = 1; $i <= $room->capacity; $i++)
                                        <option value="{{ $i }}">{{ $i }}
                                            Guest{{ $i > 1 ? 's' : '' }}</option>
                                    @endfor
                                </select>
                            </div>

                            <div class="form-group">
                                <label><i class="fas fa-credit-card"></i> Payment Method</label>
                                <div class="payment-options">
                                    <label class="payment-option">
                                        <input type="radio" name="payment_method" value="cash" checked>
                                        <span class="payment-card">
                                            <i class="fas fa-money-bill-wave"></i>
                                            <strong>Cash on Arrival</strong>
                                            <small>Pay when you arrive</small>
                                        </span>
                                    </label>
                                    <label class="payment-option">
                                        <input type="radio" name="payment_method" value="card">
                                        <span class="payment-card">
                                            <i class="fas fa-credit-card"></i>
                                            <strong>Credit Card</strong>
                                            <small>Pay now online</small>
                                        </span>
                                    </label>
                                </div>
                            </div>

                            <div class="form-group" id="card-details" style="display: none;">
                                <label><i class="fas fa-credit-card"></i> Card Details</label>
                                <input type="text" class="form-control mb-2" id="card-number"
                                    placeholder="Card Number" maxlength="19">
                                <div style="display: flex; gap: 10px;">
                                    <input type="text" class="form-control" id="card-expiry" placeholder="MM/YY"
                                        maxlength="5">
                                    <input type="text" class="form-control" id="card-cvv" placeholder="CVV"
                                        maxlength="3">
                                </div>
                            </div>

                            <!-- Price Summary -->
                            <div class="price-summary">
                                <div class="summary-row">
                                    <span>Price per night</span>
                                    <span>${{ $room->price }}</span>
                                </div>
                                <div class="summary-row">
                                    <span>Number of nights</span>
                                    <span id="nightsCount">0 nights</span>
                                </div>
                                <div class="summary-row total">
                                    <span>Total Price</span>
                                    <span id="totalPrice">$0</span>
                                </div>
                            </div>

                            <button type="submit" class="btn-confirm-booking" onclick="return validateBooking()">
                                <i class="fas fa-check-circle"></i> Confirm Booking
                            </button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script>
        var roomPrice = {{ $room->price }};
    </script>
    <script src="/assets/js/bookingcreate.js"></script>

</body>

</html>
