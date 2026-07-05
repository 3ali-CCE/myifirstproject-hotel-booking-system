document.addEventListener('DOMContentLoaded', function () {

    window.addEventListener('load', function () {
        var loader = document.getElementById('loader');
        if (loader) loader.classList.add('hidden');
    });

    var scrollTopBtn = document.getElementById('scrollTop');
    if (scrollTopBtn) {
        window.addEventListener('scroll', function () {
            scrollTopBtn.classList.toggle('active', window.scrollY > 300);
        });

        scrollTopBtn.addEventListener('click', function (e) {
            e.preventDefault();
            window.scrollTo({ top: 0, behavior: 'smooth' });
        });
    }

    var input = document.querySelector('.search-input-wrapper input');
    var searchBtn = document.querySelector('.btn-search');
    var tagBtns = document.querySelectorAll('.tag-btn');

    function filterCities(query) {
        var search = query.toLowerCase().trim();
        var cols = document.querySelectorAll('.cities-section .col-lg-4');

        cols.forEach(function (col) {
            var name = col.getAttribute('data-name') || '';
            var country = col.getAttribute('data-country') || '';

            if (search === '' || name.includes(search) || country.includes(search)) {
                col.style.display = '';
            } else {
                col.style.display = 'none';
            }
        });
    }

    if (searchBtn) {
        searchBtn.addEventListener('click', function (e) {
            e.preventDefault();
            filterCities(input.value.trim());
            document.querySelector('.cities-section')
                ?.scrollIntoView({ behavior: 'smooth', block: 'start' });
        });
    }

    if (input) {
        input.addEventListener('keydown', function (e) {
            if (e.key === 'Enter') searchBtn.click();
        });
    }

    tagBtns.forEach(function (btn) {
        btn.addEventListener('click', function () {
            input.value = btn.textContent.trim();
            filterCities(input.value);
            document.querySelector('.cities-section')
                ?.scrollIntoView({ behavior: 'smooth', block: 'start' });
        });
    });

document.querySelectorAll('[data-modal]').forEach(function(link) {
    link.addEventListener('click', function(e) {
        e.preventDefault();
        var id = this.getAttribute('data-modal');
        document.getElementById('modal-' + id)?.classList.add('active');
    });
});

document.querySelectorAll('.quick-modal-overlay').forEach(function(overlay) {
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
});