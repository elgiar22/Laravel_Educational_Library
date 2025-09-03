@extends('layout')

@section('title', 'Digital Library Management - Home')

@section('css')
<link rel="stylesheet" href="{{ asset('css/style.css') }}">
@endsection

@section('content')
    <!-- Hero Section -->
    <section class="hero">
        <div class="container">
            <div class="hero-content">
                <h1 class="hero-title">Welcome to Your Digital Library</h1>
                <p class="hero-subtitle">Discover, organize, and explore your favorite books and categories all in one place. Access thousands of educational resources at your fingertips.</p>
                <div class="hero-actions">
                    <button class="btn btn-primary" onclick="scrollToSection('books')">
                        <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                            <path d="M4 19.5A2.5 2.5 0 0 1 6.5 17H20"></path>
                            <path d="M6.5 2H20v20H6.5A2.5 2.5 0 0 1 4 19.5v-15A2.5 2.5 0 0 1 6.5 2z"></path>
                        </svg>
                        Browse Books
                    </button>
                    <button class="btn btn-secondary" onclick="scrollToSection('categories')">
                        <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                            <path d="M3 3h18v18H3zM21 9H3M21 15H3M12 3v18"/>
                        </svg>
                        Explore Categories
                    </button>
                </div>
            </div>
            <div class="hero-image">
                <div class="floating-books">
                    <div class="book book-1"></div>
                    <div class="book book-2"></div>
                    <div class="book book-3"></div>
                </div>
            </div>
        </div>
    </section>

    <!-- Books Section -->
    <section id="books" class="section">
        <div class="container">
            <div class="section-header">
                <h2 class="section-title">📚 Featured Books</h2>
                <p class="section-subtitle">Discover our handpicked selection of amazing books</p>
            </div>
            
            <div class="books-grid" id="booksGrid">
                @forelse($books as $book)
                    <div class="card book-card">
                        <div class="card-image">
                            @if($book->image)
                                <img src="{{ asset('storage/' . $book->image) }}" alt="{{ $book->title }}" loading="lazy">
                            @else
                                <div class="book-placeholder">
                                    <svg width="48" height="48" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                                        <path d="M4 19.5A2.5 2.5 0 0 1 6.5 17H20"></path>
                                        <path d="M6.5 2H20v20H6.5A2.5 2.5 0 0 1 4 19.5v-15A2.5 2.5 0 0 1 6.5 2z"></path>
                                    </svg>
                                </div>
                            @endif
                            <div class="card-overlay">
                                <button class="btn btn-primary" onclick="window.location.href='{{ route('showBook', $book->id) }}'">
                                    <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                                        <path d="M1 12s4-8 11-8 11 8 11 8-4 8-11 8-11-8-11-8z"></path>
                                        <circle cx="12" cy="12" r="3"></circle>
                                    </svg>
                                    View
                                </button>
                            
                            </div>
                        </div>
                        <div class="card-content">
                            <h3 class="card-title">{{ $book->title }}</h3>
                            <p class="card-description">{{ Str::limit($book->desc ?? 'No description available', 100) }}</p>
                            <div class="card-meta">
                                <span class="meta-item">
                                    <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                                        <path d="M16 21v-2a4 4 0 0 0-4-4H6a4 4 0 0 0-4 4v2"></path>
                                        <circle cx="9" cy="7" r="4"></circle>
                                    </svg>
                                    {{ $book->user->name ?? 'Unknown Author' }}
                                </span>
                                @if($book->category)
                                    <span class="category-badge">
                                        <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                                            <path d="M3 3h18v18H3zM21 9H3M21 15H3M12 3v18"/>
                                        </svg>
                                        {{ $book->category->name }}
                                    </span>
                                @endif
                            </div>
                            <div class="card-footer">
                                <span class="date-added">
                                    <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                                        <rect x="3" y="4" width="18" height="18" rx="2" ry="2"></rect>
                                        <line x1="16" y1="2" x2="16" y2="6"></line>
                                        <line x1="8" y1="2" x2="8" y2="6"></line>
                                        <line x1="3" y1="10" x2="21" y2="10"></line>
                                    </svg>
                                    {{ $book->created_at->format('M d, Y') }}
                                </span>

                            </div>
                        </div>
                    </div>
                @empty
                    <div class="no-results">
                        <div class="no-results-icon">
                            <svg width="64" height="64" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                                <path d="M4 19.5A2.5 2.5 0 0 1 6.5 17H20"></path>
                                <path d="M6.5 2H20v20H6.5A2.5 2.5 0 0 1 4 19.5v-15A2.5 2.5 0 0 1 6.5 2z"></path>
                            </svg>
                        </div>
                        <h3>No books available yet</h3>
                        <p>Be the first to add a book to our digital library!</p>
                        @auth
                            @if(Auth::user()->canCreateBooks())
                                <a href="{{ route('createBook') }}" class="btn btn-primary">
                                    <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                                        <line x1="12" y1="5" x2="12" y2="19"></line>
                                        <line x1="5" y1="12" x2="19" y2="12"></line>
                                    </svg>
                                    Add First Book
                                </a>
                            @endif
                        @endauth
                    </div>
                @endforelse
            </div>

            <div class="section-footer">
                <a class="btn btn-outline-primary" href="{{ route('allBooks') }}">
                    <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                        <path d="M4 19.5A2.5 2.5 0 0 1 6.5 17H20"></path>
                        <path d="M6.5 2H20v20H6.5A2.5 2.5 0 0 1 4 19.5v-15A2.5 2.5 0 0 1 6.5 2z"></path>
                    </svg>
                    Show All Books
                </a>
            </div>
        </div>
    </section>

    <!-- Categories Section -->
    <section id="categories" class="section section-alt">
        <div class="container">
            <div class="section-header">
                <h2 class="section-title">📂 Book Categories</h2>
                <p class="section-subtitle">Find books organized by your favorite topics and subjects</p>
            </div>
            
            <div class="categories-grid" id="categoriesGrid">
                @forelse($categories as $category)
                    <div class="card category-card">
                        <div class="card-image">
                            @if($category->image)
                                <img src="{{ asset('storage/' . $category->image) }}" alt="{{ $category->name }}" loading="lazy">
                            @else
                                <div class="category-placeholder">
                                    <svg width="48" height="48" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                                        <path d="M3 3h18v18H3zM21 9H3M21 15H3M12 3v18"/>
                                    </svg>
                                </div>
                            @endif
                            <div class="card-overlay">
                                <button class="btn btn-primary" onclick="window.location.href='{{ route('showCategory', $category->id) }}'">
                                    <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                                        <path d="M1 12s4-8 11-8 11 8 11 8-4 8-11 8-11-8-11-8z"></path>
                                        <circle cx="12" cy="12" r="3"></circle>
                                    </svg>
                                    Browse
                                </button>

                            </div>
                        </div>
                        <div class="card-content">
                            <h3 class="card-title">{{ $category->name }}</h3>
                            <p class="card-description">{{ Str::limit($category->desc ?? 'No description available', 100) }}</p>
                            <div class="card-meta">
                                <span class="category-stats">
                                    <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                                        <path d="M4 19.5A2.5 2.5 0 0 1 6.5 17H20"></path>
                                        <path d="M6.5 2H20v20H6.5A2.5 2.5 0 0 1 4 19.5v-15A2.5 2.5 0 0 1 6.5 2z"></path>
                                    </svg>
                                    {{ $category->books_count ?? 0 }} Books
                                </span>
                            </div>
                        </div>
                    </div>
                @empty
                    <div class="no-results">
                        <div class="no-results-icon">
                            <svg width="64" height="64" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                                <path d="M3 3h18v18H3zM21 9H3M21 15H3M12 3v18"/>
                            </svg>
                        </div>
                        <h3>No categories available yet</h3>
                        @auth
                            @if(Auth::user()->canManageCategories())
                                <a href="{{ route('createCategory') }}" class="btn btn-primary">
                                    <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                                        <line x1="12" y1="5" x2="12" y2="19"></line>
                                        <line x1="5" y1="12" x2="19" y2="12"></line>
                                    </svg>
                                    Create First Category
                                </a>

                            @endif
                        @endauth
                    </div>
                @endforelse
            </div>

            <div class="section-footer">
                <a class="btn btn-outline-primary" href="{{ route('allCategories') }}">
                    <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                        <path d="M3 3h18v18H3zM21 9H3M21 15H3M12 3v18"/>
                    </svg>
                    Show All Categories
                </a>
            </div>
        </div>
    </section>

    <!-- Stats Section -->
    <section class="stats-section">
        <div class="container">
            <div class="section-header">
                <h2 class="section-title" style="color: white; margin-bottom: 16px;">Library Statistics</h2>
                <p class="section-subtitle" style="color: #9ca3af; margin-bottom: 48px;">Discover the scope of our digital library</p>
            </div>
            <div class="stats-grid">
                <div class="stat-card">
                    <div class="stat-icon">
                        <svg width="32" height="32" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                            <path d="M4 19.5A2.5 2.5 0 0 1 6.5 17H20"></path>
                            <path d="M6.5 2H20v20H6.5A2.5 2.5 0 0 1 4 19.5v-15A2.5 2.5 0 0 1 6.5 2z"></path>
                        </svg>
                    </div>
                    <h3 class="stat-number" data-target="{{ $books->count() }}">{{ $books->count() }}</h3>
                    <p class="stat-label">Total Books</p>
                </div>
                <div class="stat-card" data-aos="zoom-in" data-aos-delay="200">
                    <div class="stat-icon">
                        <svg width="32" height="32" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                            <path d="M3 3h18v18H3zM21 9H3M21 15H3M12 9v6M7 9v6"></path>
                        </svg>
                    </div>
                    <h3 class="stat-number" data-target="{{ $categories->count() }}">{{ $categories->count() }}</h3>
                    <p class="stat-label">Categories</p>
                </div>
                <div class="stat-card" data-aos="zoom-in" data-aos-delay="300">
                    <div class="stat-icon">
                        <svg width="32" height="32" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                            <path d="M16 21v-2a4 4 0 0 0-4-4H6a4 4 0 0 0-4 4v2"></path>
                            <circle cx="9" cy="7" r="4"></circle>
                        </svg>
                    </div>
                    <h3 class="stat-number" data-target="{{ $authorCount }}">{{ $authorCount }}</h3>
                    <p class="stat-label">Authors</p>
                </div>
            </div>
        </div>
    </section>

    <!-- Call to Action Section -->
    <section class="section">
        <div class="container">
            <div class="section-header">
                <h2 class="section-title">Ready to Start Reading?</h2>
                <p class="section-subtitle">Join thousands of readers who have already discovered amazing books in our digital library</p>
            </div>
            <div class="section-footer">
                <a class="btn btn-primary" href="{{ route('allBooks') }}">
                    <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                        <path d="M4 19.5A2.5 2.5 0 0 1 6.5 17H20"></path>
                        <path d="M6.5 2H20v20H6.5A2.5 2.5 0 0 1 4 19.5v-15A2.5 2.5 0 0 1 6.5 2z"></path>
                    </svg>
                    Start Reading Now
                </a>
                @guest
                    <a class="btn btn-secondary" href="{{ route('registerForm') }}">
                        <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                            <path d="M16 21v-2a4 4 0 0 0-4-4H6a4 4 0 0 0-4 4v2"></path>
                            <circle cx="9" cy="7" r="4"></circle>
                        </svg>
                        Create Account
                    </a>
                @endguest
            </div>
        </div>
    </section>

    <!-- Loading Overlay -->
    <div class="loading-overlay" id="loadingOverlay">
        <div class="loading-spinner">
            <div class="spinner"></div>
            <p>Loading...</p>
        </div>
    </div>

    <!-- Toast Container -->
    <div class="toast-container" id="toastContainer"></div>

