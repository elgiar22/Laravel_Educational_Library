@extends('layout')

@section('title', 'My Books - Digital Library')

@section('content')
<div class="container" style="margin-top: 100px;">
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

    <!-- Page Header -->
    <div class="page-header">
        <div class="header-content">
            <div class="header-info">
                <h1 class="page-title">
                    <svg width="32" height="32" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                        <path d="M4 19.5A2.5 2.5 0 0 1 6.5 17H20"></path>
                        <path d="M6.5 2H20v20H6.5A2.5 2.5 0 0 1 4 19.5v-15A2.5 2.5 0 0 1 6.5 2z"></path>
                    </svg>
                    My Books
                </h1>
                <p class="page-subtitle">Manage and organize your published books</p>
            </div>
            
            @auth
                @if(Auth::user()->canCreateBooks())
                    <div class="header-actions">
                        <a href="{{ route('createBook') }}" class="btn btn-primary">
                            <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                                <line x1="12" y1="5" x2="12" y2="19"></line>
                                <line x1="5" y1="12" x2="19" y2="12"></line>
                            </svg>
                            Add New Book
                        </a>
                    </div>
                @endif
            @endauth
        </div>
    </div>

    <!-- User Welcome Section -->
    @if($books->count() > 0)
        <div class="user-welcome">
            <div class="welcome-content">
                <div class="user-avatar">
                    <svg width="48" height="48" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                        <path d="M16 21v-2a4 4 0 0 0-4-4H6a4 4 0 0 0-4 4v2"></path>
                        <circle cx="9" cy="7" r="4"></circle>
                    </svg>
                </div>
                <div class="welcome-text">
                    <h3>Welcome back, {{ Auth::user()->name }}!</h3>
                    <p>You have published {{ $books->count() }} {{ $books->count() == 1 ? 'book' : 'books' }} in your library.</p>
                </div>
            </div>
        </div>
    @endif

    <!-- Books Section -->
    <div class="books-section">
        @if($books->count() > 0)
            <div class="books-grid">
                @foreach($books as $book)
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
                                <button class="overlay-btn view-btn" onclick="window.location.href='{{ route('showBook', $book->id) }}'">
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
                                        <path d="M3 3h18v18H3zM21 9H3M21 15H3M12 3v18"/>
                                    </svg>
                                    {{ $book->category->name ?? 'Uncategorized' }}
                                </span>
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
                                <div class="card-actions">
                                    @if(Auth::user()->canEditBook($book))
                                        <a href="{{ route('editBook', $book->id) }}" class="action-btn edit-btn">
                                            <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                                                <path d="M11 4H4a2 2 0 0 0-2 2v14a2 2 0 0 0 2 2h14a2 2 0 0 0 2-2v-7"></path>
                                                <path d="M18.5 2.5a2.121 2.121 0 0 1 3 3L12 15l-4 1 1-4 9.5-9.5z"></path>
                                            </svg>
                                            Edit
                                        </a>
                                    @endif
                                    @if(Auth::user()->canDeleteBook($book))
                                        <form action="{{ route('deleteBook', $book->id) }}" method="post" class="delete-form" onsubmit="return confirm('Are you sure you want to delete this book? This action cannot be undone.')">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="action-btn delete-btn">
                                                <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                                                    <polyline points="3,6 5,6 21,6"></polyline>
                                                    <path d="M19,6v14a2,2,0,0,1-2,2H7a2,2,0,0,1-2-2V6m3,0V4a2,2,0,0,1,2-2h4a2,2,0,0,1,2,2V6"></path>
                                                </svg>
                                                Delete
                                            </button>
                                        </form>
                                    @endif
                                </div>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        @else
            <div class="no-books">
                <div class="no-books-icon">
                    <svg width="64" height="64" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                        <path d="M4 19.5A2.5 2.5 0 0 1 6.5 17H20"></path>
                        <path d="M6.5 2H20v20H6.5A2.5 2.5 0 0 1 4 19.5v-15A2.5 2.5 0 0 1 6.5 2z"></path>
                    </svg>
                </div>
                <h3>No books published yet</h3>
                <p>Start your journey as an author by publishing your first book!</p>
                @auth
                    @if(Auth::user()->canCreateBooks())
                        <a href="{{ route('createBook') }}" class="btn btn-primary">
                            <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                                <line x1="12" y1="5" x2="12" y2="19"></line>
                                <line x1="5" y1="12" x2="19" y2="12"></line>
                            </svg>
                            Publish Your First Book
                        </a>
                    @endif
                @endauth
            </div>
        @endif
    </div>
