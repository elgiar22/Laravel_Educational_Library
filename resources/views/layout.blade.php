<!DOCTYPE html>
<html lang="en" data-theme="light">
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

<body data-theme="light">
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
                <form action="{{ route('search') }}" method="GET" class="navbar-search">
                    <input type="text" name="q" placeholder="Search books..." value="{{ request('q') }}">
                    <button type="submit">🔍</button>
                </form>
            </div>

<style>
/* Simple Navbar Search */
.nav-center {
    flex: 1;
    max-width: 350px;
    margin: 0 20px;
}

.navbar-search {
    display: flex;
    align-items: center;
    width: 100%;
    background: var(--bg-primary);
    border: 2px solid var(--border-color);
    border-radius: 25px;
    overflow: hidden;
    transition: all 0.3s ease;
    box-shadow: var(--shadow-sm);
}

.navbar-search:hover {
    border-color: var(--accent-primary);
    box-shadow: var(--shadow-md);
}

.navbar-search:focus-within {
    border-color: var(--accent-primary);
    box-shadow: 0 0 0 3px rgba(59, 130, 246, 0.1);
    transform: translateY(-1px);
}

.navbar-search input {
    flex: 1;
    padding: 10px 16px;
    border: none;
    outline: none;
    background: transparent;
    color: var(--text-primary);
    font-size: 14px;
}

.navbar-search input::placeholder {
    color: var(--text-muted);
}

.navbar-search input:focus::placeholder {
    color: var(--text-secondary);
}

.navbar-search button {
    padding: 10px 12px;
    border: none;
    background: var(--accent-primary);
    color: white;
    cursor: pointer;
    font-size: 16px;
    transition: all 0.3s ease;
    display: flex;
    align-items: center;
    justify-content: center;
}

.navbar-search button:hover {
    background: var(--accent-secondary);
    transform: scale(1.05);
}

/* Enhanced Dark Toggle Button - Login Style */
.dark-toggle {
    padding: 8px 15px;
    border-radius: 20px;
    border: none;
    background: #4a74f5;
    color: #fff;
    cursor: pointer;
    transition: all 0.3s ease;
    font-size: 14px;
    font-weight: bold;
    display: flex;
    align-items: center;
    gap: 5px;
    margin-left: 10px;
}

.dark-toggle:hover {
    background: #3456c5;
    transform: scale(1.05);
}

/* Nav Links Enhancement */
.nav-links {
    display: flex;
    align-items: center;
    gap: 20px;
}

.nav-link {
    color: var(--text-primary);
    text-decoration: none;
    font-weight: 500;
    padding: 8px 16px;
    border-radius: 8px;
    transition: all 0.3s ease;
    position: relative;
}

.nav-link:hover {
    color: var(--accent-primary);
    background: rgba(59, 130, 246, 0.1);
    transform: translateY(-1px);
}

.nav-link.active {
    color: var(--accent-primary);
    background: rgba(59, 130, 246, 0.15);
}

/* Mobile Menu Enhancement */
.mobile-menu .mobile-link {
    display: block;
    padding: 12px 20px;
    color: var(--text-primary);
    text-decoration: none;
    border-bottom: 1px solid var(--border-color);
    transition: all 0.3s ease;
}

.mobile-menu .mobile-link:hover {
    background: rgba(59, 130, 246, 0.1);
    color: var(--accent-primary);
}

/* Dark mode styles for the toggle button */
body.dark .dark-toggle {
    background: #ffbb33;
    color: #333;
}

body.dark .dark-toggle:hover {
    background: #ffaa00;
}

/* Dark mode general styles */
body.dark {
    background: #1e1e2f;
    color: #ddd;
}

/* Hide on mobile */
@media (max-width: 768px) {
    .nav-center {
        display: none;
    }
    
    .dark-toggle {
        font-size: 12px;
        padding: 6px 10px;
    }
}

/* Tablet */
@media (max-width: 1024px) {
    .nav-center {
        max-width: 280px;
    }
    
    .navbar-search input {
        font-size: 13px;
    }
    
    .navbar-search button {
        font-size: 14px;
        padding: 8px 10px;
    }
}

/* Remove the old toggle styles */
.toggle-icon, .toggle-text {
    display: none;
}
</style>

            <div class="nav-actions">

                <div class="nav-links">
                    <a href="{{ route('home') }}" class="nav-link active">Home</a>
                    
                    @guest
                        <a href="{{ route('registerForm') }}" class="nav-link">Register</a>
                        <a href="{{ route('loginForm') }}" class="nav-link">Login</a>
                    @endguest

                    @auth
                        @if(Auth::user()->isAdmin())
                            <a href="{{ route('dashboard') }}" class="nav-link">Dashboard</a>
                        @elseif(Auth::user()->canCreateBooks())
                            <a href="{{ route('mybooks') }}" class="nav-link">My Books</a>
                        @endif
                        <form action="{{ url('logout') }}" method="post" class="logout-form">
                            @csrf
                            <button type="submit" class="btn btn-outline">Logout</button>
                        </form>
                    @endauth
                </div>

                <button class="dark-toggle" id="darkToggle" aria-label="Toggle dark mode">
                    🌙 Dark
                </button>

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
                @if(Auth::user()->isAdmin())
                    <a href="{{ route('dashboard') }}" class="mobile-link">Dashboard</a>
                @elseif(Auth::user()->canCreateBooks())
                    <a href="{{ route('mybooks') }}" class="mobile-link">My Books</a>
                @endif
                <form action="{{ url('logout') }}" method="post">
                    @csrf
                    <button type="submit" class="btn btn-outline mobile-logout">Logout</button>
                </form>
            @endauth
        </div>
    </nav>
  
    @yield('content')



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
    
    <script>
document.addEventListener('DOMContentLoaded', function() {
    const body = document.body;
    const darkToggle = document.getElementById('darkToggle');

    // Check localStorage on page load
    if (localStorage.getItem("theme") === "dark") {
        body.classList.add("dark");
        body.setAttribute("data-theme", "dark");
        document.documentElement.setAttribute("data-theme", "dark");
        darkToggle.textContent = "☀ Light";
    } else {
        body.classList.remove("dark");
        body.setAttribute("data-theme", "light");
        document.documentElement.setAttribute("data-theme", "light");
        darkToggle.textContent = "🌙 Dark";
    }

    // Toggle theme on button click
    if (darkToggle) {
        darkToggle.addEventListener('click', () => {
            body.classList.toggle('dark');
            
            if (body.classList.contains('dark')) {
                localStorage.setItem("theme", "dark");
                body.setAttribute("data-theme", "dark");
                document.documentElement.setAttribute("data-theme", "dark");
                darkToggle.textContent = "☀ Light";
            } else {
                localStorage.setItem("theme", "light");
                body.setAttribute("data-theme", "light");
                document.documentElement.setAttribute("data-theme", "light");
                darkToggle.textContent = "🌙 Dark";
            }
        });
    }
});
</script>

</body>
</html>