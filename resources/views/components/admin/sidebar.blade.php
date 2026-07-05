<div class="admin-sidebar">
            <ul class="nav flex-column">
                <li class="nav-item">
                    <a href="{{route('adminHome')}}" class="nav-link active">
                        <i class="fas fa-home me-2"></i> Dashboard
                    </a>
                </li>
                <li class="nav-item">
                    <a href="{{route('adminUsers')}}" class="nav-link">
                        <i class="fas fa-users me-2"></i> Users
                    </a>
                </li>
                <li class="nav-item">
                    <a href="{{route('admin.hotels')}}" class="nav-link">
                        <i class="fas fa-hotel me-2"></i> Hotels
                    </a>
                </li>
                <li class="nav-item">
                    <a href="{{ route('admin.bookings') }}" class="nav-link">
                        <i class="fas fa-calendar me-2"></i> Bookings
                    </a>
                </li>
            </ul>
        </div>