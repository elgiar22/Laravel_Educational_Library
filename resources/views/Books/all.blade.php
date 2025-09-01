@extends('layout')

@section('title', 'All Books - Digital Library')

@section('content')
<div class="container" style="margin-top: 100px;">
    <!-- Header Section -->
    <div class="section-header">
        <h1 class="section-title">📚 All Books</h1>
        <p class="section-subtitle">Explore our complete collection of digital books</p>
    </div>

    <!-- Success Message -->
    @if (session()->has("success"))
        <div class="alert alert-success">
            <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                <path d="M9 12l2 2 4-4"></path>
                <path d="M21 12c-1 0-2-1-2-2s1-2 2-2 2 1 2 2-1 2-2 2z"></path>
                <path d="M3 12c1 0 2-1 2-2s-1-2-2-2-2 1-2 2 1 2 2 2z"></path>
                <path d="M12 3c0 1-1 2-2 2s-2 1-2 2 1 2 2 2 2 1 2 2 1-2 2-2 2-1 2-2-1-2-2-2-2-1-2-2z"></path>
            </svg>
            {{ session()->get("success") }}
        </div>
    @endif

    <!-- Create Book Button -->
@auth
        <div class="action-bar">
            <a href="{{ route('createBook') }}" class="btn btn-primary">
                <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                    <line x1="12" y1="5" x2="12" y2="19"></line>
                    <line x1="5" y1="12" x2="19" y2="12"></line>
                </svg>
                Add New Book
            </a>
        </div>
@endauth

    <!-- Books Grid -->
    <div class="books-grid">
        @forelse($books as $book)
            <div class="card book-card">
                <div class="card-image">
    @if($book->image)
                        <img src="{{ asset('storage/' . $book->image) }}" alt="{{ $book->title }}" loading="lazy">
                    @else
                        <div class="no-image">
                            <svg width="48" height="48" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                                <path d="M4 19.5A2.5 2.5 0 0 1 6.5 17H20"></path>
                                <path d="M6.5 2H20v20H6.5A2.5 2.5 0 0 1 4 19.5v-15A2.5 2.5 0 0 1 6.5 2z"></path>
                            </svg>
                        </div>
                    @endif
                    <div class="card-overlay">
                        <button class="overlay-btn" onclick="window.location.href='{{ route('showBook', $book->id) }}'">
                            <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                                <path d="M1 12s4-8 11-8 11 8 11 8-4 8-11 8-11-8-11-8z"></path>
                                <circle cx="12" cy="12" r="3"></circle>
                            </svg>
                            View
                        </button>
                        @auth
                            <button class="overlay-btn edit-btn" onclick="window.location.href='{{ route('editBook', $book->id) }}'">
                                <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                                    <path d="M11 4H4a2 2 0 0 0-2 2v14a2 2 0 0 0 2 2h14a2 2 0 0 0 2-2v-7"></path>
                                    <path d="M18.5 2.5a2.121 2.121 0 0 1 3 3L12 15l-4 1 1-4 9.5-9.5z"></path>
                                </svg>
                                Edit
                            </button>
                        @endauth
                    </div>
                </div>
                <div class="card-content">
                    <h3 class="card-title">{{ $book->title }}</h3>
                    <p class="card-description">{{ Str::limit($book->desc, 120) }}</p>
                    <div class="card-meta">
                        <span class="meta-item">
                            <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                                <path d="M16 21v-2a4 4 0 0 0-4-4H6a4 4 0 0 0-4 4v2"></path>
                                <circle cx="9" cy="7" r="4"></circle>
                            </svg>
                            {{ $book->user->name ?? 'Unknown Author' }}
                        </span>
                        <span class="category-stats">
                            {{ $book->category->name ?? 'Uncategorized' }}
                        </span>
                    </div>
                    <div class="card-footer">
                        <span class="book-date">{{ $book->created_at->format('M d, Y') }}</span>
                        @if($book->file_path)
                            <a href="{{ asset('storage/' . $book->file_path) }}" target="_blank" class="download-btn">
                                <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                                    <path d="M21 15v4a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2v-4"></path>
                                    <polyline points="7,10 12,15 17,10"></polyline>
                                    <line x1="12" y1="15" x2="12" y2="3"></line>
                                </svg>
                                Download PDF
                            </a>
                        @endif
                    </div>
                </div>
            </div>
        @empty
            <div class="no-results">
                <svg width="64" height="64" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                    <path d="M4 19.5A2.5 2.5 0 0 1 6.5 17H20"></path>
                    <path d="M6.5 2H20v20H6.5A2.5 2.5 0 0 1 4 19.5v-15A2.5 2.5 0 0 1 6.5 2z"></path>
                </svg>
                <h3>No Books Available</h3>
                <p>It looks like there are no books in the library yet.</p>
                @auth
                    <a href="{{ route('createBook') }}" class="btn btn-primary">Add Your First Book</a>
                @endauth
            </div>
        @endforelse
    </div>

    <!-- Pagination -->
    @if($books->hasPages())
        <div class="pagination-container">
            {{ $books->links() }}
        </div>
    @endif
