@extends('layout')

@section('title', 'Admin Dashboard - Digital Library')

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
                        <path d="M3 3h18v18H3zM21 9H3M21 15H3M12 3v18"/>
                    </svg>
                    Admin Dashboard
                </h1>
                <p class="page-subtitle">Manage your digital library system</p>
            </div>
            <div class="header-actions">
                <div class="admin-info">
                    <span class="admin-badge">
                        <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                            <path d="M16 21v-2a4 4 0 0 0-4-4H6a4 4 0 0 0-4 4v2"></path>
                            <circle cx="9" cy="7" r="4"></circle>
                        </svg>
                        {{ Auth::user()->name }}
                    </span>
                </div>
            </div>
        </div>
    </div>

    <!-- Statistics Cards -->
    <div class="stats-grid">
        <div class="stat-card books-stat">
            <div class="stat-icon">
                <svg width="32" height="32" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                    <path d="M4 19.5A2.5 2.5 0 0 1 6.5 17H20"></path>
                    <path d="M6.5 2H20v20H6.5A2.5 2.5 0 0 1 4 19.5v-15A2.5 2.5 0 0 1 6.5 2z"></path>
                </svg>
            </div>
            <div class="stat-content">
                <h3 class="stat-number">{{ $books->count() }}</h3>
                <p class="stat-label">Total Books</p>
            </div>
        </div>

        <div class="stat-card users-stat">
            <div class="stat-icon">
                <svg width="32" height="32" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                    <path d="M16 21v-2a4 4 0 0 0-4-4H6a4 4 0 0 0-4 4v2"></path>
                    <circle cx="9" cy="7" r="4"></circle>
                    <path d="M22 21v-2a4 4 0 0 0-3-3.87"></path>
                    <path d="M16 3.13a4 4 0 0 1 0 7.75"></path>
                </svg>
            </div>
            <div class="stat-content">
                <h3 class="stat-number">{{ $users->count() }}</h3>
                <p class="stat-label">Total Users</p>
            </div>
        </div>

        <div class="stat-card categories-stat">
            <div class="stat-icon">
                <svg width="32" height="32" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                    <path d="M3 3h18v18H3zM21 9H3M21 15H3M12 3v18"/>
                </svg>
            </div>
            <div class="stat-content">
                <h3 class="stat-number">{{ $categories->count() }}</h3>
                <p class="stat-label">Categories</p>
            </div>
        </div>

        <div class="stat-card authors-stat">
            <div class="stat-icon">
                <svg width="32" height="32" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                    <path d="M16 21v-2a4 4 0 0 0-4-4H6a4 4 0 0 0-4 4v2"></path>
                    <circle cx="9" cy="7" r="4"></circle>
                </svg>
            </div>
            <div class="stat-content">
                <h3 class="stat-number">{{ $users->where('role', 'author')->count() }}</h3>
                <p class="stat-label">Authors</p>
            </div>
        </div>
</div>

    <!-- Quick Actions -->
    <div class="quick-actions">
        <h2 class="section-title">
            <svg width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                <path d="M12 2l3.09 6.26L22 9.27l-5 4.87 1.18 6.88L12 17.77l-6.18 3.25L7 14.14 2 9.27l6.91-1.01L12 2z"/>
            </svg>
            Quick Actions
        </h2>
        <div class="actions-grid">
            <a href="{{ route('createBook') }}" class="action-card">
                <svg width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                    <line x1="12" y1="5" x2="12" y2="19"></line>
                    <line x1="5" y1="12" x2="19" y2="12"></line>
                </svg>
                <span>Add New Book</span>
            </a>
            <a href="{{ route('createCategory') }}" class="action-card">
                <svg width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                    <line x1="12" y1="5" x2="12" y2="19"></line>
                    <line x1="5" y1="12" x2="19" y2="12"></line>
                </svg>
                <span>Add Category</span>
            </a>
            <a href="{{ route('allBooks') }}" class="action-card">
                <svg width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                    <path d="M4 19.5A2.5 2.5 0 0 1 6.5 17H20"></path>
                    <path d="M6.5 2H20v20H6.5A2.5 2.5 0 0 1 4 19.5v-15A2.5 2.5 0 0 1 6.5 2z"></path>
                </svg>
                <span>View All Books</span>
            </a>
            <a href="{{ route('allCategories') }}" class="action-card">
                <svg width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                    <path d="M3 3h18v18H3zM21 9H3M21 15H3M12 3v18"/>
                </svg>
                <span>Manage Categories</span>
            </a>
        </div>
    </div>

    <!-- Data Tables -->
    <div class="data-section">
