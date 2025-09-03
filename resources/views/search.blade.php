@extends('layout')

@section('title', 'Search Results')

@section('content')
<div class="search-page">
    <!-- Hero Section -->
    <div class="search-hero">
        <div class="container">
            <div class="search-header">
                <h1 class="search-title">
                    <span class="search-icon">🔍</span>
                    Search Results
                </h1>
                <p class="search-subtitle">
                    Found <strong>{{ $books->total() }}</strong> results for 
                    "<strong>"{{ $query }}"</strong>"
                </p>
            </div>
        </div>
    </div>

    <!-- Filters Section -->
    <div class="filters-section">
        <div class="container">
            <div class="filters-wrapper">
                <form action="{{ route('search') }}" method="GET" class="filters-form">
                    <input type="hidden" name="q" value="{{ $query }}">
                    
                    <div class="filter-group">
                        <label for="category" class="filter-label">
                            <span class="filter-icon">📂</span>
                            Category
                        </label>
                        <select name="category" id="category" class="filter-select" onchange="this.form.submit()">
                            <option value="">All Categories</option>
                            @foreach($categories as $category)
                                <option value="{{ $category->id }}" 
                                    {{ ($category_id ?? '') == $category->id ? 'selected' : '' }}>
                                    {{ $category->name }}
                                </option>
                            @endforeach
                        </select>
                    </div>

                    <div class="filter-group">
                        <label for="sort" class="filter-label">
                            <span class="filter-icon">🔄</span>
                            Sort by
                        </label>
                        <select name="sort" id="sort" class="filter-select" onchange="this.form.submit()">
                            <option value="newest" {{ ($sort ?? 'newest') == 'newest' ? 'selected' : '' }}>
                                Newest First
                            </option>
                            <option value="oldest" {{ ($sort ?? '') == 'oldest' ? 'selected' : '' }}>
                                Oldest First
                            </option>
                            <option value="title" {{ ($sort ?? '') == 'title' ? 'selected' : '' }}>
                                Title A-Z
                            </option>
                        </select>
                    </div>

                    @if($category_id || $sort != 'newest')
                        <a href="{{ route('search', ['q' => $query]) }}" class="reset-btn">
                            <span class="reset-icon">↻</span>
                            Reset Filters
                        </a>
                    @endif
                </form>

                <!-- Active Filters -->
                @if($category_id || $sort != 'newest')
                    <div class="active-filters">
                        <span class="active-label">Active filters:</span>
                        @if($category_id)
                            <span class="filter-tag">
                                📂 {{ $categories->find($category_id)->name ?? 'Unknown' }}
                                <a href="{{ route('search', ['q' => $query, 'sort' => $sort]) }}" class="remove-filter">×</a>
                            </span>
                        @endif
                        @if($sort && $sort != 'newest')
                            <span class="filter-tag">
                                🔄 Sort: {{ ucfirst($sort) }}
                                <a href="{{ route('search', ['q' => $query, 'category' => $category_id]) }}" class="remove-filter">×</a>
                            </span>
                        @endif
                    </div>
                @endif
            </div>
        </div>
    </div>

    <!-- Results Section -->
    <div class="results-section">
        <div class="container">
            @if($books->count() > 0)
                <div class="books-grid">
                    @foreach($books as $book)
                        <div class="book-card">
                            <div class="book-image">
                                @if($book->image)
                                    <img src="{{ asset('storage/' . $book->image) }}" alt="{{ $book->title }}">
                                @else
                                    <div class="book-placeholder">
                                        <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                                            <path d="M4 19.5A2.5 2.5 0 0 1 6.5 17H20"></path>
                                            <path d="M6.5 2H20v20H6.5A2.5 2.5 0 0 1 4 19.5v-15A2.5 2.5 0 0 1 6.5 2z"></path>
                                        </svg>
                                    </div>
                                @endif
                            </div>
                            
                            <div class="book-content">
                                <h3 class="book-title">
                                    <a href="{{ route('showBook', $book->id) }}">{{ $book->title }}</a>
                                </h3>
                                
                                <p class="book-description">
                                    {{ Str::limit($book->desc ?? 'No description available', 120) }}
                                </p>
                                
                                <div class="book-meta">
                                    <div class="book-author">
                                        <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                                            <path d="M16 21v-2a4 4 0 0 0-4-4H6a4 4 0 0 0-4 4v2"></path>
                                            <circle cx="9" cy="7" r="4"></circle>
                                        </svg>
                                        {{ $book->user->name ?? 'Unknown Author' }}
                                    </div>
                                    
                                    @if($book->category)
                                        <div class="book-category">
                                            <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                                                <path d="M3 3h18v18H3zM21 9H3M21 15H3M12 3v18"/>
                                            </svg>
                                            {{ $book->category->name }}
                                        </div>
                                    @endif
                                </div>
                                
                                <div class="book-actions">
                                    <a href="{{ route('showBook', $book->id) }}" class="btn btn-primary">
                                        <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                                            <path d="M1 12s4-8 11-8 11 8 11 8-4 8-11 8-11-8-11-8z"></path>
                                            <circle cx="12" cy="12" r="3"></circle>
                                        </svg>
                                        View Book
                                    </a>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>

                <!-- Pagination -->
                @if($books->hasPages())
                    <div class="pagination-wrapper">
                        {{ $books->links() }}
                    </div>
                @endif
            @else
                <div class="no-results">
                    <div class="no-results-icon">
                        <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5">
                            <circle cx="11" cy="11" r="8"></circle>
                            <path d="m21 21-4.35-4.35"></path>
                            <line x1="11" y1="8" x2="11" y2="12"></line>
                            <line x1="11" y1="16" x2="11.01" y2="16"></line>
                        </svg>
                    </div>
                    <h3>No Results Found</h3>
                    <p>Try searching with different keywords or browse our available content.</p>
                    <a href="{{ route('home') }}" class="btn btn-primary">Go to Home Page</a>
                </div>
            @endif
        </div>
    </div>