</div>

<style>
.action-bar {
    display: flex;
    justify-content: center;
    margin-bottom: 32px;
}

.alert {
    display: flex;
    align-items: center;
    gap: 12px;
    padding: 16px 20px;
    border-radius: 12px;
    margin-bottom: 24px;
    font-weight: 500;
}

.alert-success {
    background: var(--success);
    color: white;
}

.books-grid {
    display: grid;
    grid-template-columns: repeat(auto-fill, minmax(320px, 1fr));
    gap: 32px;
    margin-bottom: 48px;
}

.book-card {
    background: var(--bg-primary);
    border: 1px solid var(--border-color);
    border-radius: 16px;
    overflow: hidden;
    box-shadow: var(--shadow-md);
    transition: all 0.3s ease;
    cursor: pointer;
    position: relative;
    animation: slideInUp 0.6s ease forwards;
    opacity: 0;
    transform: translateY(30px);
}

.book-card:hover {
    transform: translateY(-8px);
    box-shadow: var(--shadow-xl);
    border-color: var(--accent-primary);
}

.card-image {
    position: relative;
    height: 200px;
    overflow: hidden;
    background: var(--bg-secondary);
}

.card-image img {
    width: 100%;
    height: 100%;
    object-fit: cover;
    transition: transform 0.3s ease;
}

.book-card:hover .card-image img {
    transform: scale(1.05);
}

.no-image {
    display: flex;
    align-items: center;
    justify-content: center;
    height: 100%;
    color: var(--text-muted);
}

.card-overlay {
    position: absolute;
    top: 0;
    left: 0;
    right: 0;
    bottom: 0;
    background: rgba(0, 0, 0, 0.8);
    display: flex;
    align-items: center;
    justify-content: center;
    opacity: 0;
    transition: all 0.3s ease;
    gap: 12px;
}

.book-card:hover .card-overlay {
    opacity: 1;
}

.overlay-btn {
    background: white;
    color: var(--text-primary);
    border: none;
    padding: 12px 20px;
    border-radius: 8px;
    font-weight: 500;
    cursor: pointer;
    transition: all 0.2s ease;
    transform: translateY(8px);
    font-size: 0.875rem;
    display: flex;
    align-items: center;
    gap: 6px;
}

.book-card:hover .overlay-btn {
    transform: translateY(0);
}

.overlay-btn:hover {
    background: #f3f4f6;
    transform: translateY(-2px);
}

.overlay-btn.edit-btn {
    background: var(--accent-primary);
    color: white;
}

.overlay-btn.edit-btn:hover {
    background: var(--accent-secondary);
}

.card-content {
    padding: 24px;
}

.card-title {
    font-size: 1.25rem;
    font-weight: 600;
    color: var(--text-primary);
    margin-bottom: 8px;
    line-height: 1.3;
}

.card-description {
    color: var(--text-secondary);
    font-size: 0.95rem;
    line-height: 1.5;
    margin-bottom: 16px;
}

.card-meta {
    display: flex;
    align-items: center;
    justify-content: space-between;
    gap: 16px;
    margin-bottom: 16px;
}

.meta-item {
    display: flex;
    align-items: center;
    gap: 6px;
    color: var(--text-muted);
    font-size: 0.875rem;
}

.category-stats {
    background: var(--bg-secondary);
    color: var(--accent-primary);
    padding: 4px 12px;
    border-radius: 20px;
    font-size: 0.875rem;
    font-weight: 500;
}

.card-footer {
    display: flex;
    align-items: center;
    justify-content: space-between;
    gap: 16px;
    padding-top: 16px;
    border-top: 1px solid var(--border-color);
}

.book-date {
    color: var(--text-muted);
    font-size: 0.875rem;
}

.download-btn {
    display: flex;
    align-items: center;
    gap: 6px;
    color: var(--accent-primary);
    text-decoration: none;
    font-size: 0.875rem;
    font-weight: 500;
    padding: 6px 12px;
    border-radius: 6px;
    transition: all 0.2s ease;
}

