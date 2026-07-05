var currentRoom = { id: 0, price: 0, capacity: 0 };

var isLoggedIn = false;

var descriptionsData = {
    'Suite': 'Experience ultimate luxury in our spacious suite with premium amenities.',
    'Deluxe': 'A spacious and elegantly designed room with modern amenities.',
    'Double': 'Perfect for couples with comfortable double bed.',
    'Single': 'Cozy room with all basic amenities.',
    'Twin': 'Room with two separate beds.',
    'Family': 'Spacious room for families with extra space.'
};

function openRoomDetails(id, type, price, capacity, image, roomNumber) {
    currentRoom = { id: id, price: price, capacity: capacity };
    
    document.getElementById('modalRoomType').textContent = type + ' Room';
    document.getElementById('modalRoomNumber').textContent = 'Room #' + roomNumber;
    document.getElementById('modalCapacity').textContent = capacity;
    document.getElementById('modalPrice').textContent = price;
    document.getElementById('mainImage').src = '/assets/images/rooms/' + image;
    document.getElementById('roomDescription').textContent = descriptionsData[type] || 'Comfortable room.';
    
    document.getElementById('detailsModal').style.display = 'flex';
}


function bookRoom(roomId) {
    currentRoom.id = roomId;
    var loginStatus = document.getElementById('loginCheck').getAttribute('data-logged');
    var isLoggedIn = (loginStatus === '1');
    
    if (isLoggedIn) {
        window.location.href = '/booking/' + roomId + '/create';
    } else {
        document.getElementById('loginModal').style.display = 'flex';
    }
}
function goToBooking() {
    closeModal('detailsModal');
    bookRoom(currentRoom.id);
}

function closeModal(modalId) {
    document.getElementById(modalId).style.display = 'none';
}

window.onclick = function(event) {
    if (event.target.classList.contains('modal')) {
        event.target.style.display = 'none';
    }
}

document.addEventListener('keydown', function(event) {
    if (event.key === 'Escape') {
        document.querySelectorAll('.modal').forEach(function(modal) {
            modal.style.display = 'none';
        });
    }
});


document.querySelectorAll('[data-modal]').forEach(function(link) {
    link.addEventListener('click', function(e) {
        e.preventDefault();
        var id = this.getAttribute('data-modal');
        document.getElementById('modal-' + id)?.classList.add('active');
    });
});

document.querySelectorAll('.quick-modal-overlay').forEach(function(overlay) {
    // close on X button
    overlay.querySelector('.quick-modal-close')?.addEventListener('click', function() {
        overlay.classList.remove('active');
    });

    overlay.addEventListener('click', function(e) {
        if (e.target === overlay) overlay.classList.remove('active');
    });
});

document.addEventListener('keydown', function(e) {
    if (e.key === 'Escape') {
        document.querySelectorAll('.quick-modal-overlay.active')
            .forEach(function(m) { m.classList.remove('active'); });
    }
});