</div>

<style>
/* Dark Mode CSS Variables */
:root {
    --dark-bg-primary: #0f0f23;
    --dark-bg-secondary: #1a1a2e;
    --dark-bg-tertiary: #16213e;
    --dark-card-bg: #1e1e2e;
    --dark-card-hover: #252538;
    --dark-text-primary: #ffffff;
    --dark-text-secondary: #b8b8d1;
    --dark-text-muted: #8b8ba7;
    --dark-border: rgba(255, 255, 255, 0.1);
    --dark-border-hover: rgba(255, 255, 255, 0.2);
    --accent-blue: #4fc3f7;
    --accent-green: #81c784;
    --accent-red: #ff6b6b;
    --accent-purple: #bb86fc;
    --shadow-light: 0 4px 6px -1px rgba(0, 0, 0, 0.3);
    --shadow-medium: 0 10px 15px -3px rgba(0, 0, 0, 0.4);
    --shadow-heavy: 0 20px 25px -5px rgba(0, 0, 0, 0.5);
    --glow-blue: 0 0 20px rgba(79, 195, 247, 0.3);
    --glow-green: 0 0 20px rgba(129, 199, 132, 0.3);
    --glow-purple: 0 0 20px rgba(187, 134, 252, 0.3);
}

/* Search Page Styles */
.search-page {
    min-height: 100vh;
    background: linear-gradient(135deg, var(--dark-bg-primary) 0%, var(--dark-bg-secondary) 50%, var(--dark-bg-tertiary) 100%);
    color: var(--dark-text-primary);
    position: relative;
    overflow-x: hidden;
}

