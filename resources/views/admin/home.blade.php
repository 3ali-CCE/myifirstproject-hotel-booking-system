<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Dashboard - BookYourStay</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">

    <link rel="stylesheet" href="/assets/css/adminHome.css">

</head>

<body>

    <x-admin.navbar />

    <div class="admin-container">
        <x-admin.sidebar />

        <div class="admin-content">
            <div class="content-header">
                <h2><i class="fas fa-tachometer-alt me-2"></i>Admin Dashboard</h2>
                <p>Welcome back! Here's an overview of your hotel booking system.</p>
            </div>

            <div class="row mb-4">
                <div class="col-md-3">
                    <div class="stat-card">
                        <div class="stat-icon" style="background: linear-gradient(135deg, #e94560, #c23a51);">
                            <i class="fas fa-users"></i>
                        </div>
                        <div class="stat-info">
                            <!--ADD This Line \App\Models\User::count()-->>
                            <h3>{{ \App\Models\User::count() }}</h3>
                            <p>Total Users</p>
                        </div>
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="stat-card">
                        <div class="stat-icon" style="background: linear-gradient(135deg, #27ae60, #219150);">
                            <i class="fas fa-hotel"></i>
                        </div>
                        <div class="stat-info">
                            <h3>0</h3>
                            <p>Total Hotels</p>
                        </div>
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="stat-card">
                        <div class="stat-icon" style="background: linear-gradient(135deg, #3498db, #2980b9);">
                            <i class="fas fa-calendar-check"></i>
                        </div>
                        <div class="stat-info">
                            <h3>0</h3>
                            <p>Total Bookings</p>
                        </div>
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="stat-card">
                        <div class="stat-icon" style="background: linear-gradient(135deg, #f39c12, #e67e22);">
                            <i class="fas fa-dollar-sign"></i>
                        </div>
                        <div class="stat-info">
                            <h3>$0</h3>
                            <p>Total Revenue</p>
                        </div>
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col-md-12">
                    <div class="card">
                        <div class="card-header">
                            <h4><i class="fas fa-bolt me-2"></i>Quick Actions</h4>
                        </div>
                        <div class="card-body">
                            <div class="row">
                                <div class="col-md-4 mb-3">
                                    <a href="{{ route('adminUsers') }}" class="action-btn">
                                        <i class="fas fa-user-plus"></i>
                                        <span>Manage Users</span>
                                    </a>
                                </div>
                                <div class="col-md-4 mb-3">
                                    <a href="{{ route('admin.addHotel') }}" class="action-btn">
                                        <i class="fas fa-plus-circle"></i>
                                        <span>Add New Hotel</span>
                                    </a>
                                </div>
                                <div class="col-md-4 mb-3">
                                    <a href="{{ route('admin.addRoom') }}" class="action-btn">
                                        <i class="fas fa-plus-circle"></i>
                                        <span>Add New Room</span>
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="row mt-4">
                <div class="col-md-12">
                    <div class="card">
                        <div class="card-header">
                            <h4><i class="fas fa-user-friends me-2"></i>Recent Registered Users</h4>
                        </div>
                        <div class="card-body">
                            <table class="table">
                                <thead>
                                    <tr>
                                        <th>ID</th>
                                        <th>Name</th>
                                        <th>Email</th>
                                        <th>Phone</th>
                                        <th>Role</th>
                                        <th>Joined</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @php
                                        $users = \App\Models\User::latest()->take(5)->get();
                                    @endphp
                                    @foreach ($users as $user)
                                        <tr>
                                            <td>#{{ $user->id }}</td>
                                            <td>{{ $user->name }}</td>
                                            <td>{{ $user->email }}</td>
                                            <td>{{ $user->phone }}</td>
                                            <td>
                                                <span
                                                    class="badge {{ $user->role === 'admin' ? 'badge-admin' : 'badge-user' }}">
                                                    {{ $user->role }}
                                                </span>
                                            </td>
                                            <td>{{ $user->created_at->format('d M Y') }}</td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

</body>

</html>