</div>

<style>
.page-header {
    background: var(--bg-primary);
    border-radius: 16px;
    box-shadow: var(--shadow-lg);
    border: 1px solid var(--border-color);
    margin-bottom: 32px;
    overflow: hidden;
}

.header-content {
    display: flex;
    justify-content: space-between;
    align-items: center;
    padding: 32px;
}

.header-info {
    display: flex;
    flex-direction: column;
    gap: 8px;
}

.page-title {
    display: flex;
    align-items: center;
    gap: 12px;
    font-size: 2.5rem;
    font-weight: 700;
    color: var(--text-primary);
    margin: 0;
}

.page-title svg {
    color: var(--accent-primary);
}

.page-subtitle {
    color: var(--text-secondary);
    font-size: 1.1rem;
    margin: 0;
}

.header-actions {
    display: flex;
    gap: 16px;
}

.user-welcome {
    background: linear-gradient(135deg, var(--accent-primary), var(--accent-secondary));
    border-radius: 16px;
    padding: 24px;
    margin-bottom: 32px;
    color: white;
}

.welcome-content {
    display: flex;
    align-items: center;
    gap: 20px;
}

.user-avatar {
    background: rgba(255, 255, 255, 0.2);
    border-radius: 50%;
    width: 80px;
    height: 80px;
    display: flex;
    align-items: center;
    justify-content: center;
}

.welcome-text h3 {
    margin: 0 0 8px 0;
    font-size: 1.5rem;
    font-weight: 600;
}

.welcome-text p {
    margin: 0;
    opacity: 0.9;
    font-size: 1rem;
}

.books-section {
    margin-top: 32px;
}

.books-grid {
    display: grid;
    grid-template-columns: repeat(auto-fill, minmax(300px, 1fr));
    gap: 24px;
    margin-bottom: 32px;
}

.book-card {
    position: relative;
    overflow: hidden;
    transition: all 0.3s ease;
    border: 1px solid var(--border-color);
    background: var(--bg-primary);
}

.book-card:hover {
    transform: translateY(-8px);
    box-shadow: var(--shadow-xl);
}