.search-page::before {
    content: '';
    position: fixed;
    top: 0;
    left: 0;
    width: 100%;
    height: 100%;
    background: 
        radial-gradient(circle at 20% 80%, rgba(79, 195, 247, 0.1) 0%, transparent 50%),
        radial-gradient(circle at 80% 20%, rgba(187, 134, 252, 0.1) 0%, transparent 50%),
        radial-gradient(circle at 40% 40%, rgba(129, 199, 132, 0.05) 0%, transparent 50%);
    pointer-events: none;
    z-index: 0;
}

.container {
    max-width: 1200px;
    margin: 0 auto;
    padding: 0 20px;
    position: relative;
    z-index: 1;
}

/* Hero Section */
.search-hero {
    padding: 80px 0 60px;
    text-align: center;
    color: var(--dark-text-primary);
    background: rgba(26, 26, 46, 0.8);
    backdrop-filter: blur(10px);
    border-bottom: 1px solid var(--dark-border);
    position: relative;
}

.search-hero::before {
    content: '';
    position: absolute;
    top: 0;
    left: 0;
    right: 0;
    bottom: 0;
    background: linear-gradient(45deg, transparent 30%, rgba(79, 195, 247, 0.1) 50%, transparent 70%);
    animation: shimmer 3s ease-in-out infinite;
}

@keyframes shimmer {
    0%, 100% { transform: translateX(-100%); }
    50% { transform: translateX(100%); }
}

.search-title {
    font-size: 3.5rem;
    font-weight: 800;
    margin-bottom: 20px;
    display: flex;
    align-items: center;
    justify-content: center;
    gap: 20px;
    text-shadow: 0 0 30px rgba(79, 195, 247, 0.5);
    position: relative;
}

.search-icon {
    font-size: 3rem;
    animation: float 3s ease-in-out infinite;
    filter: drop-shadow(0 0 20px rgba(79, 195, 247, 0.6));
}

@keyframes float {
    0%, 100% { transform: translateY(0px) rotate(0deg); }
    50% { transform: translateY(-10px) rotate(5deg); }
}

.search-subtitle {
    font-size: 1.3rem;
    color: var(--dark-text-secondary);
    margin: 0;
    text-shadow: 0 2px 4px rgba(0, 0, 0, 0.3);
}

.search-subtitle strong {
    color: var(--accent-blue);
    text-shadow: 0 0 10px rgba(79, 195, 247, 0.5);
}

/* Filters Section */
.filters-section {
    background: rgba(30, 30, 46, 0.9);
    padding: 40px 0;
    backdrop-filter: blur(15px);
    margin-bottom: 50px;
    border-bottom: 1px solid var(--dark-border);
    position: relative;
}

.filters-wrapper {
    background: rgba(37, 37, 56, 0.8);
    padding: 30px;
    border-radius: 20px;
    border: 1px solid var(--dark-border);
    box-shadow: var(--shadow-medium);
    backdrop-filter: blur(10px);
}

.filters-form {
    display: flex;
    align-items: flex-end;
    gap: 25px;
    flex-wrap: wrap;
    justify-content: center;
    margin-bottom: 25px;
}

.filter-group {
    display: flex;
    flex-direction: column;
    gap: 10px;
    min-width: 200px;
}

.filter-label {
    font-weight: 600;
    color: var(--dark-text-primary);
    font-size: 0.95rem;
    display: flex;
    align-items: center;
    gap: 8px;
    text-shadow: 0 2px 4px rgba(0, 0, 0, 0.3);
}

.filter-icon {
    font-size: 1.1rem;
    filter: drop-shadow(0 0 8px rgba(79, 195, 247, 0.4));
}

.filter-select {
    padding: 14px 18px;
    border: 2px solid var(--dark-border);
    border-radius: 12px;
    background: rgba(42, 42, 62, 0.9);
    color: var(--dark-text-primary);
    font-size: 1rem;
    transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
    cursor: pointer;
    backdrop-filter: blur(5px);
}

.filter-select:focus {
    outline: none;
    border-color: var(--accent-blue);
    box-shadow: var(--glow-blue);
    background: rgba(42, 42, 62, 0.95);
    transform: translateY(-2px);
}