<!-- Users Table -->
        <div class="data-card">
            <div class="card-header">
                <h2 class="card-title">
                    <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                        <path d="M16 21v-2a4 4 0 0 0-4-4H6a4 4 0 0 0-4 4v2"></path>
                        <circle cx="9" cy="7" r="4"></circle>
                        <path d="M22 21v-2a4 4 0 0 0-3-3.87"></path>
                        <path d="M16 3.13a4 4 0 0 1 0 7.75"></path>
                    </svg>
                    Users Management
                </h2>
                <span class="card-count">{{ $users->count() }} users</span>
            </div>
            <div class="table-container">
                <table class="data-table">
                    <thead>
    <tr>
        <th>Name</th>
        <th>Email</th>
        <th>Role</th>
                            <th>Joined</th>
        <th>Actions</th>
    </tr>
                    </thead>
                    <tbody>
    @foreach($users as $user)
    <tr>
                            <td class="user-name">
                                <div class="user-avatar">
                                    <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                                        <path d="M16 21v-2a4 4 0 0 0-4-4H6a4 4 0 0 0-4 4v2"></path>
                                        <circle cx="9" cy="7" r="4"></circle>
                                    </svg>
                                </div>
                                {{ $user->name ?? 'Unknown User' }}
                            </td>
        <td>{{ $user->email ?? 'No Email' }}</td>
                            <td>
                                <span class="role-badge role-{{ $user->role ?? 'user' }}">
                                    {{ $user->getRoleDisplayName() ?? 'User' }}
                                </span>
                            </td>
                            <td>{{ $user->created_at ? $user->created_at->format('M d, Y') : 'Unknown' }}</td>
                            <td class="actions">
                                <a href="{{ route('users.edit', $user->id ?? 0) }}" class="action-btn edit-btn" title="Edit User">
                                    <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                                        <path d="M11 4H4a2 2 0 0 0-2 2v14a2 2 0 0 0 2 2h14a2 2 0 0 0 2-2v-7"></path>
                                        <path d="M18.5 2.5a2.121 2.121 0 0 1 3 3L12 15l-4 1 1-4 9.5-9.5z"></path>
                                    </svg>
                                </a>
                                <form action="{{ route('users.delete', $user->id ?? 0) }}" method="POST" class="delete-form" onsubmit="return confirm('Are you sure you want to delete this user?')">
                @csrf
                @method('DELETE')
                                    <button type="submit" class="action-btn delete-btn" title="Delete User">
                                        <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                                            <polyline points="3,6 5,6 21,6"></polyline>
                                            <path d="M19,6v14a2,2,0,0,1-2,2H7a2,2,0,0,1-2-2V6m3,0V4a2,2,0,0,1,2-2h4a2,2,0,0,1,2,2V6"></path>
                                        </svg>
                                    </button>
            </form>
        </td>
    </tr>
    @endforeach
                    </tbody>
</table>
            </div>
        </div>

