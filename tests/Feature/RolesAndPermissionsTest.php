<?php

namespace Tests\Feature;

use App\Models\Book;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class RolesAndPermissionsTest extends TestCase
{
    use RefreshDatabase;

    public function test_guest_can_view_books()
    {
        $response = $this->get(route('allBooks'));
        $response->assertStatus(200);
    }

    public function test_guest_cannot_download_books()
    {
        $book = Book::factory()->create();
        
        $response = $this->get(route('downloadBook', $book));
        $response->assertRedirect(route('loginForm'));
    }

    public function test_user_can_download_books()
    {
        $user = User::factory()->create(['role' => 'user']);
        $book = Book::factory()->create();
        
        $response = $this->actingAs($user)->get(route('downloadBook', $book));
        $response->assertStatus(200);
    }

    public function test_author_can_create_books()
    {
        $user = User::factory()->create(['role' => 'author']);
        
        $response = $this->actingAs($user)->get(route('createBook'));
        $response->assertStatus(200);
    }

    public function test_author_can_edit_own_book()
    {
        $author = User::factory()->create(['role' => 'author']);
        $book = Book::factory()->create(['user_id' => $author->id]);
        
        $response = $this->actingAs($author)->get(route('editBook', $book->id));
        $response->assertStatus(200);
    }

    public function test_author_cannot_edit_other_author_book()
    {
        $author1 = User::factory()->create(['role' => 'author']);
        $author2 = User::factory()->create(['role' => 'author']);
        $book = Book::factory()->create(['user_id' => $author1->id]);
        
        $response = $this->actingAs($author2)->get(route('editBook', $book->id));
        $response->assertStatus(403);
    }

    public function test_admin_can_edit_any_book()
    {
        $admin = User::factory()->create(['role' => 'admin']);
        $author = User::factory()->create(['role' => 'author']);
        $book = Book::factory()->create(['user_id' => $author->id]);
        
        $response = $this->actingAs($admin)->get(route('editBook', $book->id));
        $response->assertStatus(200);
    }

    public function test_only_admin_can_manage_categories()
    {
        $user = User::factory()->create(['role' => 'user']);
        $author = User::factory()->create(['role' => 'author']);
        $admin = User::factory()->create(['role' => 'admin']);
        
        // User cannot access category management
        $response = $this->actingAs($user)->get(route('createCategory'));
        $response->assertStatus(403);
        
        // Author cannot access category management
        $response = $this->actingAs($author)->get(route('createCategory'));
        $response->assertStatus(403);
        
        // Admin can access category management
        $response = $this->actingAs($admin)->get(route('createCategory'));
        $response->assertStatus(200);
    }

    public function test_permission_methods_work_correctly()
    {
        $user = User::factory()->create(['role' => 'user']);
        $author = User::factory()->create(['role' => 'author']);
        $admin = User::factory()->create(['role' => 'admin']);
        
        // Test user permissions
        $this->assertTrue($user->canViewBooks());
        $this->assertTrue($user->canReadBooks());
        $this->assertTrue($user->canDownloadBooks());
        $this->assertFalse($user->canCreateBooks());
        $this->assertFalse($user->canManageCategories());
        
        // Test author permissions
        $this->assertTrue($author->canViewBooks());
        $this->assertTrue($author->canReadBooks());
        $this->assertTrue($author->canDownloadBooks());
        $this->assertTrue($author->canCreateBooks());
        $this->assertFalse($author->canManageCategories());
        
        // Test admin permissions
        $this->assertTrue($admin->canViewBooks());
        $this->assertTrue($admin->canReadBooks());
        $this->assertTrue($admin->canDownloadBooks());
        $this->assertTrue($admin->canCreateBooks());
        $this->assertTrue($admin->canManageCategories());
    }

    public function test_book_ownership_permissions()
    {
        $author1 = User::factory()->create(['role' => 'author']);
        $author2 = User::factory()->create(['role' => 'author']);
        $book1 = Book::factory()->create(['user_id' => $author1->id]);
        $book2 = Book::factory()->create(['user_id' => $author2->id]);
        
        // Author can edit their own book
        $this->assertTrue($author1->canEditBook($book1));
        $this->assertTrue($author1->canDeleteBook($book1));
        
        // Author cannot edit other author's book
        $this->assertFalse($author1->canEditBook($book2));
        $this->assertFalse($author1->canDeleteBook($book2));
        
        // Admin can edit any book
        $admin = User::factory()->create(['role' => 'admin']);
        $this->assertTrue($admin->canEditBook($book1));
        $this->assertTrue($admin->canEditBook($book2));
        $this->assertTrue($admin->canDeleteBook($book1));
        $this->assertTrue($admin->canDeleteBook($book2));
    }
}
