<?php

namespace Database\Seeders;

use App\Models\Book;
use App\Models\Category;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class CategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Category::factory()->count(10)->create();

        foreach (Category::all() as $category) {
            $books = DB::table('books')->inRandomOrder()->take(rand(1, 3))->pluck('id');
            $category->books()->attach($books);
        }
    }
}