<!-- Books Table -->
        <div class="data-card">
            <div class="card-header">
                <h2 class="card-title">
                    <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                        <path d="M4 19.5A2.5 2.5 0 0 1 6.5 17H20"></path>
                        <path d="M6.5 2H20v20H6.5A2.5 2.5 0 0 1 4 19.5v-15A2.5 2.5 0 0 1 6.5 2z"></path>
                    </svg>
                    Books Management
                </h2>
                <span class="card-count">{{ $books->count() }} books</span>
            </div>
            <div class="table-container">
                <table class="data-table">
                    <thead>
    <tr>
        <th>Title</th>
        <th>Author</th>
        <th>Category</th>
                            <th>Added</th>
        <th>Actions</th>
    </tr>
                    </thead>
                    <tbody>
    @foreach($books as $book)
    <tr>
                            <td class="book-title">{{ $book->title }}</td>
        <td>{{ $book->user->name ?? 'Unknown Author' }}</td>
                            <td>
                                <span class="category-badge">
                                    {{ $book->category->name ?? 'Uncategorized' }}
                                </span>
                            </td>
                            <td>{{ $book->created_at ? $book->created_at->format('M d, Y') : 'Unknown' }}</td>
                            <td class="actions">
                                <a href="{{ route('showBook', $book->id) }}" class="action-btn view-btn" title="View Book">
                                    <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                                        <path d="M1 12s4-8 11-8 11 8 11 8-4 8-11 8-11-8-11-8z"></path>
                                        <circle cx="12" cy="12" r="3"></circle>
                                    </svg>
                                </a>
                                <a href="{{ route('editBook', $book->id) }}" class="action-btn edit-btn" title="Edit Book">
                                    <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                                        <path d="M11 4H4a2 2 0 0 0-2 2v14a2 2 0 0 0 2 2h14a2 2 0 0 0 2-2v-7"></path>
                                        <path d="M18.5 2.5a2.121 2.121 0 0 1 3 3L12 15l-4 1 1-4 9.5-9.5z"></path>
                                    </svg>
                                </a>
                                <form action="{{ route('deleteBook', $book->id) }}" method="POST" class="delete-form" onsubmit="return confirm('Are you sure you want to delete this book?')">
                @csrf
                @method('DELETE')
                                    <button type="submit" class="action-btn delete-btn" title="Delete Book">
                                        <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                                            <polyline points="3,6 5,6 21,6"></polyline>
                                            <path d="M19,6v14a2,2,0,0,1-2,2H7a2,2,0,0,1-2-2V6m3,0V4a2,2,0,0,1,2-2h4a2,2,0,0,1,2,2V6"></path>
                                        </svg>
                                    </button>
            </form>
        </td>
    </tr>
    @endforeach
                    </tbody>
</table>
            </div>
        </div>

<!-- Categories Table -->
        <div class="data-card">
            <div class="card-header">
                <h2 class="card-title">
                    <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                        <path d="M3 3h18v18H3zM21 9H3M21 15H3M12 3v18"/>
                    </svg>
                    Categories Management
                </h2>
                <span class="card-count">{{ $categories->count() }} categories</span>
            </div>
            <div class="table-container">
                <table class="data-table">
                    <thead>
    <tr>
        <th>Name</th>
                            <th>Books Count</th>
                            <th>Created</th>
        <th>Actions</th>
    </tr>
                    </thead>
                    <tbody>
    @foreach($categories as $category)
    <tr>
                            <td class="category-name">{{ $category->name }}</td>
                            <td>
                                <span class="books-count">{{ $category->books ? $category->books->count() : 0 }} books</span>
                            </td>
                            <td>{{ $category->created_at ? $category->created_at->format('M d, Y') : 'Unknown' }}</td>
                            <td class="actions">
                                <a href="{{ route('editCategory', $category->id) }}" class="action-btn edit-btn" title="Edit Category">
                                    <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                                        <path d="M11 4H4a2 2 0 0 0-2 2v14a2 2 0 0 0 2 2h14a2 2 0 0 0 2-2v-7"></path>
                                        <path d="M18.5 2.5a2.121 2.121 0 0 1 3 3L12 15l-4 1 1-4 9.5-9.5z"></path>
                                    </svg>
                                </a>
                                <form action="{{ route('deleteCategory', $category->id) }}" method="POST" class="delete-form" onsubmit="return confirm('Are you sure you want to delete this category?')">
                @csrf
                @method('DELETE')
                                    <button type="submit" class="action-btn delete-btn" title="Delete Category">
                                        <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                                            <polyline points="3,6 5,6 21,6"></polyline>
                                            <path d="M19,6v14a2,2,0,0,1-2,2H7a2,2,0,0,1-2-2V6m3,0V4a2,2,0,0,1,2-2h4a2,2,0,0,1,2,2V6"></path>
                                        </svg>
                                    </button>
            </form>
        </td>
    </tr>
    @endforeach
                    </tbody>
