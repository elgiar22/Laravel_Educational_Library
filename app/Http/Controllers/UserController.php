<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Notifications\AuthorRequestNotification;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;

class UserController extends Controller
{
   public function requestAuthor()
{
    $user = Auth::user();

    if ($user->role !== 'user') {
        Log::warning('Unauthorized author request attempt', [
            'user_id' => $user->id,
            'user_role' => $user->role,
            'ip' => request()->ip()
        ]);
        return back()->with('error', 'Only normal users can request author role.');
    }

    // Check if there's already an unread notification for this user by checking admin notifications
    $admins = User::where('role', 'admin')->get();
    $hasPendingRequest = false;
    
    foreach ($admins as $admin) {
        $existingNotification = DB::table('notifications')
            ->where('notifiable_id', $admin->id)
            ->where('type', 'App\Notifications\AuthorRequestNotification')
            ->whereJsonContains('data', ['user_id' => $user->id])
            ->whereNull('read_at')
            ->first();
            
        if ($existingNotification) {
            $hasPendingRequest = true;
            break;
        }
    }

    if ($hasPendingRequest) {
        Log::info('Duplicate author request prevented', [
            'user_id' => $user->id,
            'ip' => request()->ip()
        ]);
        return back()->with('info', 'You already have a pending author request. Please wait for admin approval.');
    }

    // Notify all admins
    $admins = User::where('role', 'admin')->get();
    foreach ($admins as $admin) {
        $admin->notify(new AuthorRequestNotification($user));
    }

    Log::info('Author request submitted', [
        'user_id' => $user->id,
        'user_email' => $user->email,
        'admins_notified' => $admins->count(),
        'ip' => request()->ip()
    ]);

    return back()->with('success', 'Your request has been sent to admin.');
}

}