<style>


/* Enhanced Card Styles */
.book-card,
.category-card {
    position: relative;
    overflow: hidden;
    transition: all 0.3s ease;
    border: 1px solid var(--border-color);
}

.book-card:hover,
.category-card:hover {
    transform: translateY(-8px);
    box-shadow: var(--shadow-xl);
}

.book-placeholder,
.category-placeholder {
    width: 100%;
    height: 200px;
    background: var(--bg-secondary);
    display: flex;
    align-items: center;
    justify-content: center;
    color: var(--text-muted);
    border-radius: 12px 12px 0 0;
}

.book-placeholder svg,
.category-placeholder svg {
    opacity: 0.5;
}

.category-badge {
    display: inline-flex;
    align-items: center;
    gap: 4px;
    background: var(--bg-tertiary);
    color: var(--accent-primary);
    padding: 4px 8px;
    border-radius: 12px;
    font-size: 0.75rem;
    font-weight: 500;
}

.card-footer {
    display: flex;
    justify-content: space-between;
    align-items: center;
    margin-top: 16px;
    padding-top: 16px;
    border-top: 1px solid var(--border-color);
}

.date-added {
    display: flex;
    align-items: center;
    gap: 6px;
    color: var(--text-muted);
    font-size: 0.875rem;
}

.download-link {
    display: flex;
    align-items: center;
    gap: 6px;
    color: var(--accent-primary);
    text-decoration: none;
    font-size: 0.875rem;
    font-weight: 500;
    padding: 6px 12px;
    background: var(--bg-secondary);
    border-radius: 8px;
    transition: all 0.2s ease;
}