</table>
            </div>
        </div>
    </div>

    <!-- Notifications Section -->
    @if(auth()->user()->unreadNotifications->count() > 0)
    <div class="data-card">
        <div class="card-header">
            <h2 class="card-title">
                <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                    <path d="M6 8a6 6 0 0 1 12 0c0 7 3 9 3 9H3s3-2 3-9a6 6 0 0 1 12 0"></path>
                    <path d="M10.3 21a1.94 1.94 0 0 0 3.4 0"></path>
                </svg>
                Author Requests
            </h2>
            <div class="card-actions">
                <span class="card-count">{{ auth()->user()->unreadNotifications->count() }} requests</span>
            </div>
        </div>
        <div class="notifications-container">
            @foreach(auth()->user()->unreadNotifications as $notification)
            <div class="notification-item">
                <div class="notification-content">
                    <div class="notification-message">
                        <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                            <path d="M16 21v-2a4 4 0 0 0-4-4H6a4 4 0 0 0-4 4v2"></path>
                            <circle cx="9" cy="7" r="4"></circle>
                        </svg>
                        <span>{{ $notification->data['message'] ?? 'No message' }}</span>
                    </div>
                    <div class="notification-actions">
                        <form action="{{ route('admin.author.approve', $notification->data['user_id'] ?? 0) }}" method="POST" class="inline-form">
                            @csrf
                            <input type="hidden" name="notification_id" value="{{ $notification->id }}">
                            <button type="submit" class="btn btn-success btn-sm">
                                <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                                    <path d="M20 6L9 17l-5-5"></path>
                                </svg>
                                Approve
                            </button>
                        </form>
                        <form action="{{ route('admin.author.reject', $notification->data['user_id'] ?? 0) }}" method="POST" class="inline-form">
                            @csrf
                            <input type="hidden" name="notification_id" value="{{ $notification->id }}">
                            <button type="submit" class="btn btn-danger btn-sm">
                                <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                                    <path d="M18 6L6 18M6 6l12 12"></path>
                                </svg>
                                Reject
                            </button>
                        </form>
                    </div>
                </div>
            </div>
            @endforeach
        </div>
    </div>
    @endif
</div>

<style>
/* Page Header */
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

.admin-info {
    display: flex;
    align-items: center;
}

.admin-badge {
    display: flex;
    align-items: center;
    gap: 8px;
    background: var(--accent-primary);
    color: white;
    padding: 8px 16px;
    border-radius: 20px;
    font-weight: 500;
    font-size: 0.9rem;
}

/* Statistics Grid */
.stats-grid {
    display: grid;
    grid-template-columns: repeat(auto-fit, minmax(250px, 1fr));
    gap: 24px;
    margin-bottom: 40px;
}

.stat-card {
    background: var(--bg-primary);
    border-radius: 16px;
    padding: 24px;
    border: 1px solid var(--border-color);
    box-shadow: var(--shadow-md);
    transition: all 0.3s ease;
    display: flex;
    align-items: center;
    gap: 20px;
}

.stat-card:hover {
    transform: translateY(-4px);
    box-shadow: var(--shadow-xl);
}

.stat-icon {
    background: var(--accent-primary);
    color: white;
    width: 60px;
    height: 60px;
    border-radius: 12px;
    display: flex;
    align-items: center;
    justify-content: center;
}

.stat-content {
    flex: 1;
}

.stat-number {
    font-size: 2rem;
    font-weight: 700;
    color: var(--text-primary);
    margin: 0 0 4px 0;
}

.stat-label {
    color: var(--text-secondary);
    font-size: 0.9rem;
    margin: 0;
}

/* Quick Actions */
.quick-actions {
    margin-bottom: 40px;
}

.section-title {
    display: flex;
    align-items: center;
    gap: 12px;
    font-size: 1.5rem;
    font-weight: 600;
    color: var(--text-primary);
    margin-bottom: 20px;
}

.actions-grid {
    display: grid;
    grid-template-columns: repeat(auto-fit, minmax(200px, 1fr));
    gap: 16px;
}

.action-card {
    background: var(--bg-primary);
    border: 1px solid var(--border-color);
    border-radius: 12px;
    padding: 20px;
    text-decoration: none;
    color: var(--text-primary);
    transition: all 0.3s ease;
    display: flex;
    align-items: center;
    gap: 12px;
    box-shadow: var(--shadow-sm);
}

