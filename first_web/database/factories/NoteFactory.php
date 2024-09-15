<?php

namespace Database\Factories;

use App\Models\Book;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Note>
 */
class NoteFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {

        $user = User::inRandomOrder()->first();
        $book = Book::inRandomOrder()->first();

        while ($book->reports()->where('user_id', $user->id)->exists()) {
            $user = User::inRandomOrder()->first();
            $book = Book::inRandomOrder()->first();
        }

        return [
            'user_id'=>User::all()->random()->id,
            'book_id'=>$book->id,
            'page_num'=>fake()->numberBetween(1,$book->total_pages),
            'body'=>fake()->text(100),
            'color'=>fake()->numberBetween(1,4),

        ];
    }

}
