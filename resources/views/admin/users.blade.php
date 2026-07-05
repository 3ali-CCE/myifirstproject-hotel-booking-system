<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Manage Users - BookYourStay Admin</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">

    <link rel="stylesheet" href="/assets/css/adminUsers.css">
    <link rel="stylesheet" href="/assets/css/adminHome.css">


</head>

<body>

    <x-admin.navbar />

    <x-admin.sidebar />
    <div class="admin-main">
        <div class="page-header">
            <div class="row align-items-center">
                <div class="col-md-6">
                    <h1><i class="fas fa-users me-2"></i>Manage Users</h1>
                    <p>View, edit and manage all registered users in your system</p>
                </div>
            </div>
        </div>

        <div class="stats-row">
            <div class="stat-box">
                <div class="stat-icon"><i class="fas fa-users"></i></div>
                <div class="stat-text">
                    <span class="stat-number">{{ \App\Models\User::count() }}</span>
                    <span class="stat-label">Total Users</span>
                </div>
            </div>
            <div class="stat-box">
                <div class="stat-icon admin"><i class="fas fa-user-shield"></i></div>
                <div class="stat-text">
                    <span class="stat-number">{{ \App\Models\User::where('role', 'admin')->count() }}</span>
                    <span class="stat-label">Admins</span>
                </div>
            </div>
            <div class="stat-box">
                <div class="stat-icon user"><i class="fas fa-user"></i></div>
                <div class="stat-text">
                    <span class="stat-number">{{ \App\Models\User::where('role', 'user')->count() }}</span>
                    <span class="stat-label">Regular Users</span>
                </div>
            </div>
        </div>

        <div class="filters-bar">
            <form method="GET" action="{{ route('adminUsers') }}" class="filter-group search-form">
                <div class="search-box">
                    <i class="fas fa-search"></i>
                    <input type="text" name="search" class="search-input" placeholder="Search users..."
                        value="{{ request('search') }}">
                </div>
            </form>

            <form method="GET" action="{{ route('adminUsers') }}" class="filter-group">
                <select name="role" class="filter-select" onchange="this.form.submit()">
                    <option value="">All Roles</option>
                    <option value="admin" {{ request('role') == 'admin' ? 'selected' : '' }}>Admin</option>
                    <option value="user" {{ request('role') == 'user' ? 'selected' : '' }}>User</option>
                </select>
            </form>

            <form method="GET" action="{{ route('adminUsers') }}" class="filter-group">
                <select name="sort" class="filter-select" onchange="this.form.submit()">
                    <option value="newest" {{ request('sort') == 'newest' || !request('sort') ? 'selected' : '' }}>
                        Newest First</option>
                    <option value="oldest" {{ request('sort') == 'oldest' ? 'selected' : '' }}>Oldest First</option>
                </select>
            </form>
        </div>

        <div class="users-table-wrapper">
            <table class="users-table">
                <thead>
                    <tr>
                        <th>User</th>
                        <th>Email</th>
                        <th>Phone</th>
                        <th>Role</th>
                        <th>Joined Date</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @php
                        $usersQuery = \App\Models\User::query();

                        if (request('role')) {
                            $usersQuery->where('role', request('role'));
                        }

                        if (request('sort') == 'oldest') {
                            $usersQuery->oldest();
                        } else {
                            $usersQuery->latest();
                        }

                        $users = $usersQuery->get();
                    @endphp

                    @foreach ($users as $user)
                        <tr class="user-row" data-name="{{ strtolower($user->name) }}"
                            data-email="{{ strtolower($user->email) }}" data-role="{{ $user->role }}"
                            data-date="{{ $user->created_at }}">
                            <td>
                                <div class="user-cell">
                                    <div class="user-avatar">{{ substr($user->name, 0, 1) }}</div>
                                    <div class="user-details">
                                        <span class="user-name">{{ $user->name }}</span>
                                        <span class="user-id">#{{ $user->id }}</span>
                                    </div>
                                </div>
                            </td>
                            <td><span class="email-cell">{{ $user->email }}</span></td>
                            <td><span class="phone-cell">{{ $user->phone ?? '-' }}</span></td>
                            <td>
                                <span class="role-badge {{ $user->role }}">
                                    @if ($user->role === 'admin')
                                        <i class="fas fa-shield-alt me-1"></i>Admin
                                    @else
                                        <i class="fas fa-user me-1"></i>User
                                    @endif
                                </span>
                            </td>
                            <td><span class="date-cell">{{ $user->created_at->format('d M Y') }}</span></td>
                            <td>
                                <div class="action-btns">
                                    <button class="action-btn edit"
                                        onclick="openEditModal({{ $user->id }}, '{{ $user->name }}', '{{ $user->email }}', '{{ $user->phone ?? '' }}', '{{ $user->role }}')">
                                        <i class="fas fa-edit"></i>
                                    </button>
                                    <button class="action-btn delete"
                                        onclick="confirmDelete({{ $user->id }}, '{{ $user->name }}')">
                                        <i class="fas fa-trash-alt"></i>
                                    </button>
                                </div>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>

        <!-- Pagination -->
        <div class="pagination-wrapper">
            <div class="pagination-info">
                Showing <strong>{{ $users->count() }}</strong> users
            </div>
        </div>
    </div>

    <div id="editModal" class="modal">
        <div class="modal-content">
            <span class="close-btn" onclick="closeModal('editModal')">&times;</span>
            <div class="modal-body">
                <h3><i class="fas fa-edit me-2"></i>Edit User</h3>
                <form method="POST" action="" id="editForm">
                    @csrf
                    <input type="hidden" name="id" id="editUserId">

                    <div class="form-group">
                        <label>Name</label>
                        <input type="text" name="name" id="editName" class="form-control" required>
                    </div>

                    <div class="form-group">
                        <label>Email</label>
                        <input type="email" name="email" id="editEmail" class="form-control" required>
                    </div>

                    <div class="form-group">
                        <label>Phone</label>
                        <input type="tel" name="phone" id="editPhone" class="form-control">
                    </div>

                    <div class="form-group">
                        <label>Role</label>
                        <select name="role" id="editRole" class="form-control">
                            <option value="user">User</option>
                            <option value="admin">Admin</option>
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
                <h3>Delete User?</h3>
                <p>Are you sure you want to delete <strong id="deleteUserName"></strong>?</p>
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

    <script src="/assets/js/adminUser.js"></script>

</body>

</html>