.action-card:hover {
    transform: translateY(-2px);
    box-shadow: var(--shadow-lg);
    border-color: var(--accent-primary);
    color: var(--accent-primary);
}

.action-card svg {
    color: var(--text-secondary);
    transition: color 0.3s ease;
}

.action-card:hover svg {
    color: var(--accent-primary);
}

/* Data Section */
.data-section {
    display: flex;
    flex-direction: column;
    gap: 32px;
}

.data-card {
    background: var(--bg-primary);
    border-radius: 16px;
    border: 1px solid var(--border-color);
    box-shadow: var(--shadow-md);
    overflow: hidden;
}

.card-header {
    display: flex;
    justify-content: space-between;
    align-items: center;
    padding: 24px;
    border-bottom: 1px solid var(--border-color);
    background: var(--bg-secondary);
}

.card-actions {
    display: flex;
    align-items: center;
    gap: 12px;
}

.card-title {
    display: flex;
    align-items: center;
    gap: 12px;
    font-size: 1.25rem;
    font-weight: 600;
    color: var(--text-primary);
    margin: 0;
}

.card-count {
    background: var(--accent-primary);
    color: white;
    padding: 4px 12px;
    border-radius: 12px;
    font-size: 0.85rem;
    font-weight: 500;
}

.table-container {
    overflow-x: auto;
}

.data-table {
    width: 100%;
    border-collapse: collapse;
}

.data-table th {
    background: var(--bg-secondary);
    color: var(--text-primary);
    font-weight: 600;
    text-align: left;
    padding: 16px;
    border-bottom: 1px solid var(--border-color);
}

.data-table td {
    padding: 16px;
    border-bottom: 1px solid var(--border-color);
    color: var(--text-secondary);
}

.data-table tr:hover {
    background: var(--bg-secondary);
}

.user-name {
    display: flex;
    align-items: center;
    gap: 8px;
    color: var(--text-primary);
    font-weight: 500;
}

.user-avatar {
    width: 32px;
    height: 32px;
    background: var(--accent-primary);
    color: white;
    border-radius: 50%;
    display: flex;
    align-items: center;
    justify-content: center;
}

.book-title {
    color: var(--text-primary);
    font-weight: 500;
}

.category-name {
    color: var(--text-primary);
    font-weight: 500;
}

.role-badge {
    padding: 4px 8px;
    border-radius: 6px;
    font-size: 0.8rem;
    font-weight: 500;
}

.role-admin {
    background: #dc2626;
    color: white;
}

.role-author {
    background: #d97706;
    color: white;
}

.role-user {
    background: #059669;
    color: white;
}

.category-badge {
    background: var(--accent-primary);
    color: white;
    padding: 4px 8px;
    border-radius: 6px;
    font-size: 0.8rem;
    font-weight: 500;
}

.books-count {
    color: var(--text-secondary);
    font-size: 0.9rem;
}

.actions {
    display: flex;
    gap: 8px;
}

.action-btn {
    width: 32px;
    height: 32px;
    border-radius: 6px;
    border: none;
    cursor: pointer;
    display: flex;
    align-items: center;
    justify-content: center;
    transition: all 0.2s ease;
    text-decoration: none;
}

.action-btn.view-btn {
    background: var(--accent-primary);
    color: white;
}

