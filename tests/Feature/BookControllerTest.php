<?php

namespace Tests\Feature;

use App\Models\Book;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class BookControllerTest extends TestCase
{
    use RefreshDatabase, WithFaker;
    
    /**
     * test user can view all book api.
     * @test
     * @return void
     */
    public function user_can_view_all_books()
    {
        $user = User::factory()->create();
        Book::factory()->count(10)->create();
        $this->actingAs($user);

        $response = $this->get('api/books');

        $response->assertStatus(200)->assertJsonCount(10, 'data');
    }

   /**
     * test guest can view all book api.
     * @test
     * @return void
     */
    public function guest_can_view_all_books()
    {
        Book::factory()->count(10)->create();

        $response = $this->get('api/books');

        $response->assertStatus(200)->assertJsonCount(10, 'data');
    }

    /**
     * test user can view a specific book api.
     * @test
     * @return void
     */
    public function user_can_view_a_book()
    {
        $user = User::factory()->create();
        $books =  Book::factory()->count(10)->create();
        
        $this->actingAs($user);
        
        $response = $this->get('api/books/' . $books->first()->id);

        $response->assertStatus(200)->assertJsonCount(1);
    }

   /**
     * test guest can view a specific book api.
     * @test
     * @return void
     */
    public function guest_can_view_a_book()
    {
        Book::factory()->count(10)->create();
        $books =  Book::factory()->count(10)->create();

        $response = $this->get('api/books/' . $books->first()->id);

        $response->assertStatus(200)->assertJsonCount(1);
    }
}
