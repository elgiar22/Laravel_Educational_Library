@extends('layout')

@section('title', $book->title . ' - Digital Library')

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
        <a href="{{ route('allBooks') }}" class="breadcrumb-link">
            <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                <polyline points="15,18 9,12 15,6"></polyline>
            </svg>
            All Books
        </a>
        <span class="breadcrumb-separator">/</span>
        <span class="breadcrumb-current">{{ $book->title }}</span>
    </nav>

    <!-- Book Details Section -->
    <div class="book-details-container">
        <div class="book-header">
            <div class="book-cover-section">
                @if($book->image)
                    <img src="{{ asset('storage/' . $book->image) }}" alt="{{ $book->title }}" class="book-cover">
                @else
                    <div class="book-cover-placeholder">
                        <svg width="64" height="64" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                            <path d="M4 19.5A2.5 2.5 0 0 1 6.5 17H20"></path>
                            <path d="M6.5 2H20v20H6.5A2.5 2.5 0 0 1 4 19.5v-15A2.5 2.5 0 0 1 6.5 2z"></path>
                        </svg>
                    </div>
                @endif
                
                @if($book->file_path)
                    <div class="book-actions">
                        <a href="{{ asset('storage/' . $book->file_path) }}" target="_blank" class="btn btn-primary download-btn">
                            <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                                <path d="M21 15v4a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2v-4"></path>
                                <polyline points="7,10 12,15 17,10"></polyline>
                                <line x1="12" y1="15" x2="12" y2="3"></line>
                            </svg>
                            Download PDF
                        </a>
                        <a href="{{ asset('storage/' . $book->file_path) }}" target="_blank" class="btn btn-outline-primary">
                            <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                                <path d="M1 12s4-8 11-8 11 8 11 8-4 8-11 8-11-8-11-8z"></path>
                                <circle cx="12" cy="12" r="3"></circle>
                            </svg>
                            Read Online
                        </a>
                    </div>
                @endif
            </div>

            <div class="book-info">
                <h1 class="book-title">{{ $book->title }}</h1>
                
                @if($book->category)
                    <div class="book-category">
                        <span class="category-badge">
                            <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                                <path d="M3 3h18v18H3zM21 9H3M21 15H3M12 3v18"/>
                            </svg>
                            <a href="{{ route('showCategory', $book->category->id) }}">{{ $book->category->name }}</a>
                        </span>
                    </div>
                @endif

                <div class="book-meta">
                    <div class="meta-item">
                        <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                            <path d="M16 21v-2a4 4 0 0 0-4-4H6a4 4 0 0 0-4 4v2"></path>
                            <circle cx="9" cy="7" r="4"></circle>
                        </svg>
                        <span>Added by: {{ $book->user->name ?? 'Unknown' }}</span>
                    </div>
                    <div class="meta-item">
                        <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                            <rect x="3" y="4" width="18" height="18" rx="2" ry="2"></rect>
                            <line x1="16" y1="2" x2="16" y2="6"></line>
                            <line x1="8" y1="2" x2="8" y2="6"></line>
                            <line x1="3" y1="10" x2="21" y2="10"></line>
                        </svg>
                        <span>Added: {{ $book->created_at->format('M d, Y') }}</span>
                    </div>
                    @if($book->file_path)
                        <div class="meta-item">
                            <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                                <path d="M14 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V8z"></path>
                                <polyline points="14,2 14,8 20,8"></polyline>
                            </svg>
                            <span>PDF Available</span>
                        </div>
                    @endif
                </div>

                <div class="book-description">
                    <h3>Description</h3>
                    <p>{{ $book->desc }}</p>
                </div>

                @auth
                    <div class="book-admin-actions">
                        <a href="{{ route('editBook', $book->id) }}" class="btn btn-outline-primary">
                            <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                                <path d="M11 4H4a2 2 0 0 0-2 2v14a2 2 0 0 0 2 2h14a2 2 0 0 0 2-2v-7"></path>
                                <path d="M18.5 2.5a2.121 2.121 0 0 1 3 3L12 15l-4 1 1-4 9.5-9.5z"></path>
                            </svg>
                            Edit Book
                        </a>
                        
                        <form action="{{ route('deleteBook', $book->id) }}" method="post" class="delete-form" onsubmit="return confirm('Are you sure you want to delete this book?')">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger">
                                <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                                    <polyline points="3,6 5,6 21,6"></polyline>
                                    <path d="M19,6v14a2,2,0,0,1-2,2H7a2,2,0,0,1-2-2V6m3,0V4a2,2,0,0,1,2-2h4a2,2,0,0,1,2,2V6"></path>
                                </svg>
                                Delete Book
                            </button>
                        </form>
                    </div>
                @endauth
            </div>
        </div>
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

