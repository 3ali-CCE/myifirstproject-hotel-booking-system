document.addEventListener('DOMContentLoaded', function() {
    var searchInput = document.querySelector('.search-input');
    var roleFilter = document.querySelector('select[name="role"]');
    var sortFilter = document.querySelector('select[name="sort"]');
    var tableBody = document.querySelector('.users-table tbody');
    var rows = tableBody.querySelectorAll('tr');
    
    function searchUsers() {
        var search = searchInput.value.toLowerCase().trim();
        
        rows.forEach(function(row) {
            var name = row.getAttribute('data-name');
            var email = row.getAttribute('data-email');
            
            if (search === '' || name.includes(search) || email.includes(search)) {
                row.style.display = '';
            } else {
                row.style.display = 'none';
            }
        });
        
        updateCount();
    }
    
    function filterByRole() {
        var role = roleFilter.value;
        
        rows.forEach(function(row) {
            var rowRole = row.getAttribute('data-role');
            
            if (role === '' || rowRole === role) {
                row.style.display = '';
            } else {
                row.style.display = 'none';
            }
        });
        
        updateCount();
    }
    
    function sortByDate() {
        var sort = sortFilter.value;
        var tbody = tableBody;
        var sortedRows = Array.from(rows);
        
        sortedRows.sort(function(a, b) {
            var dateA = new Date(a.getAttribute('data-date'));
            var dateB = new Date(b.getAttribute('data-date'));
            
            return sort === 'oldest' ? dateA - dateB : dateB - dateA;
        });
        
        sortedRows.forEach(function(row) {
            tbody.appendChild(row);
        });
    }
    
    function updateCount() {
        var visible = 0;
        rows.forEach(function(row) {
            if (row.style.display !== 'none') {
                visible++;
            }
        });
        
        var info = document.querySelector('.pagination-info');
        if (info) {
            info.innerHTML = 'Showing <strong>' + visible + '</strong> of <strong>' + rows.length + '</strong> users';
        }
    }
    
    if (searchInput) {
        searchInput.addEventListener('input', searchUsers);
    }
    
    if (roleFilter) {
        roleFilter.addEventListener('change', filterByRole);
    }
    
    if (sortFilter) {
        sortFilter.addEventListener('change', sortByDate);
    }
});

function openEditModal(id, name, email, phone, role) {
    document.getElementById('editUserId').value = id;
    document.getElementById('editName').value = name;
    document.getElementById('editEmail').value = email;
    document.getElementById('editPhone').value = phone;
    document.getElementById('editRole').value = role;
    
    document.getElementById('editForm').action = '/admin/users/' + id + '/update';
    document.getElementById('editModal').style.display = 'flex';
}

function confirmDelete(id, name) {
    document.getElementById('deleteUserName').textContent = name;
    document.getElementById('deleteForm').action = '/admin/users/' + id + '/delete';
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