.filter-select:hover {
    border-color: var(--dark-border-hover);
    box-shadow: var(--shadow-light);
}

.reset-btn {
    padding: 14px 24px;
    background: linear-gradient(135deg, var(--accent-blue), var(--accent-purple));
    color: white;
    text-decoration: none;
    border-radius: 12px;
    font-size: 0.95rem;
    font-weight: 600;
    transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
    display: flex;
    align-items: center;
    gap: 10px;
    align-self: flex-end;
    box-shadow: var(--shadow-light);
    text-shadow: 0 2px 4px rgba(0, 0, 0, 0.3);
}

.reset-btn:hover {
    transform: translateY(-3px) scale(1.02);
    box-shadow: var(--shadow-heavy), var(--glow-blue);
    background: linear-gradient(135deg, var(--accent-purple), var(--accent-blue));
}

.reset-icon {
    font-size: 1.1rem;
    animation: spin 2s linear infinite;
}

@keyframes spin {
    from { transform: rotate(0deg); }
    to { transform: rotate(360deg); }
}

/* Active Filters */
.active-filters {
    display: flex;
    align-items: center;
    gap: 15px;
    flex-wrap: wrap;
    padding: 20px;
    background: rgba(30, 30, 46, 0.6);
    border-radius: 15px;
    margin-top: 20px;
    border: 1px solid var(--dark-border);
    backdrop-filter: blur(5px);
}

.active-label {
    font-weight: 600;
    color: var(--dark-text-primary);
    font-size: 0.95rem;
    text-shadow: 0 2px 4px rgba(0, 0, 0, 0.3);
}

.filter-tag {
    display: inline-flex;
    align-items: center;
    gap: 10px;
    background: linear-gradient(135deg, var(--accent-blue), var(--accent-green));
    color: white;
    padding: 10px 16px;
    border-radius: 25px;
    font-size: 0.9rem;
    font-weight: 500;
    box-shadow: var(--shadow-light);
    text-shadow: 0 2px 4px rgba(0, 0, 0, 0.3);
    transition: all 0.3s ease;
}

.filter-tag:hover {
    transform: translateY(-2px) scale(1.05);
    box-shadow: var(--shadow-medium), var(--glow-green);
}

.remove-filter {
    color: white;
    text-decoration: none;
    font-weight: bold;
    margin-left: 6px;
    padding: 4px 8px;
    border-radius: 50%;
    transition: all 0.3s ease;
    display: inline-block;
    background: rgba(255, 255, 255, 0.2);
}

.remove-filter:hover {
    background: rgba(255, 255, 255, 0.3);
    transform: scale(1.2);
}

/* Results Section */
.results-section {
    padding: 0 0 80px;
    position: relative;
}

.books-grid {
    display: grid;
    grid-template-columns: repeat(auto-fill, minmax(350px, 1fr));
    gap: 35px;
    margin-bottom: 60px;
}

/* Book Card */
.book-card {
    background: var(--dark-card-bg);
    border-radius: 20px;
    overflow: hidden;
    box-shadow: var(--shadow-medium);
    transition: all 0.4s cubic-bezier(0.4, 0, 0.2, 1);
    cursor: pointer;
    border: 1px solid var(--dark-border);
    position: relative;
    animation: slideInUp 0.6s ease-out forwards;
    opacity: 0;
    transform: translateY(30px);
}

.book-card:nth-child(1) { animation-delay: 0.1s; }
.book-card:nth-child(2) { animation-delay: 0.2s; }
.book-card:nth-child(3) { animation-delay: 0.3s; }
.book-card:nth-child(4) { animation-delay: 0.4s; }
.book-card:nth-child(5) { animation-delay: 0.5s; }
.book-card:nth-child(6) { animation-delay: 0.6s; }

@keyframes slideInUp {
    to {
        opacity: 1;
        transform: translateY(0);
    }
}

