<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add Hotel - BookYourStay Admin</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">

    <link rel="stylesheet" href="/assets/css/addHotel.css">
</head>

<body>

    <x-admin.navbar />
    
    <div class="admin-content">
       
        <div class="page-header">
            <h1><i class="fas fa-hotel me-2"></i>Add New Hotel</h1>
            <p>Add a hotel or city to the system</p>
        </div>

        <div class="forms-wrapper">

            <div class="form-card">
                <h3><i class="fas fa-city me-2"></i>Add New City</h3>

                <form method="POST" action="{{ route('addCity') }}" enctype="multipart/form-data">
                    @csrf

                    <div class="form-group">
                        <label>City Name</label>
                        <input type="text" name="name" class="form-control" placeholder="e.g. Jbeil, Beirut"
                            required>
                    </div>

                    <div class="form-group">
                        <label>City Image</label>
                        <input type="file" name="image" class="form-control" required>
                    </div>

                    <div class="form-group">
                        <label>Country</label>
                        <input type="text" name="country" class="form-control">
                    </div>

                    <div class="form-actions">
                        <button type="submit" class="btn-submit">
                            <i class="fas fa-plus me-2"></i> Add City
                        </button>
                    </div>
                </form>
            </div>

            <div class="form-card">
                <h3><i class="fas fa-hotel me-2"></i>Add New Hotel</h3>

                <form method="POST" action="{{ route('addHotel') }}" enctype="multipart/form-data">
                    @csrf

                    <div class="form-group">
                        <label>Hotel Name</label>
                        <input type="text" name="name" class="form-control" placeholder="e.g. Golden Hotel Jbeil"
                            required>
                    </div>

                    <div class="form-group">
                        <label>City</label>
                        <select name="city_id" class="form-control" required>
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
                        <label>Description</label>
                        <textarea name="description" class="form-control" rows="3" placeholder="Describe the hotel..." required></textarea>
                    </div>

                    <div class="form-group">
                        <label>Hotel Image</label>
                        <input type="file" name="image" class="form-control" required>
                    </div>

                    <div class="form-group">
                        <label>Address</label>
                        <input type="text" name="address" class="form-control" placeholder="Full address" required>
                    </div>

                    <div class="form-group">
                        <label>Status</label>
                        <select name="status" class="form-control">
                            <option value="active">Active</option>
                            <option value="inactive">Inactive</option>
                        </select>
                    </div>

                    <div class="form-actions">
                        <button type="submit" class="btn-submit">
                            <i class="fas fa-plus-circle me-2"></i> Add Hotel
                        </button>
                        <a href="{{ route('adminHome') }}" class="btn-cancel">Cancel</a>
                    </div>
                </form>
            </div>

        </div>
    </div>

</body>

</html>
