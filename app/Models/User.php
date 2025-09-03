<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    /** @use HasFactory<\Database\Factories\UserFactory> */
    use HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var list<string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
        'role',
    ];

    public function books(){
        return $this->hasMany(Book::class);
    }
    
    /**
     * The attributes that should be hidden for serialization.
     *
     * @var list<string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
        ];
    }

    /**
     * Check if user is a guest (not authenticated)
     */
    public function isGuest(): bool
    {
        return !$this->exists;
    }

    /**
     * Check if user is a regular user
     */
    public function isUser(): bool
    {
        return $this->role === 'user';
    }

    /**
     * Check if user is an author
     */
    public function isAuthor(): bool
    {
        return $this->role === 'author';
    }

    /**
     * Check if user is an admin
     */
    public function isAdmin(): bool
    {
        return $this->role === 'admin';
    }

    /**
     * Check if user can view books (all roles can view)
     */
    public function canViewBooks(): bool
    {
        return true; // All roles can view books
    }

    /**
     * Check if user can read books
     */
    public function canReadBooks(): bool
    {
        return !$this->isGuest();
    }

    /**
     * Check if user can download books
     */
    public function canDownloadBooks(): bool
    {
        return !$this->isGuest();
    }

    /**
     * Check if user can create books
     */
    public function canCreateBooks(): bool
    {
        return $this->isAuthor() || $this->isAdmin();
    }

    /**
     * Check if user can edit a specific book
     */
    public function canEditBook(Book $book): bool
    {
        if ($this->isAdmin()) {
            return true; // Admin can edit any book
        }
        
        if ($this->isAuthor()) {
            return $book->user_id === $this->id; // Author can only edit their own books
        }
        
        return false;
    }

    /**
     * Check if user can delete a specific book
     */
    public function canDeleteBook(Book $book): bool
    {
        if ($this->isAdmin()) {
            return true; // Admin can delete any book
        }
        
        if ($this->isAuthor()) {
            return $book->user_id === $this->id; // Author can only delete their own books
        }
        
        return false;
    }

    /**
     * Check if user can manage categories
     */
    public function canManageCategories(): bool
    {
        return $this->isAdmin();
    }

    

    /**
     * Get user's role display name
     */
    public function getRoleDisplayName(): string
    {
        return match($this->role) {
            'user' => 'User',
            'author' => 'Author',
            'admin' => 'Admin',
            default => 'Unknown'
        };
    }




}
