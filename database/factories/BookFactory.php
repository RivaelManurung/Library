<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\Category; // Adjust if necessary
use Faker\Factory as Faker;

class BookFactory extends Factory
{
    protected $model = \App\Models\Book::class;

    public function definition()
    {
        $faker = Faker::create();

        return [
            'title' => $faker->sentence,
            'description' => $faker->paragraph,
            'quantity' => $faker->numberBetween(1, 100),
            'cover_path' => $faker->imageUrl(640, 480, 'books', true, 'Faker'), // Placeholder image URL
            'file_path' => $faker->filePath(), // Placeholder file URL
            'categories_id' => Category::inRandomOrder()->first()->id, // Assuming you have categories seeded
        ];
    }
}
