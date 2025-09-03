# Digital Library - Roles & Permissions System

## Overview
This Laravel application implements a comprehensive roles and permissions system for a digital library. The system supports four user roles with different levels of access to books and categories.

## Quick Start

### 1. Database Setup
Make sure your database is migrated and seeded:
```bash
php artisan migrate
php artisan db:seed
```

### 2. User Roles
The system supports four roles:
- **Guest**: Unauthenticated visitors (view only)
- **User**: Registered users (view, read, download)
- **Author**: Content creators (view, read, download, create, edit own books)
- **Admin**: System administrators (full access)

### 3. Testing the System
Run the permission tests to verify everything works:
```bash
php artisan test --filter=RolesAndPermissionsTest
```

## Key Features

### Permission-Based Access Control
- **Route Protection**: Middleware prevents unauthorized access
- **Controller Validation**: Double-check permissions in controller methods
- **View-Level Security**: UI elements show/hide based on user permissions

### Book Management
- **Authors**: Can create, edit, and delete their own books
- **Admins**: Can manage all books regardless of ownership
- **Users**: Can read and download books
- **Guests**: Can only view books

### Category Management
- **Admins Only**: Full category management (create, edit, delete)
- **Other Roles**: Read-only access to categories

## Usage Examples

### Checking Permissions in Views
```blade
@auth
    @if(Auth::user()->canCreateBooks())
        <a href="{{ route('createBook') }}">Add New Book</a>
    @endif
    
    @if(Auth::user()->canEditBook($book))
        <a href="{{ route('editBook', $book->id) }}">Edit Book</a>
    @endif
    
    @if(Auth::user()->canManageCategories())
        <a href="{{ route('createCategory') }}">Manage Categories</a>
    @endif
@endauth
```

### Checking Permissions in Controllers
```php
public function edit($id) {
    $book = Book::findOrFail($id);
    
    if (!auth()->user()->canEditBook($book)) {
        abort(403, 'Unauthorized action.');
    }
    
    // Proceed with edit operation
}
```

### Route Protection
```php
// Public routes
Route::get('books', 'all')->name('allBooks');

// Authenticated routes
Route::middleware(['permission:download_books'])->group(function() {
    Route::get('books/download/{book}', 'download')->name('downloadBook');
});

// Author/Admin routes
Route::middleware(['permission:create_books'])->group(function() {
    Route::get('books/create', 'create')->name('createBook');
});

// Admin only routes
Route::middleware(['permission:manage_categories'])->group(function() {
    Route::get('categories/create', 'create')->name('createCategory');
});
```

## Security Features

### Multi-Level Protection
1. **Route Middleware**: First line of defense
2. **Controller Validation**: Second line of defense
3. **View Conditions**: UI-level protection

### Error Handling
- **403 Forbidden**: Unauthorized actions
- **Login Redirects**: Guest access attempts
- **Clear Messages**: User-friendly error messages

## File Structure

### Key Files
- `app/Models/User.php` - Permission methods
- `app/Http/Middleware/CheckPermission.php` - Permission middleware
- `routes/web.php` - Protected routes
- `resources/views/` - Permission-aware views
- `tests/Feature/RolesAndPermissionsTest.php` - Test suite

### Documentation
- `ROLES_PERMISSIONS.md` - Comprehensive documentation
- `README.md` - This file

## Best Practices

1. **Always use permission methods** instead of manual role checks
2. **Protect routes with middleware** for security
3. **Validate in controllers** for additional security
4. **Use consistent naming** across the application
5. **Test thoroughly** to ensure permissions work correctly

## Support

For questions or issues with the permission system, refer to:
- `ROLES_PERMISSIONS.md` for detailed documentation
- `tests/Feature/RolesAndPermissionsTest.php` for usage examples
- Laravel documentation for general framework questions
