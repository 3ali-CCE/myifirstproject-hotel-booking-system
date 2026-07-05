document.addEventListener('DOMContentLoaded', function() {
    var searchInput = document.getElementById('searchInput');
    var cityFilter = document.getElementById('cityFilter');
    var sortFilter = document.getElementById('sortFilter');
    var rows = document.querySelectorAll('.hotel-row');
    
    if (searchInput) {
        searchInput.addEventListener('input', function() {
            var search = this.value.toLowerCase().trim();
            
            rows.forEach(function(row) {
                var name = row.getAttribute('data-name');
                var city = row.getAttribute('data-city');
                
                if (search === '' || name.includes(search) || city.includes(search)) {
                    row.style.display = '';
                } else {
                    row.style.display = 'none';
                }
            });
        });
    }
    
    if (cityFilter) {
        cityFilter.addEventListener('change', function() {
            var cityId = this.value;
            
            rows.forEach(function(row) {
                var city = row.getAttribute('data-city-id');
                
                if (cityId === '' || city === cityId) {
                    row.style.display = '';
                } else {
                    row.style.display = 'none';
                }
            });
        });
    }
    
    if (sortFilter) {
        sortFilter.addEventListener('change', function() {
            var sort = this.value;
            var sorted = Array.from(rows);
            var parent = rows[0].parentNode;
            
            sorted.sort(function(a, b) {
                var dateA = new Date(a.getAttribute('data-date'));
                var dateB = new Date(b.getAttribute('data-date'));
                
                if (sort === 'oldest') {
                    return dateA - dateB;
                } else {
                    return dateB - dateA;
                }
            });
            
            sorted.forEach(function(row) {
                parent.appendChild(row);
            });
        });
    }
});

function openEditModal(id, name, address, description, cityId, isActive) {
    document.getElementById('editHotelId').value = id;
    document.getElementById('editName').value = name;
    document.getElementById('editAddress').value = address;
    document.getElementById('editCity').value = cityId;
    document.getElementById('editStatus').value = isActive;
    
    document.getElementById('editForm').action = '/admin/hotels/' + id + '/update';
    document.getElementById('editModal').style.display = 'flex';
}


function confirmDelete(id, name) {
    document.getElementById('deleteHotelName').textContent = name;
    document.getElementById('deleteForm').action = '/admin/hotels/' + id + '/delete';
    document.getElementById('deleteModal').style.display = 'flex';
}

function closeModal(modalId) {
    document.getElementById(modalId).style.display = 'none';
}

window.onclick = function(event) {
    if (event.target.classList.contains('modal')) {
        event.target.style.display = 'none';
    }
};

document.addEventListener('keydown', function(event) {
    if (event.key === 'Escape') {
        document.querySelectorAll('.modal').forEach(function(modal) {
            modal.style.display = 'none';
        });
    }
});