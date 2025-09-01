@extends('layout')

@section('title', $category->name . ' - Digital Library')

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

    <!-- Navigation Breadcrumb -->
    <nav class="breadcrumb-nav">
        <a href="{{ route('allCategories') }}" class="breadcrumb-link">
            <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                <polyline points="15,18 9,12 15,6"></polyline>
            </svg>
            All Categories
        </a>
        <span class="breadcrumb-separator">/</span>
        <span class="breadcrumb-current">{{ $category->name }}</span>
    </nav>

    <!-- Category Details Section -->
    <div class="category-details-container">
        <div class="category-header">
            <div class="category-image-section">
                @if($category->image)
                    <img src="{{ asset('storage/' . $category->image) }}" alt="{{ $category->name }}" class="category-image">
                @else
                    <div class="category-image-placeholder">
                        <svg width="64" height="64" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                            <path d="M3 3h18v18H3zM21 9H3M21 15H3M12 3v18"/>
                        </svg>
                    </div>
                @endif
            </div>

            <div class="category-info">
                <h1 class="category-title">{{ $category->name }}</h1>
                
                <div class="category-meta">
                    <div class="meta-item">
                        <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                            <path d="M4 19.5A2.5 2.5 0 0 1 6.5 17H20"></path>
                            <path d="M6.5 2H20v20H6.5A2.5 2.5 0 0 1 4 19.5v-15A2.5 2.5 0 0 1 6.5 2z"></path>
                        </svg>
                        <span>{{ $category->books->count() }} Books</span>
                    </div>
                    <div class="meta-item">
                        <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                            <rect x="3" y="4" width="18" height="18" rx="2" ry="2"></rect>
                            <line x1="16" y1="2" x2="16" y2="6"></line>
                            <line x1="8" y1="2" x2="8" y2="6"></line>
                            <line x1="3" y1="10" x2="21" y2="10"></line>
                        </svg>
                        <span>Created: {{ $category->created_at->format('M d, Y') }}</span>
                    </div>
                </div>

                <div class="category-description">
                    <h3>Description</h3>
                    <p>{{ $category->desc ?? 'No description available for this category.' }}</p>
                </div>

                @auth
                    <div class="category-admin-actions">
                        <a href="{{ route('editCategory', $category->id) }}" class="btn btn-outline-primary">
                            <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                                <path d="M11 4H4a2 2 0 0 0-2 2v14a2 2 0 0 0 2 2h14a2 2 0 0 0 2-2v-7"></path>
                                <path d="M18.5 2.5a2.121 2.121 0 0 1 3 3L12 15l-4 1 1-4 9.5-9.5z"></path>
                            </svg>
                            Edit Category
                        </a>
                        
                        <form action="{{ route('deleteCategory', $category->id) }}" method="post" class="delete-form" onsubmit="return confirm('Are you sure you want to delete this category? This will also delete all books in this category.')">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger">
                                <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                                    <polyline points="3,6 5,6 21,6"></polyline>
                                    <path d="M19,6v14a2,2,0,0,1-2,2H7a2,2,0,0,1-2-2V6m3,0V4a2,2,0,0,1,2-2h4a2,2,0,0,1,2,2V6"></path>
                                </svg>
                                Delete Category
                            </button>
                        </form>
                    </div>
                @endauth
            </div>
        </div>
    </div>

    <!-- Books Section -->
    <div class="books-section">
        <div class="section-header">
            <h2 class="section-title">📚 Books in {{ $category->name }}</h2>
            <p class="section-subtitle">Discover all the books available in this category</p>
        </div>

        @if($category->books->count() > 0)
            <div class="books-grid">
                @foreach ($category->books as $book)
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
                            <p class="card-description">{{ Str::limit($book->desc ?? 'No description available', 100) }}</p>
                            <div class="card-meta">
                                <span class="meta-item">
                                    <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                                        <path d="M16 21v-2a4 4 0 0 0-4-4H6a4 4 0 0 0-4 4v2"></path>
                                        <circle cx="9" cy="7" r="4"></circle>
                                    </svg>
                                    {{ $book->user->name ?? 'Unknown Author' }}
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
                                @if($book->file_path)
                                    <a href="{{ asset('storage/' . $book->file_path) }}" target="_blank" class="download-link">
                                        <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                                            <path d="M21 15v4a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2v-4"></path>
                                            <polyline points="7,10 12,15 17,10"></polyline>
                                            <line x1="12" y1="15" x2="12" y2="3"></line>
                                        </svg>
                                        PDF
                                    </a>
                                @endif
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
                <h3>No books in this category yet</h3>
                <p>This category is empty. Be the first to add a book!</p>
                @auth
                    <a href="{{ route('createBook') }}" class="btn btn-primary">
                        <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                            <line x1="12" y1="5" x2="12" y2="19"></line>
                            <line x1="5" y1="12" x2="19" y2="12"></line>
                        </svg>
                        Add First Book
                    </a>
                @else
                    <a href="{{ route('loginForm') }}" class="btn btn-primary">Login to Add Books</a>
                @endauth
            </div>
        @endif
    </div>