.download-link:hover {
    background: var(--accent-primary);
    color: white;
    transform: scale(1.05);
}

/* No Results Styles */
.no-results {
    text-align: center;
    padding: 48px 24px;
    grid-column: 1 / -1;
}

.no-results-icon {
    margin-bottom: 24px;
    opacity: 0.5;
}

.no-results h3 {
    color: var(--text-primary);
    margin-bottom: 12px;
    font-size: 1.5rem;
}

.no-results p {
    color: var(--text-secondary);
    margin-bottom: 24px;
    font-size: 1.1rem;
}

/* Enhanced Stats Section */
.stats-section {
    background: linear-gradient(135deg, var(--accent-primary) 0%, var(--accent-secondary) 100%);
    padding: 80px 0;
    position: relative;
    overflow: hidden;
}

.stats-section::before {
    content: '';
    position: absolute;
    top: 0;
    left: 0;
    right: 0;
    bottom: 0;
    background: url('data:image/svg+xml,<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 100 100"><defs><pattern id="grain" width="100" height="100" patternUnits="userSpaceOnUse"><circle cx="50" cy="50" r="1" fill="rgba(255,255,255,0.1)"/></pattern></defs><rect width="100" height="100" fill="url(%23grain)"/></svg>');
    opacity: 0.3;
}

