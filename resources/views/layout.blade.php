<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Book - Digital Library Management</title>
    
    <!-- Google Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap" rel="stylesheet">

    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">

    <!-- Local CSS -->
    <link rel="stylesheet" href="{{ asset('css/style.css') }}">
    <link rel="stylesheet" href="{{ asset('css/advanced.css') }}">
    
    <!-- Preload critical resources -->
    <link rel="preload" href="{{ asset('js/script.js') }}" as="script">
    
    <!-- Meta tags for SEO and social sharing -->
    <meta name="description" content="Digital Library Management System - Organize, discover, and explore your favorite books and categories">
    <meta name="keywords" content="digital library, books, categories, education, learning">
    <meta name="author" content="Digital Library Team">
    
    <!-- Open Graph tags -->
    <meta property="og:title" content="Digital Library Management">
    <meta property="og:description" content="Organize, discover, and explore your favorite books and categories">
    <meta property="og:type" content="website">
    <meta property="og:url" content="{{ url()->current() }}">
    
    <!-- Twitter Card tags -->
    <meta name="twitter:card" content="summary_large_image">
    <meta name="twitter:title" content="Digital Library Management">
    <meta name="twitter:description" content="Organize, discover, and explore your favorite books and categories">
    
    <!-- Favicon -->
    <link rel="icon" type="image/x-icon" href="{{ asset('favicon.ico') }}">
    
    <!-- Theme color for mobile browsers -->
    <meta name="theme-color" content="#3b82f6">
    
    <!-- PWA manifest -->
    <link rel="manifest" href="{{ asset('manifest.json') }}">
    
    <!-- Apple touch icon -->
    <link rel="apple-touch-icon" href="{{ asset('apple-touch-icon.png') }}">
    
    <!-- CSRF Token for AJAX requests -->
    <meta name="csrf-token" content="{{ csrf_token() }}">
</head>

<body>
   <!-- Navigation -->
    <nav class="navbar">
        <div class="nav-container">
            <a href="{{route('home')}}" class="nav-brand">
            <div class="nav-brand">
                <svg class="brand-icon" width="28" height="28" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                    <path d="M4 19.5A2.5 2.5 0 0 1 6.5 17H20"></path>
                    <path d="M6.5 2H20v20H6.5A2.5 2.5 0 0 1 4 19.5v-15A2.5 2.5 0 0 1 6.5 2z"></path>
                </svg>
                <span class="brand-text">Educational Library</span>
            </div>
            </a>
            <div class="nav-center">
                <!-- Search functionality removed -->
            </div>

            <div class="nav-actions">

                <div class="nav-links">
                    <a href="{{ route('home') }}" class="nav-link active">Home</a>
                    
                    @guest
                        <a href="{{ route('registerForm') }}" class="nav-link">Register</a>
                        <a href="{{ route('loginForm') }}" class="nav-link">Login</a>
                    @endguest

                    @auth
                        <form action="{{ url('logout') }}" method="post" class="logout-form">
                            @csrf
                            <button type="submit" class="btn btn-outline">Logout</button>
                        </form>
                    @endauth
                </div>

                <button class="mobile-menu-btn" onclick="toggleMobileMenu()" aria-label="Toggle mobile menu">
                    <svg width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                        <line x1="3" y1="6" x2="21" y2="6"></line>
                        <line x1="3" y1="12" x2="21" y2="12"></line>
                        <line x1="3" y1="18" x2="21" y2="18"></line>
                    </svg>
                </button>
            </div>
        </div>

        <!-- Mobile Menu -->
        <div class="mobile-menu" id="mobileMenu">
            <a href="{{ route('home') }}" class="mobile-link active">Home</a>

            @guest
                <a href="{{ route('registerForm') }}" class="mobile-link">Register</a>
                <a href="{{ route('loginForm') }}" class="mobile-link">Login</a>
            @endguest

            @auth
                <form action="{{ url('logout') }}" method="post">
                    @csrf
                    <button type="submit" class="btn btn-outline mobile-logout">Logout</button>
                </form>
            @endauth
        </div>
    </nav>
  
    @yield('content')

    <!-- Floating Action Button -->
    @auth
    <div class="fab-container">
        <button class="fab" id="fabButton" onclick="toggleFabMenu()" aria-label="Quick actions">
            <svg class="fab-icon" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                <line x1="12" y1="5" x2="12" y2="19"></line>
                <line x1="5" y1="12" x2="19" y2="12"></line>
            </svg>
        </button>
        <div class="fab-menu" id="fabMenu">
            <button class="fab-option" onclick="openAddBookModal()" data-tooltip="Add Book" aria-label="Add new book">
                <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                    <path d="M4 19.5A2.5 2.5 0 0 1 6.5 17H20"></path>
                    <path d="M6.5 2H20v20H6.5A2.5 2.5 0 0 1 4 19.5v-15A2.5 2.5 0 0 1 6.5 2z"></path>
                </svg>
            </button>
            <button class="fab-option" onclick="openAddCategoryModal()" data-tooltip="Add Category" aria-label="Add new category">
                <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                    <path d="M3 3h18v18H3zM21 9H3M21 15H3M12 3v18"/>
                </svg>
            </button>
            <button class="fab-option" onclick="openManageModal()" data-tooltip="Manage Library" aria-label="Manage library">
                <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                    <path d="M12 20h9"></path>
                    <path d="M16.5 3.5a2.121 2.121 0 0 1 3 3L7 19l-4 1 1-4L16.5 3.5z"></path>
                </svg>
            </button>
        </div>
    </div>
    @endauth

    <!-- Loading Overlay -->
    <div class="loading-overlay" id="loadingOverlay">
        <div class="loading-spinner">
            <div class="spinner"></div>
            <p>Loading...</p>
        </div>
    </div>

    <!-- Toast Container -->
    <div class="toast-container" id="toastContainer"></div>

    <!-- Scripts -->
    <script src="{{ asset('js/script.js') }}"></script>
    @yield('js')
    
    <!-- Service Worker Registration -->
    <script>
        if ('serviceWorker' in navigator) {
            window.addEventListener('load', () => {
                navigator.serviceWorker.register('/sw.js')
                    .then((registration) => {
                        console.log('SW registered: ', registration);
                    })
                    .catch((registrationError) => {
                        console.log('SW registration failed: ', registrationError);
                    });
            });
        }
    </script>
</body>
</html>