.download-btn:hover {
    background: var(--bg-secondary);
    color: var(--accent-secondary);
}

.no-results {
    grid-column: 1 / -1;
    text-align: center;
    padding: 64px 24px;
    color: var(--text-secondary);
}

.no-results svg {
    margin-bottom: 16px;
    color: var(--text-muted);
}

.no-results h3 {
    font-size: 1.5rem;
    font-weight: 600;
    color: var(--text-primary);
    margin-bottom: 8px;
}

.no-results p {
    font-size: 1.125rem;
    margin-bottom: 24px;
}

.pagination-container {
    display: flex;
    justify-content: center;
    margin: 48px 0;
}

/* Pagination Styling */
.pagination {
    display: flex;
    align-items: center;
    gap: 8px;
    background: var(--bg-primary);
    padding: 8px;
    border-radius: 12px;
    box-shadow: var(--shadow-md);
    border: 1px solid var(--border-color);
}

.page-link {
    background: none;
    border: none;
    color: var(--text-secondary);
    cursor: pointer;
    padding: 12px 16px;
    border-radius: 8px;
    font-weight: 500;
    transition: all 0.2s ease;
    min-width: 44px;
    display: flex;
    align-items: center;
    justify-content: center;
    text-decoration: none;
}

.page-link:hover {
    background: var(--bg-secondary);
    color: var(--text-primary);
}

.page-item.active .page-link {
    background: var(--accent-primary);
    color: white;
}

.page-item.disabled .page-link {
    opacity: 0.5;
    cursor: not-allowed;
}

.page-item.disabled .page-link:hover {
    background: none;
    transform: none;
}

/* Responsive Design */
@media (max-width: 1024px) {
    .books-grid {
        grid-template-columns: repeat(auto-fill, minmax(280px, 1fr));
        gap: 24px;
    }
}

@media (max-width: 768px) {
    .books-grid {
        grid-template-columns: 1fr;
        gap: 20px;
    }
    
    .card-content {
        padding: 20px;
    }
    
    .card-meta {
        flex-direction: column;
        align-items: flex-start;
        gap: 12px;
    }
    
    .card-footer {
        flex-direction: column;
        align-items: flex-start;
        gap: 12px;
    }
    
    .pagination {
        gap: 4px;
        padding: 4px;
    }
    
    .page-link {
        padding: 8px 12px;
        min-width: 36px;
    }
}

@media (max-width: 480px) {
    .section-title {
        font-size: 2rem;
    }
    
    .card-content {
        padding: 16px;
    }
    
    .overlay-btn {
        padding: 10px 16px;
        font-size: 0.8rem;
    }
}

/* Animations */
@keyframes slideInUp {
    from {
        opacity: 0;
        transform: translateY(30px);
    }
    to {
        opacity: 1;
        transform: translateY(0);
    }
}

/* Stagger animation for cards */
.book-card:nth-child(1) { animation-delay: 0.1s; }
.book-card:nth-child(2) { animation-delay: 0.2s; }
.book-card:nth-child(3) { animation-delay: 0.3s; }
.book-card:nth-child(4) { animation-delay: 0.4s; }
.book-card:nth-child(5) { animation-delay: 0.5s; }
.book-card:nth-child(6) { animation-delay: 0.6s; }
</style>

<script>
// Add smooth animations when page loads
document.addEventListener('DOMContentLoaded', function() {
    // Animate cards with intersection observer
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

    // Observe all book cards
    const bookCards = document.querySelectorAll('.book-card');
    bookCards.forEach(card => {
        observer.observe(card);
    });
});

// Add loading state for download buttons
document.querySelectorAll('.download-btn').forEach(btn => {
    btn.addEventListener('click', function() {
        const originalText = this.innerHTML;
        this.innerHTML = `
            <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" class="animate-spin">
                <circle cx="12" cy="12" r="10"></circle>
                <path d="M12 6v6l4 2"></path>
            </svg>
            Downloading...
        `;
        
        setTimeout(() => {
            this.innerHTML = originalText;
        }, 2000);
    });
});

// Add hover effects for better interactivity
document.querySelectorAll('.book-card').forEach(card => {
    card.addEventListener('mouseenter', function() {
        this.style.transform = 'translateY(-8px) scale(1.02)';
    });
    
    card.addEventListener('mouseleave', function() {
        this.style.transform = 'translateY(0) scale(1)';
    });
});
</script>
@endsection
