<?php

namespace App\Http\Controllers;

use App\Models\Book;
use App\Models\Category;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class AdminController extends Controller
{
public function dashboard() {
        $users = User::all();
        $books = Book::all();
        $categories = Category::all();

        return view('admin.dashboard', compact('users', 'books','categories'));
    }

    public function editUser(User $user) {
        return view('admin.editUser', compact('user'));
    }

    public function updateUser(Request $request, User $user) {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email',
            'role' => 'required|in:user,author,admin'
        ]);
        
        $oldRole = $user->role;
        $user->update($request->all());
        
        if ($oldRole !== $user->role) {
            Log::alert('User role changed', [
                'admin_id' => Auth::id(),
                'user_id' => $user->id,
                'old_role' => $oldRole,
                'new_role' => $user->role,
                'ip' => request()->ip()
            ]);
        }
        
        Log::info('User updated by admin', [
            'admin_id' => Auth::id(),
            'user_id' => $user->id,
            'ip' => request()->ip()
        ]);
        
        return redirect()->route('dashboard')->with('success', 'User updated!');
    }

    public function destroyUser(User $user) {
        Log::alert('User deleted by admin', [
            'admin_id' => Auth::id(),
            'deleted_user_id' => $user->id,
            'deleted_user_email' => $user->email,
            'ip' => request()->ip()
        ]);
        
        $user->delete();
        return back()->with('success', 'User deleted!');
    }


    public function approveAuthor($id)
{
    $user = User::findOrFail($id);
    $user->role = 'author';
    $user->save();

    // Mark all AuthorRequestNotification notifications for this user as read
    DB::table('notifications')
        ->where('type', 'App\Notifications\AuthorRequestNotification')
        ->whereJsonContains('data', ['user_id' => $user->id])
        ->whereNull('read_at')
        ->update(['read_at' => now()]);

    Log::alert('Author request approved', [
        'admin_id' => Auth::id(),
        'user_id' => $user->id,
        'user_email' => $user->email,
        'ip' => request()->ip()
    ]);

    return back()->with('success', 'User is now an Author!');
}

public function rejectAuthor($id)
{
    $user = User::findOrFail($id);

    // Mark all AuthorRequestNotification notifications for this user as read
    DB::table('notifications')
        ->where('type', 'App\Notifications\AuthorRequestNotification')
        ->whereJsonContains('data', ['user_id' => $user->id])
        ->whereNull('read_at')
        ->update(['read_at' => now()]);

    Log::info('Author request rejected', [
        'admin_id' => Auth::id(),
        'user_id' => $user->id,
        'user_email' => $user->email,
        'ip' => request()->ip()
    ]);

    return back()->with('info', 'Author request rejected.');
}

public function notifications()
{
    $user = Auth::user();
    $notifications = $user->notifications;
    return view('admin.notifications', compact('notifications'));
}

public function markNotificationAsRead($id)
{
    if ($id === 'all') {
        // Mark all unread notifications as read
        Auth::user()->unreadNotifications->each(function ($notification) {
            $notification->markAsRead();
        });
        return back()->with('success', 'All notifications marked as read');
    }
    
    $notification = Auth::user()->unreadNotifications->where('id', $id)->first();
    if ($notification) {
        $notification->markAsRead();
    }
    
    return back()->with('success', 'Notification marked as read');
}

public function deleteNotification($id)
{
    $notification = Auth::user()->unreadNotifications->where('id', $id)->first();
    if ($notification) {
        $notification->delete();
    }
    
    return back()->with('success', 'Notification deleted');
}

}
