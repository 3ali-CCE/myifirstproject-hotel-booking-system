<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add Room - BookYourStay Admin</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">

    <link rel="stylesheet" href="/assets/css/addRoom.css">
</head>

<body>

    <x-admin.navbar />


    <div class="admin-content">
        <div class="page-header">
            <h1><i class="fas fa-bed me-2"></i>Add New Room</h1>
            <p>Add a room to a hotel</p>
        </div>

        <div class="forms-wrapper">

            <div class="form-card">
                <h3><i class="fas fa-door-open me-2"></i>Room Information</h3>

                <form method="POST" action="{{ route('addRoom') }}" enctype="multipart/form-data">
                    @csrf

                    <div class="form-group">
                        <label>City</label>
                        <select name="city_id" id="citySelect" class="form-control" required onchange="loadHotels()">
                            <option value="">Select City</option>
                            @php
                                $cities = App\Models\City::orderBy('name')->get();
                            @endphp
                            @foreach ($cities as $city)
                                <option value="{{ $city->id }}">{{ $city->name }}</option>
                            @endforeach
                        </select>
                    </div>

                    <div class="form-group">
                        <label>Hotel</label>
                        <select name="hotel_id" id="hotelSelect" class="form-control" required disabled>
                            <option value="">Select City First</option>
                        </select>
                    </div>

                    <div class="form-group">
                        <label>Room Type</label>
                        <select name="room_type" class="form-control" required>
                            <option value="">Select Room Type</option>
                            <option value="Single">Single Room</option>
                            <option value="Double">Double Room</option>
                            <option value="Twin">Twin Room</option>
                            <option value="Suite">Suite</option>
                            <option value="Deluxe">Deluxe</option>
                            <option value="Family">Family Room</option>
                        </select>
                    </div>

                    <div class="row">
                        <div class="col-6">
                            <div class="form-group">
                                <label>Room Number</label>
                                <input type="number" name="room_number" class="form-control" placeholder="101"
                                    required>
                            </div>
                        </div>
                        <div class="col-6">
                            <div class="form-group">
                                <label>Capacity (Guests)</label>
                                <select name="capacity" class="form-control" required>
                                    <option value="1">1 Guest</option>
                                    <option value="2">2 Guests</option>
                                    <option value="3">3 Guests</option>
                                    <option value="4">4 Guests</option>
                                    <option value="5">5 Guests</option>
                                    <option value="6">6 Guests</option>
                                </select>
                            </div>
                        </div>
                    </div>

                    <div class="form-group">
                        <label>Price per Night ($)</label>
                        <input type="number" name="price" class="form-control" placeholder="100" required>
                    </div>

                    <div class="form-group">
                        <label>Main Image</label>
                        <input type="file" name="image" class="form-control" required>
                    </div>

                    <div class="form-group">
                        <label>Availability</label>
                        <select name="is_available" class="form-control">
                            <option value="1">Available</option>
                            <option value="0">Not Available</option>
                        </select>
                    </div>

                    <div class="form-actions">
                        <button type="submit" class="btn-submit">
                            <i class="fas fa-plus me-2"></i> Add Room
                        </button>
                    </div>
                </form>
            </div>

            <div class="form-card">
                <h3><i class="fas fa-images me-2"></i>Room Images Gallery</h3>
                <p class="text-muted mb-3">Add more images to show in room details</p>

                <form method="POST" action="{{ route('addRoomImages') }}" enctype="multipart/form-data">
                    @csrf

                    <div class="form-group">
                        <label>City</label>
                        <select name="city_id" id="imageCitySelect" class="form-control" required
                            onchange="loadHotelsForImages()">
                            <option value="">Select City</option>
                            @php
                                $cities = App\Models\City::orderBy('name')->get();
                            @endphp
                            @foreach ($cities as $city)
                                <option value="{{ $city->id }}">{{ $city->name }}</option>
                            @endforeach
                        </select>
                    </div>

                    <div class="form-group">
                        <label>Hotel</label>
                        <select name="hotel_id" id="imageHotelSelect" class="form-control" required disabled
                            onchange="loadRoomsForImages()">
                            <option value="">Select City First</option>
                        </select>
                    </div>

                    <div class="form-group">
                        <label>Room</label>
                        <select name="room_id" id="imageRoomSelect" class="form-control" required disabled>
                            <option value="">Select Hotel First</option>
                        </select>
                    </div>

                    <div class="form-group">
                        <label>Additional Images</label>
                        <input type="file" name="images[]" class="form-control" multiple>
                        <small class="text-muted">Hold Ctrl/Cmd to select multiple</small>
                    </div>

                    <div class="form-actions">
                        <button type="submit" class="btn-submit btn-green">
                            <i class="fas fa-images me-2"></i> Upload Images
                        </button>
                    </div>
                </form>

                <hr class="my-4">

                <h4>Existing Room Images</h4>

                <div class="images-gallery">
                    @php
                        $allRooms = App\Models\Room::with('images')->get();
                    @endphp

                    @foreach ($allRooms as $room)
                        @if ($room->images->count() > 0)
                            <div class="room-gallery-item">
                                <h5>{{ $room->room_type }} - Room {{ $room->room_number }}</h5>
                                <div class="gallery-images">
                                    @foreach ($room->images as $img)
                                        <img src="/assets/images/rooms/{{ $img->image }}" alt="Room Image">
                                    @endforeach
                                </div>
                            </div>
                        @endif
                    @endforeach
                </div>
            </div>

        </div>

        <a href="{{ route('adminHome') }}" class="btn-cancel-bottom">Cancel</a>
    </div>

    <script>
        var allHotels = @php echo json_encode(App\Models\Hotel::where('status', 'active')->get()); @endphp;

        function loadHotels() {
            var cityId = document.getElementById('citySelect').value;
            var hotelSelect = document.getElementById('hotelSelect');

            hotelSelect.innerHTML = '<option value="">Select Hotel</option>';

            if (!cityId) {
                hotelSelect.disabled = true;
                hotelSelect.innerHTML = '<option value="">Select City First</option>';
                return;
            }

            var filteredHotels = allHotels.filter(function(hotel) {
                return hotel.city_id == cityId;
            });

            if (filteredHotels.length > 0) {
                hotelSelect.disabled = false;
                filteredHotels.forEach(function(hotel) {
                    var option = document.createElement('option');
                    option.value = hotel.id;
                    option.text = hotel.name;
                    hotelSelect.appendChild(option);
                });
            } else {
                hotelSelect.disabled = true;
                hotelSelect.innerHTML = '<option value="">No Hotels in this City</option>';
            }
        }

        function loadHotelsForImages() {
            var cityId = document.getElementById('imageCitySelect').value;
            var hotelSelect = document.getElementById('imageHotelSelect');

            hotelSelect.innerHTML = '<option value="">Select Hotel</option>';
            document.getElementById('imageRoomSelect').innerHTML = '<option value="">Select Hotel First</option>';
            document.getElementById('imageRoomSelect').disabled = true;

            if (!cityId) {
                hotelSelect.disabled = true;
                hotelSelect.innerHTML = '<option value="">Select City First</option>';
                return;
            }

            var filteredHotels = allHotels.filter(function(hotel) {
                return hotel.city_id == cityId;
            });

            if (filteredHotels.length > 0) {
                hotelSelect.disabled = false;
                filteredHotels.forEach(function(hotel) {
                    var option = document.createElement('option');
                    option.value = hotel.id;
                    option.text = hotel.name;
                    hotelSelect.appendChild(option);
                });
            } else {
                hotelSelect.disabled = true;
                hotelSelect.innerHTML = '<option value="">No Hotels</option>';
            }
        }

        function loadRoomsForImages() {
            var hotelId = document.getElementById('imageHotelSelect').value;
            var roomSelect = document.getElementById('imageRoomSelect');

            roomSelect.innerHTML = '<option value="">Select Room</option>';

            if (!hotelId) {
                roomSelect.disabled = true;
                roomSelect.innerHTML = '<option value="">Select Hotel First</option>';
                return;
            }

            var allRooms = @php echo json_encode(App\Models\Room::with('hotel')->get()->toArray()); @endphp;

            var filteredRooms = allRooms.filter(function(room) {
                return room.hotel_id == hotelId;
            });

            if (filteredRooms.length > 0) {
                roomSelect.disabled = false;
                filteredRooms.forEach(function(room) {
                    var option = document.createElement('option');
                    option.value = room.id;
                    option.text = room.room_type + ' - Room ' + room.room_number;
                    roomSelect.appendChild(option);
                });
            } else {
                roomSelect.disabled = true;
                roomSelect.innerHTML = '<option value="">No Rooms</option>';
            }
        }
    </script>

</body>

</html>
