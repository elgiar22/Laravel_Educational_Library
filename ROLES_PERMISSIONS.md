# Roles & Permissions System Documentation

## Overview
This Laravel application implements a comprehensive roles and permissions system with four distinct user roles: Guest, User, Author, and Admin. Each role has specific permissions for different operations within the digital library system.

## User Roles

### 1. Guest (زائر)
- **Description**: Unauthenticated visitors
- **Permissions**: Can only view books and categories
- **Access Level**: Public read-only access

### 2. User (مسجل)
- **Description**: Registered users
- **Permissions**: Can view, read, and download books
- **Access Level**: Basic authenticated access

### 3. Author (كاتب)
- **Description**: Content creators
- **Permissions**: Can view, read, download, create, edit, and delete their own books
- **Access Level**: Content management for own works

### 4. Admin (مدير)
- **Description**: System administrators
- **Permissions**: Full access to all features including category management
- **Access Level**: Complete system control

## Permission Matrix

| Operation | Guest | User | Author | Admin |
|-----------|-------|------|--------|-------|
| View Books | ✅ Yes | ✅ Yes | ✅ Yes | ✅ Yes |
| Read Books | ❌ No | ✅ Yes | ✅ Yes | ✅ Yes |
| Download Books | ❌ No | ✅ Yes | ✅ Yes | ✅ Yes |
| Create Books | ❌ No | ❌ No | ✅ Yes | ✅ Yes |
| Edit Books | ❌ No | ❌ No | Own Only | ✅ Yes |
| Delete Books | ❌ No | ❌ No | Own Only | ✅ Yes |
| Manage Categories | ❌ No | ❌ No | ❌ No | ✅ Yes |

## Implementation Details

### User Model Methods
The `User` model includes the following permission methods:

```php
// Role checking methods
public function isGuest(): bool
public function isUser(): bool
public function isAuthor(): bool
public function isAdmin(): bool

// Permission checking methods
public function canViewBooks(): bool
public function canReadBooks(): bool
public function canDownloadBooks(): bool
public function canCreateBooks(): bool
public function canEditBook(Book $book): bool
public function canDeleteBook(Book $book): bool
public function canManageCategories(): bool

// Display methods
public function getRoleDisplayName(): string
public function getRoleDisplayNameAr(): string
```

### Middleware
The application uses a `CheckPermission` middleware that handles permission-based access control:

```php
// Route middleware usage
Route::middleware(['permission:view_books'])->group(function() {
    // Routes accessible to all users
});

Route::middleware(['permission:read_books'])->group(function() {
    // Routes requiring authentication
});

Route::middleware(['permission:create_books'])->group(function() {
    // Routes for authors and admins
});

Route::middleware(['permission:manage_categories'])->group(function() {
    // Routes for admins only
});
```

### Route Protection
Routes are protected using permission-based middleware:

- **Public Routes**: View books, view categories, search
- **Authenticated Routes**: Read books, download books
- **Author/Admin Routes**: Create, edit, delete books
- **Admin Only Routes**: Manage categories

### View-Level Permissions
Blade templates use permission methods to show/hide UI elements:

```blade
@auth
    @if(Auth::user()->canCreateBooks())
        <!-- Show create book button -->
    @endif
    
    @if(Auth::user()->canEditBook($book))
        <!-- Show edit button -->
    @endif
    
    @if(Auth::user()->canManageCategories())
        <!-- Show category management -->
    @endif
@endauth
```

## Security Features

### Authorization Checks
- **Controller Level**: All book operations check permissions before execution
- **Route Level**: Middleware prevents unauthorized access
- **View Level**: UI elements are conditionally displayed based on permissions

### Error Handling
- **403 Forbidden**: When users attempt unauthorized actions
- **Redirect to Login**: When guests try to access authenticated features
- **User-Friendly Messages**: Clear error messages explaining permission requirements

## Usage Examples

### Checking Permissions in Controllers
```php
public function edit($id) {
    $book = Book::findOrFail($id);
    
    if (!auth()->user()->canEditBook($book)) {
        abort(403, 'Unauthorized action. You can only edit your own books.');
    }
    
    // Proceed with edit operation
}
```

### Checking Permissions in Views
```blade
@auth
    @if(Auth::user()->canDownloadBooks())
        <a href="{{ route('downloadBook', $book) }}">Download</a>
    @else
        <span class="disabled">No Permission</span>
    @endif
@else
    <a href="{{ route('loginForm') }}">Login to Download</a>
@endauth
```

### Role-Based Navigation
```blade
@auth
    @if(Auth::user()->isAdmin())
        <a href="{{ route('admin.dashboard') }}">Admin Dashboard</a>
    @endif
    
    @if(Auth::user()->isAuthor())
        <a href="{{ route('myBooks') }}">My Books</a>
    @endif
@endauth
```

## Best Practices

1. **Always Check Permissions**: Never rely solely on UI hiding for security
2. **Use Middleware**: Protect routes at the middleware level
3. **Validate in Controllers**: Double-check permissions in controller methods
4. **Clear Error Messages**: Provide helpful feedback when access is denied
5. **Consistent Naming**: Use consistent method names across the application

## Future Enhancements

- **Permission Groups**: Group related permissions for easier management
- **Dynamic Permissions**: Allow admins to modify permissions without code changes
- **Audit Logging**: Track permission checks and access attempts
- **Role Inheritance**: Allow roles to inherit permissions from other roles
