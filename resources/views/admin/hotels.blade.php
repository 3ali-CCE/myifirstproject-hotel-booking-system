<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Manage Hotels - BookYourStay Admin</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">

    <link rel="stylesheet" href="/assets/css/adminHotels.css">
    <link rel="stylesheet" href="/assets/css/adminHome.css">
</head>

<body>

    <x-admin.navbar />
    <x-admin.sidebar />

    <div class="admin-main">
        <div class="page-header">
            <div class="row align-items-center">
                <div class="col-md-6">
                    <h1><i class="fas fa-hotel me-2"></i>Manage Hotels</h1>
                    <p>View, edit and manage all hotels in your system</p>
                </div>
            </div>
        </div>

        <!-- Stats -->
        <div class="stats-row">
            <div class="stat-box">
                <div class="stat-icon"><i class="fas fa-hotel"></i></div>
                <div class="stat-text">
                    <span class="stat-number">{{ \App\Models\Hotel::count() }}</span>
                    <span class="stat-label">Total Hotels</span>
                </div>
            </div>
            <div class="stat-box">
                <div class="stat-icon active"><i class="fas fa-check-circle"></i></div>
                <div class="stat-text">
                    <span class="stat-number">{{ \App\Models\Hotel::count() }}</span>
                    <span class="stat-label">Active Hotels</span>
                </div>
            </div>
            <div class="stat-box">
                <div class="stat-icon rooms"><i class="fas fa-bed"></i></div>
                <div class="stat-text">
                    <span class="stat-number">{{ \App\Models\Room::count() }}</span>
                    <span class="stat-label">Total Rooms</span>
                </div>
            </div>
        </div>

        <div class="filters-bar">
            <div class="search-box">
                <i class="fas fa-search"></i>
                <input type="text" id="searchInput" class="search-input" placeholder="Search hotels...">
            </div>
            <select id="cityFilter" class="filter-select">
                <option value="">All Cities</option>
                @foreach (\App\Models\City::all() as $city)
                    <option value="{{ $city->id }}">{{ $city->name }}</option>
                @endforeach
            </select>
            <select id="sortFilter" class="filter-select">
                <option value="newest">Newest First</option>
                <option value="oldest">Oldest First</option>
            </select>
        </div>

        <div class="hotels-table-wrapper">
            <table class="hotels-table">
                <thead>
                    <tr>
                        <th>Hotel</th>
                        <th>City</th>
                        <th>Address</th>
                        <th>Rooms</th>
                        <th>Status</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($hotels as $hotel)
                        <tr class="hotel-row" data-name="{{ strtolower($hotel->name) }}"
                            data-city="{{ strtolower($hotel->city->name ?? '') }}" data-city-id="{{ $hotel->city_id }}"
                            data-status="{{ $hotel->is_active ?? 1 }}" data-date="{{ $hotel->created_at }}">
                            <td>
                                <div class="hotel-cell">
                                    <img src="/assets/images/hotels/{{ $hotel->image }}" alt="{{ $hotel->name }}">
                                    <div class="hotel-details">
                                        <span class="hotel-name">{{ $hotel->name }}</span>
                                    </div>
                                </div>
                            </td>
                            <td><span class="city-cell">{{ $hotel->city->name ?? '-' }}</span></td>
                            <td><span class="address-cell">{{ $hotel->address }}</span></td>
                            <td><span class="rooms-cell">{{ $hotel->rooms->count() }}</span></td>
                            <td>
                                <span class="status-badge {{ $hotel->is_active ?? 1 ? 'active' : 'inactive' }}">
                                    {{ $hotel->is_active ?? 1 ? 'Active' : 'Inactive' }}
                                </span>
                            </td>
                            <td>
                                <div class="action-btns">
                                    <button class="action-btn edit"
                                        onclick="openEditModal({{ $hotel->id }}, '{{ $hotel->name }}', '{{ $hotel->address }}', '{{ $hotel->description }}', {{ $hotel->city_id }}, {{ $hotel->is_active ?? 1 }})">
                                        <i class="fas fa-edit"></i>
                                    </button>
                                    <button class="action-btn delete"
                                        onclick="confirmDelete({{ $hotel->id }}, '{{ $hotel->name }}')">
                                        <i class="fas fa-trash-alt"></i>
                                    </button>
                                </div>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>

        @if ($hotels->count() == 0)
            <div class="empty-state">
                <i class="fas fa-hotel"></i>
                <h3>No hotels yet</h3>
            </div>
        @endif
    </div>

    <div id="editModal" class="modal">
        <div class="modal-content">
            <span class="close-btn" onclick="closeModal('editModal')">&times;</span>
            <div class="modal-body">
                <h3><i class="fas fa-edit me-2"></i>Edit Hotel</h3>
                <form method="POST" action="" id="editForm">
                    @csrf
                    <input type="hidden" name="id" id="editHotelId">

                    <div class="form-group">
                        <label>Name</label>
                        <input type="text" name="name" id="editName" class="form-control" required>
                    </div>

                    <div class="form-group">
                        <label>Address</label>
                        <input type="text" name="address" id="editAddress" class="form-control" required>
                    </div>

                    <div class="form-group">
                        <label>City</label>
                        <select name="city_id" id="editCity" class="form-control">
                            @foreach (\App\Models\City::all() as $city)
                                <option value="{{ $city->id }}">{{ $city->name }}</option>
                            @endforeach
                        </select>
                    </div>

                    <div class="form-group">
                        <label>Status</label>
                        <select name="is_active" id="editStatus" class="form-control">
                            <option value="1">Active</option>
                            <option value="0">Inactive</option>
                        </select>
                    </div>

                    <button type="submit" class="btn-save">
                        <i class="fas fa-save me-2"></i>Save Changes
                    </button>
                </form>
            </div>
        </div>
    </div>

    <div id="deleteModal" class="modal">
        <div class="modal-content modal-small">
            <span class="close-btn" onclick="closeModal('deleteModal')">&times;</span>
            <div class="modal-body">
                <div class="delete-icon"><i class="fas fa-exclamation-triangle"></i></div>
                <h3>Delete Hotel?</h3>
                <p>Are you sure you want to delete <strong id="deleteHotelName"></strong>?</p>
                <form method="POST" action="" id="deleteForm">
                    @csrf
                    <button type="submit" class="btn-delete-confirm">
                        <i class="fas fa-trash me-2"></i>Yes, Delete
                    </button>
                    <button type="button" class="btn-cancel" onclick="closeModal('deleteModal')">Cancel</button>
                </form>
            </div>
        </div>
    </div>

    <script src="/assets/js/adminHotels.js"></script>

</body>

</html>