</div>

<style>
.breadcrumb-nav {
    display: flex;
    align-items: center;
    gap: 12px;
    margin-bottom: 32px;
    padding: 16px 0;
    border-bottom: 1px solid var(--border-color);
}

.breadcrumb-link {
    display: flex;
    align-items: center;
    gap: 6px;
    color: var(--accent-primary);
    text-decoration: none;
    font-weight: 500;
    transition: color 0.2s ease;
}

.breadcrumb-link:hover {
    color: var(--accent-secondary);
}

.breadcrumb-separator {
    color: var(--text-muted);
}

.breadcrumb-current {
    color: var(--text-primary);
    font-weight: 600;
}

.category-details-container {
    background: var(--bg-primary);
    border-radius: 16px;
    box-shadow: var(--shadow-lg);
    border: 1px solid var(--border-color);
    overflow: hidden;
    margin-bottom: 32px;
}

.category-header {
    display: grid;
    grid-template-columns: 300px 1fr;
    gap: 32px;
    padding: 32px;
}

.category-image-section {
    display: flex;
    flex-direction: column;
    gap: 24px;
}

.category-image {
    width: 100%;
    height: 300px;
    object-fit: cover;
    border-radius: 12px;
    box-shadow: var(--shadow-md);
}

.category-image-placeholder {
    width: 100%;
    height: 300px;
    background: var(--bg-secondary);
    border: 2px dashed var(--border-color);
    border-radius: 12px;
    display: flex;
    align-items: center;
    justify-content: center;
    color: var(--text-muted);
}

.category-info {
    display: flex;
    flex-direction: column;
    gap: 24px;
}

.category-title {
    font-size: 2.5rem;
    font-weight: 700;
    color: var(--text-primary);
    line-height: 1.2;
    margin: 0;
}

.category-meta {
    display: flex;
    flex-direction: column;
    gap: 12px;
}

.meta-item {
    display: flex;
    align-items: center;
    gap: 8px;
    color: var(--text-secondary);
    font-size: 0.95rem;
}

.meta-item svg {
    color: var(--text-muted);
}

.category-description h3 {
    font-size: 1.25rem;
    font-weight: 600;
    color: var(--text-primary);
    margin-bottom: 12px;
}

.category-description p {
    color: var(--text-secondary);
    line-height: 1.6;
    font-size: 1rem;
}

.category-admin-actions {
    display: flex;
    gap: 16px;
    padding-top: 24px;
    border-top: 1px solid var(--border-color);
}

.delete-form {
    margin: 0;
}

.books-section {
    margin-top: 32px;
}

.section-header {
    text-align: center;
    margin-bottom: 32px;
}

.section-title {
    font-size: 2rem;
    font-weight: 700;
    color: var(--text-primary);
    margin-bottom: 12px;
}

.section-subtitle {
    color: var(--text-secondary);
    font-size: 1.1rem;
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
}

.book-card:hover {
    transform: translateY(-8px);
    box-shadow: var(--shadow-xl);
}

.book-placeholder {
    width: 100%;
    height: 200px;
    background: var(--bg-secondary);
    display: flex;
    align-items: center;
    justify-content: center;
    color: var(--text-muted);
    border-radius: 12px 12px 0 0;
}

.book-placeholder svg {
    opacity: 0.5;
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

@media (max-width: 1024px) {
    .category-header {
        grid-template-columns: 1fr;
        gap: 24px;
    }
    
    .category-image-section {
        align-items: center;
    }
    
    .category-image,
    .category-image-placeholder {
        max-width: 300px;
        height: 250px;
    }
}

@media (max-width: 768px) {
    .category-header {
        padding: 24px;
    }
    
    .category-title {
        font-size: 2rem;
    }
    
    .category-admin-actions {
        flex-direction: column;
    }
    
    .books-grid {
        grid-template-columns: 1fr;
    }
    
    .category-image,
    .category-image-placeholder {
        max-width: 250px;
        height: 200px;
    }
}

@media (max-width: 480px) {
    .category-header {
        padding: 20px;
    }
    
    .category-title {
        font-size: 1.75rem;
    }
    
    .category-image,
    .category-image-placeholder {
        max-width: 200px;
        height: 150px;
    }
}
</style>

<script>
// Add smooth animations
document.addEventListener('DOMContentLoaded', function() {
    const categoryDetails = document.querySelector('.category-details-container');
    categoryDetails.style.opacity = '0';
    categoryDetails.style.transform = 'translateY(20px)';
    
    setTimeout(() => {
        categoryDetails.style.transition = 'all 0.6s ease';
        categoryDetails.style.opacity = '1';
        categoryDetails.style.transform = 'translateY(0)';
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
});
</script>
@endsection