.book-details-container {
    background: var(--bg-primary);
    border-radius: 16px;
    box-shadow: var(--shadow-lg);
    border: 1px solid var(--border-color);
    overflow: hidden;
}

.book-header {
    display: grid;
    grid-template-columns: 300px 1fr;
    gap: 32px;
    padding: 32px;
}

.book-cover-section {
    display: flex;
    flex-direction: column;
    gap: 24px;
}

.book-cover {
    width: 100%;
    height: 400px;
    object-fit: cover;
    border-radius: 12px;
    box-shadow: var(--shadow-md);
}

.book-cover-placeholder {
    width: 100%;
    height: 400px;
    background: var(--bg-secondary);
    border: 2px dashed var(--border-color);
    border-radius: 12px;
    display: flex;
    align-items: center;
    justify-content: center;
    color: var(--text-muted);
}

.book-actions {
    display: flex;
    flex-direction: column;
    gap: 12px;
}

.download-btn {
    display: flex;
    align-items: center;
    justify-content: center;
    gap: 8px;
    width: 100%;
}

.book-info {
    display: flex;
    flex-direction: column;
    gap: 24px;
}

.book-title {
    font-size: 2.5rem;
    font-weight: 700;
    color: var(--text-primary);
    line-height: 1.2;
    margin: 0;
}

.book-category {
    margin-bottom: 16px;
}

.category-badge {
    display: inline-flex;
    align-items: center;
    gap: 8px;
    background: var(--bg-secondary);
    color: var(--accent-primary);
    padding: 8px 16px;
    border-radius: 20px;
    font-weight: 500;
    text-decoration: none;
    transition: all 0.2s ease;
}

.category-badge:hover {
    background: var(--accent-primary);
    color: white;
    transform: translateY(-2px);
}

.book-meta {
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

.book-description h3 {
    font-size: 1.25rem;
    font-weight: 600;
    color: var(--text-primary);
    margin-bottom: 12px;
}

.book-description p {
    color: var(--text-secondary);
    line-height: 1.6;
    font-size: 1rem;
}

.book-admin-actions {
    display: flex;
    gap: 16px;
    padding-top: 24px;
    border-top: 1px solid var(--border-color);
}

.delete-form {
    margin: 0;
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
    .book-header {
        grid-template-columns: 1fr;
        gap: 24px;
    }
    
    .book-cover-section {
        align-items: center;
    }
    
    .book-cover,
    .book-cover-placeholder {
        max-width: 300px;
        height: 350px;
    }
}

@media (max-width: 768px) {
    .book-header {
        padding: 24px;
    }
    
    .book-title {
        font-size: 2rem;
    }
    
    .book-admin-actions {
        flex-direction: column;
    }
    
    .book-cover,
    .book-cover-placeholder {
        max-width: 250px;
        height: 300px;
    }
}

@media (max-width: 480px) {
    .book-header {
        padding: 20px;
    }
    
    .book-title {
        font-size: 1.75rem;
    }
    
    .book-cover,
    .book-cover-placeholder {
        max-width: 200px;
        height: 250px;
    }
}
</style>

<script>
// Add smooth animations
document.addEventListener('DOMContentLoaded', function() {
    const bookDetails = document.querySelector('.book-details-container');
    bookDetails.style.opacity = '0';
    bookDetails.style.transform = 'translateY(20px)';
    
    setTimeout(() => {
        bookDetails.style.transition = 'all 0.6s ease';
        bookDetails.style.opacity = '1';
        bookDetails.style.transform = 'translateY(0)';
    }, 100);
});

// Add download tracking
document.querySelectorAll('.download-btn').forEach(btn => {
    btn.addEventListener('click', function() {
        const originalText = this.innerHTML;
        this.innerHTML = `
            <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" class="animate-spin">
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
</script>
@endsection