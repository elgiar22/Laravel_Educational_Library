@extends('layout')

@section('title', 'All Categories - Digital Library')

@section('content')
<div class="container" style="margin-top: 100px;">
    <!-- Header Section -->
    <div class="section-header">
        <h1 class="section-title">📂 All Book Categories</h1>
        <p class="section-subtitle">Explore all categories available in the library</p>
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

    <!-- Action Bar -->
    <div class="action-bar">
        @auth
            @if(Auth::user()->canManageCategories())
                <a href="{{ route('createCategory') }}" class="btn btn-primary">
                    <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                        <line x1="12" y1="5" x2="12" y2="19"></line>
                        <line x1="5" y1="12" x2="19" y2="12"></line>
                    </svg>
                    Create New Category
                </a>
            @endif
        @endauth
    </div>

    <!-- Categories Grid -->
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
                        <button class="overlay-btn browse-btn" onclick="window.location.href='{{ route('showCategory', $category->id) }}'">
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
                    <div class="card-footer">
                        <span class="date-added">
                            <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                                <rect x="3" y="4" width="18" height="18" rx="2" ry="2"></rect>
                                <line x1="16" y1="2" x2="16" y2="6"></line>
                                <line x1="8" y1="2" x2="8" y2="6"></line>
                                <line x1="3" y1="10" x2="21" y2="10"></line>
                            </svg>
                            {{ $category->created_at->format('M d, Y') }}
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

    <!-- Pagination -->
    @if($categories->hasPages())
        <div class="pagination-container">
            {{ $categories->links() }}
        </div>
    @endif
</div>

<style>
.section-header {
    text-align: center;
    margin-bottom: 32px;
}

.section-title {
    font-size: 2.5rem;
    font-weight: 700;
    color: var(--text-primary);
    margin-bottom: 12px;
}

.section-subtitle {
    color: var(--text-secondary);
    font-size: 1.1rem;
}

.action-bar {
    display: flex;
    justify-content: center;
    margin-bottom: 32px;
}

.action-bar .btn {
    display: flex;
    align-items: center;
    gap: 8px;
    padding: 16px 24px;
    font-size: 1rem;
    font-weight: 600;
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

.categories-grid {
    display: grid;
    grid-template-columns: repeat(auto-fill, minmax(320px, 1fr));
    gap: 24px;
    margin-bottom: 32px;
}

.category-card {
    position: relative;
    overflow: hidden;
    transition: all 0.3s ease;
    border: 1px solid var(--border-color);
    background: var(--bg-primary);
    border-radius: 16px;
}

.category-card:hover {
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

.category-card:hover .card-image img {
    transform: scale(1.1);
}

.category-placeholder {
    width: 100%;
    height: 100%;
    background: var(--bg-secondary);
    display: flex;
    align-items: center;
    justify-content: center;
    color: var(--text-muted);
}

.category-placeholder svg {
    opacity: 0.5;
}

.card-overlay {
    position: absolute;
    top: 0;
    left: 0;
    right: 0;
    bottom: 0;
    background: rgba(0, 0, 0, 0.7);
    display: flex;
    align-items: center;
    justify-content: center;
    gap: 12px;
    opacity: 0;
    transition: opacity 0.3s ease;
}

.category-card:hover .card-overlay {
    opacity: 1;
}

.overlay-btn {
    padding: 8px 16px;
    border: none;
    border-radius: 8px;
    font-weight: 500;
    cursor: pointer;
    transition: all 0.2s ease;
    display: flex;
    align-items: center;
    gap: 6px;
    font-size: 0.875rem;
}

.browse-btn {
    background: var(--accent-primary);
    color: white;
}

.browse-btn:hover {
    background: var(--accent-secondary);
    transform: scale(1.05);
}

.edit-btn {
    background: var(--bg-primary);
    color: var(--text-primary);
    border: 1px solid var(--border-color);
}

.edit-btn:hover {
    background: var(--accent-primary);
    color: white;
    border-color: var(--accent-primary);
}

.card-content {
    padding: 20px;
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
    font-size: 0.875rem;
    line-height: 1.5;
    margin-bottom: 16px;
    display: -webkit-box;
    -webkit-line-clamp: 2;
    -webkit-box-orient: vertical;
    overflow: hidden;
}

.card-meta {
    margin-bottom: 16px;
}

.category-stats {
    display: inline-flex;
    align-items: center;
    gap: 6px;
    background: var(--bg-secondary);
    color: var(--accent-primary);
    padding: 6px 12px;
    border-radius: 12px;
    font-size: 0.875rem;
    font-weight: 500;
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
    font-size: 0.875rem;
}

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

.pagination-container {
    display: flex;
    justify-content: center;
    margin-top: 32px;
}

.pagination-container nav {
    background: var(--bg-primary);
    border-radius: 12px;
    padding: 16px;
    border: 1px solid var(--border-color);
}

.pagination-container .pagination {
    margin: 0;
}

.pagination-container .page-link {
    border: none;
    color: var(--text-primary);
    background: transparent;
    padding: 8px 12px;
    margin: 0 4px;
    border-radius: 8px;
    transition: all 0.2s ease;
}

.pagination-container .page-link:hover {
    background: var(--accent-primary);
    color: white;
}

.pagination-container .page-item.active .page-link {
    background: var(--accent-primary);
    color: white;
}

.pagination-container .page-item.disabled .page-link {
    color: var(--text-muted);
    background: transparent;
}

@media (max-width: 768px) {
    .section-title {
        font-size: 2rem;
    }
    
    .categories-grid {
        grid-template-columns: 1fr;
        gap: 20px;
    }
    
    .action-bar .btn {
        width: 100%;
        justify-content: center;
    }
}

@media (max-width: 480px) {
    .section-title {
        font-size: 1.75rem;
    }
    
    .card-content {
        padding: 16px;
    }
    
    .card-title {
        font-size: 1.125rem;
    }
}
</style>

<script>
// Add smooth animations
document.addEventListener('DOMContentLoaded', function() {
    const categoryCards = document.querySelectorAll('.category-card');
    categoryCards.forEach((card, index) => {
        card.style.opacity = '0';
        card.style.transform = 'translateY(30px)';
        
        setTimeout(() => {
            card.style.transition = 'all 0.6s ease';
            card.style.opacity = '1';
            card.style.transform = 'translateY(0)';
        }, index * 100);
    });
});

// Add hover effects for better interactivity
document.querySelectorAll('.category-card').forEach(card => {
    card.addEventListener('mouseenter', function() {
        this.style.transform = 'translateY(-8px) scale(1.02)';
    });
    
    card.addEventListener('mouseleave', function() {
        this.style.transform = 'translateY(0) scale(1)';
    });
});
</script>
@endsection