.action-btn.view-btn:hover {
    background: var(--accent-secondary);
    transform: translateY(-1px);
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

/* Notifications */
.notifications-container {
    padding: 24px;
}

.notification-item {
    background: var(--bg-secondary);
    border-radius: 12px;
    padding: 20px;
    margin-bottom: 16px;
    border: 1px solid var(--border-color);
    transition: all 0.3s ease;
}

.notification-item:hover {
    transform: translateY(-2px);
    box-shadow: var(--shadow-md);
}

.notification-content {
    display: flex;
    justify-content: space-between;
    align-items: center;
    gap: 16px;
}

.notification-message {
    display: flex;
    align-items: center;
    gap: 12px;
    color: var(--text-primary);
    font-weight: 500;
    flex: 1;
}

.notification-message svg {
    color: var(--accent-primary);
}

.notification-actions {
    display: flex;
    gap: 8px;
    flex-shrink: 0;
}

.inline-form {
    margin: 0;
}

.btn {
    display: inline-flex;
    align-items: center;
    gap: 6px;
    padding: 8px 16px;
    border-radius: 8px;
    border: none;
    font-weight: 500;
    font-size: 0.85rem;
    cursor: pointer;
    transition: all 0.2s ease;
    text-decoration: none;
}

.btn-sm {
    padding: 6px 12px;
    font-size: 0.8rem;
}

.btn-success {
    background: var(--success);
    color: white;
}

.btn-success:hover {
    background: #059669;
    transform: translateY(-1px);
}

.btn-danger {
    background: var(--danger);
    color: white;
}

.btn-danger:hover {
    background: #dc2626;
    transform: translateY(-1px);
}

.btn-secondary {
    background: var(--text-secondary);
    color: white;
}

.btn-secondary:hover {
    background: #6b7280;
    transform: translateY(-1px);
}

/* Alert */
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

/* Responsive Design */
@media (max-width: 768px) {
    .header-content {
        flex-direction: column;
        gap: 20px;
        text-align: center;
    }
    
    .page-title {
        font-size: 2rem;
    }
    
    .stats-grid {
        grid-template-columns: 1fr;
    }
    
    .actions-grid {
        grid-template-columns: 1fr;
    }
    
    .card-header {
        flex-direction: column;
        gap: 12px;
        text-align: center;
    }
    
    .data-table {
        font-size: 0.9rem;
    }
    
    .data-table th,
    .data-table td {
        padding: 12px 8px;
    }
    
    .notification-content {
        flex-direction: column;
        gap: 12px;
    }
    
    .notification-actions {
        width: 100%;
        justify-content: center;
    }
}

@media (max-width: 480px) {
    .header-content {
        padding: 24px;
    }
    
    .page-title {
        font-size: 1.75rem;
    }
    
    .stat-card {
        padding: 20px;
    }
    
    .stat-icon {
        width: 50px;
        height: 50px;
    }
    
    .stat-number {
        font-size: 1.5rem;
    }
}
</style>

<script>
// Add smooth animations
document.addEventListener('DOMContentLoaded', function() {
    // Animate page header
    const pageHeader = document.querySelector('.page-header');
    pageHeader.style.opacity = '0';
    pageHeader.style.transform = 'translateY(20px)';
    
    setTimeout(() => {
        pageHeader.style.transition = 'all 0.6s ease';
        pageHeader.style.opacity = '1';
        pageHeader.style.transform = 'translateY(0)';
    }, 100);

    // Animate stats cards
    const statCards = document.querySelectorAll('.stat-card');
    statCards.forEach((card, index) => {
        card.style.opacity = '0';
        card.style.transform = 'translateY(30px)';
        
        setTimeout(() => {
            card.style.transition = 'all 0.6s ease';
            card.style.opacity = '1';
            card.style.transform = 'translateY(0)';
        }, 200 + (index * 100));
    });

    // Animate action cards
    const actionCards = document.querySelectorAll('.action-card');
    actionCards.forEach((card, index) => {
        card.style.opacity = '0';
        card.style.transform = 'translateY(20px)';
        
        setTimeout(() => {
            card.style.transition = 'all 0.6s ease';
            card.style.opacity = '1';
            card.style.transform = 'translateY(0)';
        }, 600 + (index * 50));
    });

    // Animate data cards
    const dataCards = document.querySelectorAll('.data-card');
    dataCards.forEach((card, index) => {
        card.style.opacity = '0';
        card.style.transform = 'translateY(30px)';
        
        setTimeout(() => {
            card.style.transition = 'all 0.6s ease';
            card.style.opacity = '1';
            card.style.transform = 'translateY(0)';
        }, 800 + (index * 100));
    });

    // Animate notification items
    const notificationItems = document.querySelectorAll('.notification-item');
    notificationItems.forEach((item, index) => {
        item.style.opacity = '0';
        item.style.transform = 'translateY(20px)';
        
        setTimeout(() => {
            item.style.transition = 'all 0.6s ease';
            item.style.opacity = '1';
            item.style.transform = 'translateY(0)';
        }, 1000 + (index * 100));
    });
});
</script>
@endsection