.book-card::before {
    content: '';
    position: absolute;
    top: 0;
    left: 0;
    right: 0;
    bottom: 0;
    background: linear-gradient(135deg, transparent 0%, rgba(79, 195, 247, 0.05) 50%, transparent 100%);
    opacity: 0;
    transition: opacity 0.3s ease;
    pointer-events: none;
}

.book-card:hover {
    transform: translateY(-8px) scale(1.02);
    box-shadow: var(--shadow-heavy), var(--glow-blue);
    border-color: var(--accent-blue);
}

.book-card:hover::before {
    opacity: 1;
}

.book-image {
    height: 240px;
    overflow: hidden;
    position: relative;
}

.book-image img {
    width: 100%;
    height: 100%;
    object-fit: cover;
    transition: transform 0.4s cubic-bezier(0.4, 0, 0.2, 1);
    border-radius: 20px 20px 0 0;
}

.book-card:hover .book-image img {
    transform: scale(1.08);
}

.book-placeholder {
    width: 100%;
    height: 100%;
    background: linear-gradient(135deg, var(--dark-bg-secondary), var(--dark-bg-tertiary));
    display: flex;
    align-items: center;
    justify-content: center;
    color: var(--dark-text-muted);
    border-bottom: 1px solid var(--dark-border);
    border-radius: 20px 20px 0 0;
}

.book-placeholder svg {
    width: 60px;
    height: 60px;
    opacity: 0.6;
    filter: drop-shadow(0 0 10px rgba(79, 195, 247, 0.3));
}

.book-content {
    padding: 30px;
    display: flex;
    flex-direction: column;
    flex-grow: 1;
    background: var(--dark-card-bg);
}

.book-title {
    font-size: 1.4rem;
    font-weight: 700;
    color: var(--dark-text-primary);
    margin-bottom: 15px;
    line-height: 1.4;
    text-shadow: 0 2px 4px rgba(0, 0, 0, 0.3);
}

.book-title a {
    text-decoration: none;
    color: inherit;
    transition: all 0.3s ease;
}

.book-title a:hover {
    color: var(--accent-blue);
    text-shadow: 0 0 15px rgba(79, 195, 247, 0.6);
}

.book-description {
    color: var(--dark-text-secondary);
    font-size: 1rem;
    line-height: 1.7;
    margin-bottom: 25px;
    flex-grow: 1;
}

.book-meta {
    display: flex;
    align-items: center;
    gap: 18px;
    margin-bottom: 25px;
    flex-wrap: wrap;
}

.book-author,
.book-category {
    display: flex;
    align-items: center;
    gap: 8px;
    font-size: 0.9rem;
    color: var(--dark-text-secondary);
    padding: 8px 12px;
    border-radius: 20px;
    background: rgba(255, 255, 255, 0.05);
    border: 1px solid var(--dark-border);
    transition: all 0.3s ease;
}

.book-author:hover,
.book-category:hover {
    background: rgba(255, 255, 255, 0.1);
    transform: translateY(-2px);
    box-shadow: var(--shadow-light);
}

.book-author svg,
.book-category svg {
    width: 18px;
    height: 18px;
    color: var(--accent-blue);
}

.book-category {
    background: linear-gradient(135deg, var(--accent-blue), var(--accent-green));
    color: white;
    border: none;
    text-shadow: 0 2px 4px rgba(0, 0, 0, 0.3);
}

.book-category svg {
    color: white;
}

.book-actions {
    display: flex;
    gap: 15px;
    flex-wrap: wrap;
}

.btn {
    display: inline-flex;
    align-items: center;
    gap: 10px;
    padding: 12px 20px;
    text-decoration: none;
    border-radius: 12px;
    font-size: 0.95rem;
    font-weight: 600;
    transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
    flex: 1;
    justify-content: center;
    text-shadow: 0 2px 4px rgba(0, 0, 0, 0.3);
    position: relative;
    overflow: hidden;
}

