function togglePassword(inputId) {
    var input = document.getElementById(inputId);
    var btn = input.nextElementSibling;
    var icon = btn.querySelector('i');
    
    if (input.type === "password") {
        input.type = "text";
        icon.classList.remove("fa-eye");
        icon.classList.add("fa-eye-slash");
    } else {
        input.type = "password";
        icon.classList.remove("fa-eye-slash");
        icon.classList.add("fa-eye");
    }
}
function checkPasswordStrength(password) {
    let strength = 0;
    
    if (password.length >= 8) strength += 20;
    if (password.length >= 12) strength += 10;
    if (/[A-Z]/.test(password)) strength += 20;
    if (/[a-z]/.test(password)) strength += 20;
    if (/[0-9]/.test(password)) strength += 20;
    if (/[^A-Za-z0-9]/.test(password)) strength += 10;
    
    return Math.min(strength, 100);
}

document.getElementById('password').addEventListener('input', function() {
    const password = this.value;
    const fill = document.getElementById('strength_fill');
    const text = document.getElementById('strength_text');
    
    if (password.length === 0) {
        fill.style.width = '0%';
        fill.className = 'strength-fill';
        text.textContent = 'Password strength';
        return;
    }
    
    const strength = checkPasswordStrength(password);
    
    if (strength < 40) {
        fill.style.width = '30%';
        fill.className = 'strength-fill weak';
        text.textContent = 'Weak password';
    } else if (strength < 70) {
        fill.style.width = '60%';
        fill.className = 'strength-fill medium';
        text.textContent = 'Medium password';
    } else {
        fill.style.width = '100%';
        fill.className = 'strength-fill strong';
        text.textContent = 'Strong password';
    }
});

document.getElementById('signupForm').addEventListener('submit', function(e) {
    document.querySelectorAll('.error-message').forEach(el => el.textContent = '');
    
    let isValid = true;
    
    const name = document.getElementById('first_name').value.trim();
    const email = document.getElementById('email').value.trim();
    const phone = document.getElementById('phone').value.trim();
    const password = document.getElementById('password').value;
    const confirmPassword = document.getElementById('confirm_password').value;
    const terms = document.getElementById('terms').checked;
    
    // Validate Name (FULL NAME - no lastName field)
    if (name === '') {
        document.getElementById('first_name_error').textContent = 'Name is required';
        isValid = false;
    } else if (name.length < 2) {
        document.getElementById('first_name_error').textContent = 'Name must be at least 2 characters';
        isValid = false;
    }
    
    // Validate Email
    const emailRegex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
    if (email === '') {
        document.getElementById('email_error').textContent = 'Email is required';
        isValid = false;
    } else if (!emailRegex.test(email)) {
        document.getElementById('email_error').textContent = 'Please enter a valid email';
        isValid = false;
    }
    
    // Validate Phone
    if (phone === '') {
        document.getElementById('phone_error').textContent = 'Phone number is required';
        isValid = false;
    } else if (phone.length < 8) {
        document.getElementById('phone_error').textContent = 'Please enter a valid phone number';
        isValid = false;
    }
    
    // Validate Password
    if (password === '') {
        document.getElementById('password_error').textContent = 'Password is required';
        isValid = false;
    } else if (password.length < 8) {
        document.getElementById('password_error').textContent = 'Password must be at least 8 characters';
        isValid = false;
    } else if (!/[A-Z]/.test(password)) {
        document.getElementById('password_error').textContent = 'Password must contain at least one uppercase letter';
        isValid = false;
    } else if (!/[0-9]/.test(password)) {
        document.getElementById('password_error').textContent = 'Password must contain at least one number';
        isValid = false;
    }
    
    // Validate Confirm Password
    if (confirmPassword === '') {
        document.getElementById('confirm_password_error').textContent = 'Please confirm your password';
        isValid = false;
    } else if (confirmPassword !== password) {
        document.getElementById('confirm_password_error').textContent = 'Passwords do not match';
        isValid = false;
    }
    
    // Validate Terms
    if (!terms) {
        alert('Please agree to the Terms of Service and Privacy Policy');
        isValid = false;
    }
    
    if (!isValid) {
        e.preventDefault();
    }
});

// Real-time validation on blur
document.getElementById('first_name').addEventListener('blur', function() {
    if (this.value.trim() === '') {
        document.getElementById('first_name_error').textContent = 'Name is required';
    } else {
        document.getElementById('first_name_error').textContent = '';
    }
});

document.getElementById('email').addEventListener('blur', function() {
    const emailRegex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
    if (this.value.trim() === '') {
        document.getElementById('email_error').textContent = 'Email is required';
    } else if (!emailRegex.test(this.value)) {
        document.getElementById('email_error').textContent = 'Please enter a valid email';
    } else {
        document.getElementById('email_error').textContent = '';
    }
});

document.getElementById('password').addEventListener('blur', function() {
    if (this.value.length > 0 && this.value.length < 8) {
        document.getElementById('password_error').textContent = 'Password must be at least 8 characters';
    } else {
        document.getElementById('password_error').textContent = '';
    }
});

document.getElementById('confirm_password').addEventListener('blur', function() {
    const password = document.getElementById('password').value;
    if (this.value !== password && this.value.length > 0) {
        document.getElementById('confirm_password_error').textContent = 'Passwords do not match';
    } else {
        document.getElementById('confirm_password_error').textContent = '';
    }
});


document.querySelector('.btn-social.google').addEventListener('click', function() {
    alert('Google login would open OAuth popup here');
});

document.querySelector('.btn-social.facebook').addEventListener('click', function() {
    alert('Facebook login would open OAuth popup here');
});


document.getElementById('phone').addEventListener('input', function(e) {
    this.value = this.value.replace(/[^0-9]/g, '');
});


document.getElementById('first_name').addEventListener('change', function() {
    this.value = this.value.charAt(0).toUpperCase() + this.value.slice(1).toLowerCase();
});