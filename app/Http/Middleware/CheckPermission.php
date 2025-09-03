<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class CheckPermission
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next, string $permission): Response
    {
        // Check if user is authenticated
        if (!Auth::check()) {
            return redirect()->route('loginForm')->with('error', 'Please login first to access this feature.');
        }

        $user = Auth::user();
        $hasPermission = false;

        switch ($permission) {
            case 'view_books':
                $hasPermission = $user->canViewBooks();
                break;
                
            case 'read_books':
                $hasPermission = $user->canReadBooks();
                break;
                
            case 'download_books':
                $hasPermission = $user->canDownloadBooks();
                break;
                
            case 'create_books':
                $hasPermission = $user->canCreateBooks();
                break;
                
            case 'edit_books':
                // For edit permission, we need to check if it's their own book or if they're admin
                if ($request->route('id') || $request->route('book')) {
                    $bookId = $request->route('id') ?? $request->route('book');
                    $book = \App\Models\Book::find($bookId);
                    if ($book) {
                        $hasPermission = $user->canEditBook($book);
                    } else {
                        $hasPermission = $user->canCreateBooks(); // If book doesn't exist, check if they can create
                    }
                } else {
                    $hasPermission = $user->canCreateBooks();
                }
                break;
                
            case 'delete_books':
                // For delete permission, we need to check if it's their own book or if they're admin
                if ($request->route('id') || $request->route('book')) {
                    $bookId = $request->route('id') ?? $request->route('book');
                    $book = \App\Models\Book::find($bookId);
                    if ($book) {
                        $hasPermission = $user->canDeleteBook($book);
                    } else {
                        $hasPermission = false;
                    }
                } else {
                    $hasPermission = false;
                }
                break;
                
            case 'manage_categories':
                $hasPermission = $user->canManageCategories();
                break;
                
            default:
                $hasPermission = false;
                break;
        }

        if ($hasPermission) {
            return $next($request);
        } else {
            return redirect()->route('home')->with('error', 'Access Denied! You do not have permission to perform this action.');
        }
    }
}