.stats-grid {
    position: relative;
    z-index: 1;
}

.stat-card {
    background: rgba(255, 255, 255, 0.1);
    backdrop-filter: blur(10px);
    border: 1px solid rgba(255, 255, 255, 0.2);
    border-radius: 16px;
    padding: 32px 24px;
    text-align: center;
    transition: all 0.3s ease;
}

.stat-card:hover {
    transform: translateY(-8px);
    background: rgba(255, 255, 255, 0.15);
}

.stat-icon {
    margin-bottom: 16px;
    color: rgba(255, 255, 255, 0.9);
}

.stat-number {
    font-size: 3rem;
    font-weight: 700;
    color: white;
    margin-bottom: 8px;
    text-shadow: 0 2px 4px rgba(0, 0, 0, 0.3);
}

.stat-label {
    color: rgba(255, 255, 255, 0.9);
    font-size: 1.1rem;
    font-weight: 500;
}

/* Responsive Design */
@media (max-width: 768px) {
    .search-container {
        flex-direction: column;
        gap: 12px;
    }
    
    .search-btn {
        width: 100%;
        justify-content: center;
    }
    
    .stats-grid {
        grid-template-columns: 1fr;
        gap: 24px;
    }
    
    .stat-number {
        font-size: 2.5rem;
    }
}

@media (max-width: 480px) {
    .hero-title {
        font-size: 2rem;
    }
    
    .hero-subtitle {
        font-size: 1rem;
    }
    
    .hero-actions {
        flex-direction: column;
        gap: 12px;
    }
    
    .hero-actions .btn {
        width: 100%;
        justify-content: center;
    }
}
</style>

<script>
// Enhanced home page functionality
document.addEventListener('DOMContentLoaded', function() {
    // Initialize smooth scrolling for anchor links
    document.querySelectorAll('a[href^="#"]').forEach(anchor => {
        anchor.addEventListener('click', function (e) {
            e.preventDefault();
            const target = document.querySelector(this.getAttribute('href'));
            if (target) {
                target.scrollIntoView({
                    behavior: 'smooth',
                    block: 'start'
                });
            }
        });
    });

    // Add scroll-triggered animations
    const observerOptions = {
        threshold: 0.1,
        rootMargin: '0px 0px -50px 0px'
    };

    const observer = new IntersectionObserver((entries) => {
        entries.forEach(entry => {
            if (entry.isIntersecting) {
                entry.target.style.opacity = '1';
                entry.target.style.transform = 'translateY(0)';
            }
        });
    }, observerOptions);

    // Observe all cards for animation
    document.querySelectorAll('.card').forEach(card => {
        card.style.opacity = '0';
        card.style.transform = 'translateY(30px)';
        card.style.transition = 'opacity 0.6s ease, transform 0.6s ease';
        observer.observe(card);
    });

    // Animate stats when they come into view
    const statNumbers = document.querySelectorAll('.stat-number');
    statNumbers.forEach(stat => {
        const target = parseInt(stat.getAttribute('data-target'));
        if (target > 0) {
            animateCounter(stat, target);
        }
    });

});



function animateCounter(element, target) {
    let current = 0;
    const increment = target / 60;
    const timer = setInterval(() => {
        current += increment;
        if (current >= target) {
            current = target;
            clearInterval(timer);
        }
        element.textContent = Math.floor(current);
    }, 16);
}

function scrollToSection(sectionId) {
    const section = document.getElementById(sectionId);
    if (section) {
        section.scrollIntoView({ 
            behavior: 'smooth',
            block: 'start'
        });
    }
}


</script>
@endsection