.card-image {
    position: relative;
    height: 200px;
    overflow: hidden;
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

.book-placeholder {
    width: 100%;
    height: 100%;
    background: var(--bg-secondary);
    display: flex;
    align-items: center;
    justify-content: center;
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
    gap: 12px;
    opacity: 0;
    transition: opacity 0.3s ease;
}

.book-card:hover .card-overlay {
    opacity: 1;
}

.overlay-btn {
    background: var(--accent-primary);
    color: white;
    border: none;
    padding: 10px 20px;
    border-radius: 8px;
    font-size: 0.9rem;
    font-weight: 500;
    cursor: pointer;
    transition: all 0.2s ease;
    display: flex;
    align-items: center;
    gap: 8px;
    box-shadow: 0 4px 12px rgba(0, 0, 0, 0.3);
}

.overlay-btn:hover {
    background: var(--accent-secondary);
    transform: translateY(-2px);
    box-shadow: 0 6px 16px rgba(0, 0, 0, 0.4);
}

.card-content {
    padding: 20px;
}

.card-title {
    font-size: 1.25rem;
    font-weight: 600;
    color: var(--text-primary);
    margin: 0 0 12px 0;
    line-height: 1.3;
}

.card-description {
    color: var(--text-secondary);
    font-size: 0.95rem;
    line-height: 1.5;
    margin: 0 0 16px 0;
}

.card-meta {
    display: flex;
    flex-direction: column;
    gap: 8px;
    margin-bottom: 16px;
}

.meta-item {
    display: flex;
    align-items: center;
    gap: 8px;
    color: var(--text-secondary);
    font-size: 0.9rem;
}

.meta-item svg {
    color: var(--text-muted);
}

.card-footer {
    display: flex;
    justify-content: space-between;
    align-items: center;
    padding-top: 16px;
    border-top: 1px solid var(--border-color);
}

.date-added {
    display: flex;
    align-items: center;
    gap: 6px;
    color: var(--text-muted);
    font-size: 0.85rem;
}

.card-actions {
    display: flex;
    gap: 8px;
    flex-wrap: wrap;
    justify-content: flex-end;
}

.action-btn {
    display: flex;
    align-items: center;
    gap: 6px;
    padding: 8px 16px;
    border-radius: 8px;
    font-size: 0.85rem;
    font-weight: 500;
    text-decoration: none;
    transition: all 0.2s ease;
    border: none;
    cursor: pointer;
    box-shadow: 0 2px 8px rgba(0, 0, 0, 0.1);
}

.action-btn.edit-btn {
    background: var(--warning);
    color: white;
}

.action-btn.edit-btn:hover {
    background: #d97706;
    transform: translateY(-1px);
}

.action-btn.delete-btn {
    background: var(--danger);
    color: white;
}

.action-btn.delete-btn:hover {
    background: #dc2626;
    transform: translateY(-1px);
}

.delete-form {
    margin: 0;
}

.no-books {
    text-align: center;
    padding: 48px 24px;
    background: var(--bg-primary);
    border-radius: 16px;
    border: 1px solid var(--border-color);
}

.no-books-icon {
    margin-bottom: 24px;
    opacity: 0.5;
}

.no-books h3 {
    color: var(--text-primary);
    margin-bottom: 12px;
    font-size: 1.5rem;
}

.no-books p {
    color: var(--text-secondary);
    margin-bottom: 24px;
    font-size: 1.1rem;
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

@media (max-width: 768px) {
    .header-content {
        flex-direction: column;
        gap: 20px;
        text-align: center;
    }
    
    .page-title {
        font-size: 2rem;
    }
    
    .welcome-content {
        flex-direction: column;
        text-align: center;
    }
    
    .user-avatar {
        width: 60px;
        height: 60px;
    }
    
    .books-grid {
        grid-template-columns: 1fr;
    }
    
    .card-footer {
        flex-direction: column;
        gap: 12px;
        align-items: flex-start;
    }
    
    .card-actions {
        width: 100%;
        justify-content: flex-end;
    }
}

@media (max-width: 480px) {
    .header-content {
        padding: 24px;
    }
    
    .page-title {
        font-size: 1.75rem;
    }
    
    .user-welcome {
        padding: 20px;
    }
    
    .welcome-text h3 {
        font-size: 1.25rem;
    }
}
</style>

<script>
// Add smooth animations
document.addEventListener('DOMContentLoaded', function() {
    const pageHeader = document.querySelector('.page-header');
    pageHeader.style.opacity = '0';
    pageHeader.style.transform = 'translateY(20px)';
    
    setTimeout(() => {
        pageHeader.style.transition = 'all 0.6s ease';
        pageHeader.style.opacity = '1';
        pageHeader.style.transform = 'translateY(0)';
    }, 100);

    // Animate books grid
    const bookCards = document.querySelectorAll('.book-card');
    bookCards.forEach((card, index) => {
        card.style.opacity = '0';
        card.style.transform = 'translateY(30px)';
        
        setTimeout(() => {
            card.style.transition = 'all 0.6s ease';
            card.style.opacity = '1';
            card.style.transform = 'translateY(0)';
        }, 200 + (index * 100));
    });

    // Animate user welcome if exists
    const userWelcome = document.querySelector('.user-welcome');
    if (userWelcome) {
        userWelcome.style.opacity = '0';
        userWelcome.style.transform = 'translateY(20px)';
        
        setTimeout(() => {
            userWelcome.style.transition = 'all 0.6s ease';
            userWelcome.style.opacity = '1';
            userWelcome.style.transform = 'translateY(0)';
        }, 300);
    }
});
</script>
@endsection