.btn::before {
    content: '';
    position: absolute;
    top: 0;
    left: -100%;
    width: 100%;
    height: 100%;
    background: linear-gradient(90deg, transparent, rgba(255, 255, 255, 0.2), transparent);
    transition: left 0.5s ease;
}

.btn:hover::before {
    left: 100%;
}

.btn svg {
    width: 18px;
    height: 18px;
    transition: transform 0.3s ease;
}

.btn:hover svg {
    transform: scale(1.2);
}

.btn-primary {
    background: linear-gradient(135deg, var(--accent-blue), var(--accent-purple));
    color: white;
    box-shadow: var(--shadow-light);
}

.btn-primary:hover {
    background: linear-gradient(135deg, var(--accent-purple), var(--accent-blue));
    transform: translateY(-3px) scale(1.02);
    box-shadow: var(--shadow-heavy), var(--glow-blue);
}

.btn-secondary {
    background: rgba(255, 255, 255, 0.1);
    color: var(--accent-blue);
    border: 2px solid var(--accent-blue);
    backdrop-filter: blur(5px);
}

.btn-secondary:hover {
    background: rgba(79, 195, 247, 0.1);
    transform: translateY(-3px) scale(1.02);
    box-shadow: var(--shadow-medium), var(--glow-blue);
    border-color: var(--accent-purple);
}

/* No Results */
.no-results {
    text-align: center;
    padding: 100px 50px;
    background: var(--dark-card-bg);
    border-radius: 25px;
    box-shadow: var(--shadow-heavy);
    border: 2px dashed var(--dark-border);
    position: relative;
    overflow: hidden;
}

.no-results::before {
    content: '';
    position: absolute;
    top: 0;
    left: 0;
    right: 0;
    bottom: 0;
    background: 
        radial-gradient(circle at 30% 30%, rgba(79, 195, 247, 0.1) 0%, transparent 50%),
        radial-gradient(circle at 70% 70%, rgba(187, 134, 252, 0.1) 0%, transparent 50%);
    pointer-events: none;
}

.no-results-icon {
    margin-bottom: 40px;
    opacity: 0.8;
    animation: pulse 2s ease-in-out infinite;
}

.no-results-icon svg {
    width: 100px;
    height: 100px;
    color: var(--accent-blue);
    filter: drop-shadow(0 0 30px rgba(79, 195, 247, 0.5));
}

@keyframes pulse {
    0%, 100% { transform: scale(1); opacity: 0.8; }
    50% { transform: scale(1.1); opacity: 1; }
}

.no-results h3 {
    font-size: 2.5rem;
    color: var(--dark-text-primary);
    margin-bottom: 20px;
    font-weight: 800;
    text-shadow: 0 0 30px rgba(79, 195, 247, 0.5);
}

.no-results p {
    color: var(--dark-text-secondary);
    font-size: 1.2rem;
    margin-bottom: 35px;
    line-height: 1.6;
}

/* Pagination */
.pagination-wrapper {
    display: flex;
    justify-content: center;
    background: var(--dark-card-bg);
    padding: 30px;
    border-radius: 20px;
    box-shadow: var(--shadow-medium);
    border: 1px solid var(--dark-border);
    backdrop-filter: blur(10px);
}

/* Custom Pagination Styles */
.pagination-wrapper .pagination {
    display: flex;
    list-style: none;
    padding: 0;
    margin: 0;
    gap: 10px;
}

.pagination-wrapper .page-item {
    margin: 0;
}

.pagination-wrapper .page-link {
    padding: 12px 18px;
    border: 2px solid var(--dark-border);
    border-radius: 12px;
    color: var(--dark-text-secondary);
    text-decoration: none;
    transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
    background: rgba(255, 255, 255, 0.05);
    backdrop-filter: blur(5px);
    font-weight: 500;
}

.pagination-wrapper .page-link:hover {
    border-color: var(--accent-blue);
    color: var(--accent-blue);
    background: rgba(79, 195, 247, 0.1);
    transform: translateY(-2px);
    box-shadow: var(--shadow-light), var(--glow-blue);
}

