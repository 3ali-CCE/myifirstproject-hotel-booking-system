function calculatePrice() {
    var checkIn = new Date(document.getElementById('checkIn').value);
    var checkOut = new Date(document.getElementById('checkOut').value);
    
    if (checkIn && checkOut && checkOut > checkIn) {
        var nights = Math.ceil((checkOut - checkIn) / (1000 * 60 * 60 * 24));
        var total = nights * roomPrice;
        
        document.getElementById('nightsCount').textContent = nights + ' night' + (nights > 1 ? 's' : '');
        document.getElementById('totalPrice').textContent = '$' + total;
    } else {
        document.getElementById('nightsCount').textContent = '0 nights';
        document.getElementById('totalPrice').textContent = '$0';
    }
}
document.getElementById('checkIn').addEventListener('change', calculatePrice);
document.getElementById('checkOut').addEventListener('change', calculatePrice);
function validateBooking() {
    var checkIn = document.getElementById('checkIn').value;
    var checkOut = document.getElementById('checkOut').value;
    
    if (!checkIn || !checkOut) {
        alert('Please select check-in and check-out dates');
        return false;
    }
    
    if (new Date(checkOut) <= new Date(checkIn)) {
        alert('Check-out date must be after check-in date');
        return false;
    }
    
    return true;
}

document.addEventListener('DOMContentLoaded', function() {
    var today = new Date().toISOString().split('T')[0];
    document.getElementById('checkIn').setAttribute('min', today);
    document.getElementById('checkOut').setAttribute('min', today);
});

function changeImage(src) {
    document.getElementById('mainRoomImage').src = src;
    
    var thumbnails = document.querySelectorAll('.thumbnails img');
    thumbnails.forEach(function(img) {
        img.classList.remove('active');
        if (img.src === src) {
            img.classList.add('active');
        }
    });
}
document.querySelectorAll('input[name="payment_method"]').forEach(function (radio) {
    radio.addEventListener('change', function () {
        document.getElementById('card-details').style.display =
            this.value === 'card' ? 'block' : 'none';
    });
});

document.querySelector('#booking-form').addEventListener('submit', function (e) {
    var method = document.querySelector('input[name="payment_method"]:checked').value;

    if (method === 'card') {
        e.preventDefault();
        var form = e.target;
        var btn = form.querySelector('button[type="submit"]');
        btn.disabled = true;
        btn.innerHTML = '<i class="fas fa-spinner fa-spin"></i> Processing payment...';

        setTimeout(function () {
            form.submit();
        }, 1800);
    }
});