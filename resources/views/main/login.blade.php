<!DOCTYPE html>
<html lang="en">
<he..00ad>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login - BookYourStay</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">

    <link rel="stylesheet" href="/assets/css/login.css">
    </head>

    <body>

        <div class="login-page">
            <div class="login-background">
                <div class="login-overlay"></div>
            </div>

            <div class="container">
                <div class="row justify-content-center align-items-center min-vh-100">
                    <div class="col-md-5 col-lg-4">
                        <div class="login-card">
                            <div class="login-header">
                                <a href="{{ route('home') }}" class="login-logo">
                                    <i class="fas fa-hotel"></i> Book<span>Your</span>Stay
                                </a>
                                <p>Welcome back! Please login to continue</p>
                            </div>

                            <form method="POST" action={{ route('loginaction') }}>
                                @csrf

                                <div class="form-group">
                                    <label for="email">Email Address</label>
                                    <div class="input-group">
                                        <span class="input-icon"><i class="fas fa-envelope"></i></span>
                                        <input type="email" class="form-control" id="email" name="email"
                                            placeholder="Enter your email" required>
                                    </div>
                                    @error('email')
                                        <span class="error-message">{{ $message }}</span>
                                    @enderror
                                </div>

                                <div class="form-group">
                                    <label for="password">Password</label>
                                    <div class="input-group">
                                        <span class="input-icon"><i class="fas fa-lock"></i></span>
                                        <input type="password" class="form-control" id="password" name="password"
                                            placeholder="Enter your password" required>
                                        <button type="button" class="toggle-password" onclick="togglePassword()">
                                            <i class="fas fa-eye"></i>
                                        </button>
                                    </div>
                                    @error('password')
                                        <span class="error-message">{{ $message }}</span>
                                    @enderror
                                </div>



                                <button type="submit" class="btn-login">
                                    <i class="fas fa-sign-in-alt me-2"></i> Login
                                </button>
                            </form>
                            <div class="login-divider">
                                <span>or login with</span>
                            </div>

                            <!-- Social Login -->
                            <div class="social-login">
                                <button type="button" class="btn-social google">
                                    <i class="fab fa-google"></i> Google
                                </button>
                                <button type="button" class="btn-social facebook">
                                    <i class="fab fa-facebook-f"></i> Facebook
                                </button>
                            </div>


                            <div class="login-footer">
                                <p>Don't have an account?
                                    <a href="{{ route('signupPage') }}" class="signup-link">Sign up now</a>
                                </p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <script src="/assets/js/login.js"></script>
    </body>

</html>
