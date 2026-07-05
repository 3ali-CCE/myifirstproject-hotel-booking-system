<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Bookings - Admin</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">

    <link rel="stylesheet" href="/assets/css/adminbooking.css">
</head>

<body>


    <x-admin.navbar />

    <div class="container">
        @if (session('success'))
            <div class="alert alert-success">
                <i class="fas fa-check-circle me-2"></i> {{ session('success') }}
            </div>
        @endif

        <div class="table-card">
            <table class="table">
                <thead>
                    <tr>
                        <th>#</th>
                        <th>User</th>
                        <th>Room / Hotel</th>
                        <th>Dates</th>
                        <th>Guests</th>
                        <th>Total</th>
                        <th>Status</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($bookings as $booking)
                        <tr>
                            <td>{{ $booking->id }}</td>
                            <td>
                                <div class="user-info">
                                    <strong>{{ $booking->user->name }}</strong>
                                    <small>{{ $booking->user->email }}</small>
                                </div>
                            </td>
                            <td>
                                <div class="hotel-info">
                                    <strong>{{ $booking->room->room_type }} - Room
                                        #{{ $booking->room->room_number }}</strong>
                                    <small>{{ $booking->room->hotel->name }}</small>
                                </div>
                            </td>
                            <td>
                                <div>
                                    <strong>In:</strong>
                                    {{ \Carbon\Carbon::parse($booking->check_in)->format('d M Y') }}<br>
                                    <strong>Out:</strong>
                                    {{ \Carbon\Carbon::parse($booking->check_out)->format('d M Y') }}
                                </div>
                            </td>
                            <td>{{ $booking->total_guests }} Guest{{ $booking->total_guests > 1 ? 's' : '' }}</td>
                            <td class="price-cell">${{ $booking->total_price }}</td>
                            <td>
                                <span class="badge badge-{{ $booking->status }}">
                                    {{ ucfirst($booking->status) }}
                                </span>
                            </td>
                            <td>
                                <div class="actions-cell">
                                    <form method="POST" action="{{ route('booking.updateStatus', $booking->id) }}">
                                        @csrf
                                        <select name="status" class="status-select" onchange="this.form.submit()">
                                            <option value="pending"
                                                {{ $booking->status == 'pending' ? 'selected' : '' }}>Pending</option>
                                            <option value="confirmed"
                                                {{ $booking->status == 'confirmed' ? 'selected' : '' }}>Confirmed
                                            </option>
                                            <option value="cancelled"
                                                {{ $booking->status == 'cancelled' ? 'selected' : '' }}>Cancelled
                                            </option>
                                        </select>
                                    </form>
                                    
                                    <form method="POST" action="{{ route('booking.delete', $booking->id) }}"
                                        onsubmit="return confirm('Delete this booking?')">
                                        @csrf
                                        <button type="submit" class="btn-action btn-delete">
                                            <i class="fas fa-trash"></i> Delete
                                        </button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>

            @if ($bookings->count() == 0)
                <div class="empty-state">
                    <i class="fas fa-calendar-xmark"></i>
                    <h3>No bookings yet</h3>
                </div>
            @endif
        </div>
    </div>

</body>

</html>