.pagination-wrapper .page-item.active .page-link {
    background: linear-gradient(135deg, var(--accent-blue), var(--accent-purple));
    border-color: var(--accent-blue);
    color: white;
    box-shadow: var(--shadow-light), var(--glow-blue);
    text-shadow: 0 2px 4px rgba(0, 0, 0, 0.3);
}

.pagination-wrapper .page-item.disabled .page-link {
    opacity: 0.3;
    cursor: not-allowed;
    transform: none;
}

/* Custom Scrollbar */
.search-page::-webkit-scrollbar {
    width: 12px;
}

.search-page::-webkit-scrollbar-track {
    background: var(--dark-bg-secondary);
    border-radius: 6px;
}

.search-page::-webkit-scrollbar-thumb {
    background: linear-gradient(135deg, var(--accent-blue), var(--accent-purple));
    border-radius: 6px;
    border: 2px solid var(--dark-bg-secondary);
}

.search-page::-webkit-scrollbar-thumb:hover {
    background: linear-gradient(135deg, var(--accent-purple), var(--accent-blue));
}

/* Responsive Design */
@media (max-width: 768px) {
    .search-title {
        font-size: 2.5rem;
        flex-direction: column;
        gap: 15px;
    }
    
    .search-icon {
        font-size: 2.5rem;
    }
    
    .filters-form {
        flex-direction: column;
        align-items: stretch;
    }
    
    .filter-group {
        min-width: auto;
    }
    
    .books-grid {
        grid-template-columns: 1fr;
        gap: 25px;
    }
    
    .book-content {
        padding: 25px;
    }
    
    .book-actions {
        flex-direction: column;
    }
    
    .btn {
        flex: none;
    }
    
    .no-results {
        padding: 60px 30px;
    }
    
    .no-results h3 {
        font-size: 2rem;
    }
}

@media (max-width: 480px) {
    .container {
        padding: 0 15px;
    }
    
    .search-hero {
        padding: 60px 0 40px;
    }
    
    .search-title {
        font-size: 2rem;
    }
    
    .filters-wrapper {
        padding: 20px;
    }
    
    .book-card {
        margin: 0 10px;
    }
    
    .book-image {
        height: 200px;
    }
    
    .book-content {
        padding: 20px;
    }
    
    .book-meta {
        flex-direction: column;
        align-items: flex-start;
        gap: 10px;
    }
    
    .pagination-wrapper {
        padding: 20px;
    }
    
    .pagination-wrapper .pagination {
        gap: 5px;
    }
    
    .pagination-wrapper .page-link {
        padding: 10px 14px;
        font-size: 0.9rem;
    }
}

/* Loading Animation */
@keyframes shimmer-loading {
    0% { background-position: -200px 0; }
    100% { background-position: calc(200px + 100%) 0; }
}

.loading {
    background: linear-gradient(90deg, var(--dark-card-bg) 25%, var(--dark-card-hover) 50%, var(--dark-card-bg) 75%);
    background-size: 200px 100%;
    animation: shimmer-loading 1.5s infinite;
}
</style>

<script>
// Parallax Effect
window.addEventListener('scroll', () => {
    const scrolled = window.pageYOffset;
    const parallax = document.querySelector('.search-hero');
    const speed = scrolled * 0.5;
    parallax.style.transform = `translateY(${speed}px)`;
});

// Smooth scroll for anchor links
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

// Add loading state to forms
document.querySelectorAll('form').forEach(form => {
    form.addEventListener('submit', function() {
        const submitBtn = this.querySelector('button[type="submit"], input[type="submit"]');
        if (submitBtn) {
            submitBtn.style.opacity = '0.7';
            submitBtn.style.pointerEvents = 'none';
        }
    });
});

// Intersection Observer for animations
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
document.querySelectorAll('.book-card').forEach(card => {
    observer.observe(card);
});
</script>
@endsection
