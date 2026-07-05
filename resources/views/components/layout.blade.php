<!doctype html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <title></title>
  </head>

  <body>
    <x-navbar />

    {{ $slot }}

    <x-footer />

    <!-- Quick Link Modals -->
    @foreach([
        ['id' => 'about', 'title' => 'About Us', 'icon' => 'fa-hotel'],
        ['id' => 'services', 'title' => 'Our Services', 'icon' => 'fa-concierge-bell'],
        ['id' => 'destinations', 'title' => 'Destinations', 'icon' => 'fa-map-marker-alt'],
        ['id' => 'blog', 'title' => 'Blog', 'icon' => 'fa-newspaper'],
        ['id' => 'faq', 'title' => 'FAQ', 'icon' => 'fa-question-circle'],
    ] as $modal)
    <div class="quick-modal-overlay" id="modal-{{ $modal['id'] }}">
        <div class="quick-modal">
            <button class="quick-modal-close"><i class="fas fa-times"></i></button>
            <div class="quick-modal-icon">
                <i class="fas {{ $modal['icon'] }}"></i>
            </div>
            <h3>{{ $modal['title'] }}</h3>
            <p>This section is coming soon. Check back later for more information about our {{ strtolower($modal['title']) }}.</p>
        </div>
    </div>
    @endforeach

  </body>
</html>