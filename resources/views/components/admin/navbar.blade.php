<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin - BookYourStay</title>
    
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    
    <link rel="stylesheet" href="/assets/css/admin.css">
</head>
<body>

    <div class="admin-wrapper">
        <!-- Navbar -->
        <nav class="admin-navbar">
            <a href="{{ url()->previous() }}" class="btn-back">
                <i class="fas fa-arrow-left"></i>
            </a>
            <a href="{{ route('home') }}" class="admin-logo">
                <i class="fas fa-hotel"></i>
                BookYour<span>Stay</span>
            </a>
            <div class="navbar-right">
                <a href="{{ route('logout') }}" class="btn-logout"
                   onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                    <i class="fas fa-sign-out-alt"></i>
                </a>
                <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                    @csrf
                </form>
            </div>
        </nav>

        

        <!-- Content -->
        <main class="admin-content">
            {{ $slot }}
        </main>
    </div>

</body>
</html>