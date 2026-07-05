<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sign Up - BookYourStay</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">

    <link rel="stylesheet" href="assets/css/signup.css">
</head>

<body>

    <div class="signup-page">
        <div class="signup-background">
            <div class="signup-overlay"></div>
        </div>

        <div class="container">
            <div class="row justify-content-center align-items-center min-vh-100">
                <div class="col-md-6 col-lg-5">
                    <div class="signup-card">
                        <div class="signup-header">
                            <a href="{{ route('home') }}" class="signup-logo">
                                <i class="fas fa-hotel"></i> Book<span>Your</span>Stay
                            </a>
                            <p>Create your account to get started</p>
                        </div>

                        <form id="signupForm" action={{ route('registeraction') }} method="POST">
                            @csrf
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="first_name">Full Name</label>
                                        <div class="input-group">
                                            <span class="input-icon"><i class="fas fa-user"></i></span>
                                            <input type="text" name="name" class="form-control" id="first_name"
                                                placeholder="Full Name" required>
                                        </div>
                                        <span class="error-message" id="first_name_error"></span>
                                    </div>
                                </div>

                            </div>

                            <div class="form-group">
                                <label for="email">Email Address</label>
                                <div class="input-group">
                                    <span class="input-icon"><i class="fas fa-envelope"></i></span>
                                    <input type="email" name="email" class="form-control" id="email"
                                        placeholder="Enter your email" required>
                                </div>
                                <span class="error-message" id="email_error"></span>
                            </div>

                            <div class="form-group">
                                <label for="phone">Phone Number</label>
                                <div class="input-group">
                                    <span class="input-icon"><i class="fas fa-phone"></i></span>
                                    <input type="tel" name="phone" class="form-control" id="phone"
                                        placeholder="Enter your phone number" required>
                                </div>
                                <span class="error-message" id="phone_error"></span>
                            </div>

                            <div class="form-group">
                                <label for="password">Password</label>
                                <div class="input-group">
                                    <span class="input-icon"><i class="fas fa-lock"></i></span>
                                    <input type="password" class="form-control" id="password"
                                        placeholder="Create a password" required>
                                    <button type="button" class="toggle-password" onclick="togglePassword('password')">
                                        <i class="fas fa-eye"></i>
                                    </button>
                                </div>

                                <div class="password-strength">
                                    <div class="strength-bar">
                                        <div class="strength-fill" id="strength_fill"></div>
                                    </div>
                                    <span class="strength-text" id="strength_text">Password strength</span>
                                </div>
                                <span class="error-message" id="password_error"></span>
                            </div>

                            <div class="form-group">
                                <label for="confirm_password">Confirm Password</label>
                                <div class="input-group">
                                    <span class="input-icon"><i class="fas fa-lock"></i></span>
                                    <input type="password" class="form-control" id="confirm_password"
                                        placeholder="Confirm your password" name="password" required>
                                    <button type="button" class="toggle-password"
                                        onclick="togglePassword('confirm_password')">
                                        <i class="fas fa-eye"></i>
                                    </button>
                                </div>
                                <span class="error-message" id="confirm_password_error"></span>
                            </div>

                            <div class="form-check terms-check">
                                <input type="checkbox" class="form-check-input" id="terms" required
                                    name="policy">
                                <label class="form-check-label" for="terms">
                                    I agree to the <a href="#">Terms of Service</a> and <a
                                        href="#">Privacy Policy</a>
                                </label>
                            </div>

                            <button type="submit" class="btn-signup">
                                <i class="fas fa-user-plus me-2"></i> Create Account
                            </button>
                        </form>
                        <!-- Divider -->
                        <div class="signup-divider">
                            <span>or sign up with</span>
                        </div>

                        <!-- Social Sign Up -->
                        <div class="social-signup">
                            <button type="button" class="btn-social google">
                                <i class="fab fa-google"></i> Google
                            </button>
                            <button type="button" class="btn-social facebook">
                                <i class="fab fa-facebook-f"></i> Facebook
                            </button>
                        </div>

                        <div class="signup-footer">
                            <p>Already have an account?
                                <a href="{{ route('loginPage') }}" class="login-link">Login now</a>
                            </p>
                        </div>
                    </div>
                </div>

                <div class="col-md-6 col-lg-5 d-none d-md-block">
                    <div class="signup-info">
                        <h2>Join BookYourStay</h2>
                        <p>Create an account to access exclusive hotel deals and manage your bookings easily.</p>

                        <ul class="benefits-list">
                            <li>
                                <i class="fas fa-check-circle"></i>
                                <span>Book hotels worldwide</span>
                            </li>
                            <li>
                                <i class="fas fa-check-circle"></i>
                                <span>Exclusive member discounts</span>
                            </li>
                            <li>
                                <i class="fas fa-check-circle"></i>
                                <span>Free cancellation on most bookings</span>
                            </li>
                            <li>
                                <i class="fas fa-check-circle"></i>
                                <span>24/7 customer support</span>
                            </li>
                            <li>
                                <i class="fas fa-check-circle"></i>
                                <span>Earn rewards on every booking</span>
                            </li>
                        </ul>

                        <div class="signup-stats">
                            <div class="stat-item">
                                <span class="stat-number">500+</span>
                                <span class="stat-label">Hotels</span>
                            </div>
                            <div class="stat-item">
                                <span class="stat-number">10K+</span>
                                <span class="stat-label">Users</span>
                            </div>
                            <div class="stat-item">
                                <span class="stat-number">50+</span>
                                <span class="stat-label">Countries</span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- JavaScript -->
    <script src="assets/js/signup.js"></script>
</body>

</html>
