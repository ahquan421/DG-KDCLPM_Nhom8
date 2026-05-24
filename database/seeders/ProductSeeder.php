<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Str;
use App\Models\Product;

class ProductSeeder extends Seeder
{
    public function run(): void
    {
        $products = [
            [
                'name' => 'Harry Potter and the Sorcerer\'s Stone',
                'price' => 150000,
                'quantity' => 10,
                'author' => 'J.K. Rowling',
                'publisher' => 'Bloomsbury',
                'page' => 320,
                'description' => 'A young wizard begins his magical journey.',
                'year_of_publication' => 1997,
                'image' => 'images/book/harry_potter_1.jpg',
                'category_id' => 1,
            ],
            [
                'name' => 'The Hobbit',
                'price' => 120000,
                'quantity' => 15,
                'author' => 'J.R.R. Tolkien',
                'publisher' => 'Allen & Unwin',
                'page' => 310,
                'description' => 'Bilbo Baggins goes on an unexpected adventure.',
                'year_of_publication' => 1937,
                'image' => 'images/book/the_hobbit.jpg',
                'category_id' => 1,
            ],
            [
                'name' => 'Clean Code',
                'price' => 250000,
                'quantity' => 8,
                'author' => 'Robert C. Martin',
                'publisher' => 'Prentice Hall',
                'page' => 464,
                'description' => 'A Handbook of Agile Software Craftsmanship.',
                'year_of_publication' => 2008,
                'image' => 'images/book/clean_code.jpg',
                'category_id' => 6,
            ],
            [
                'name' => 'One Golden Summer',
                'price' => 200000,
                'quantity' => 10,
                'author' => 'Author 1',
                'publisher' => 'Publisher 1',
                'page' => 320,
                'description' => 'A beautiful story about summer adventures.',
                'year_of_publication' => 2020,
                'image' => 'images/book/28.jpg',
                'category_id' => 2,
            ],
            [
                'name' => 'The Names',
                'price' => 180000,
                'quantity' => 7,
                'author' => 'Author 2',
                'publisher' => 'Publisher 2',
                'page' => 290,
                'description' => 'An intriguing tale about identity and memory.',
                'year_of_publication' => 2018,
                'image' => 'images/book/40.jpg',
                'category_id' => 2,
            ],
            [
                'name' => 'Good Dirt',
                'price' => 220000,
                'quantity' => 5,
                'author' => 'Author 3',
                'publisher' => 'Publisher 3',
                'page' => 310,
                'description' => 'A story connecting humans and nature.',
                'year_of_publication' => 2019,
                'image' => 'images/book/43.jpg',
                'category_id' => 3,
            ],
            [
                'name' => 'Promise Me Sunshine',
                'price' => 190000,
                'quantity' => 8,
                'author' => 'Author 4',
                'publisher' => 'Publisher 4',
                'page' => 280,
                'description' => 'A heartwarming story of hope and friendship.',
                'year_of_publication' => 2021,
                'image' => 'images/book/44.jpg',
                'category_id' => 3,
            ],
            [
                'name' => 'The Missing Half',
                'price' => 210000,
                'quantity' => 6,
                'author' => 'Author 5',
                'publisher' => 'Publisher 5',
                'page' => 330,
                'description' => 'A novel exploring loss and discovery.',
                'year_of_publication' => 2017,
                'image' => 'images/book/45.jpg',
                'category_id' => 4,
            ],
            [
                'name' => '1984',
                'price' => 200000,
                'quantity' => 12,
                'author' => 'George Orwell',
                'publisher' => 'Secker & Warburg',
                'page' => 328,
                'description' => 'Dystopian novel about totalitarianism.',
                'year_of_publication' => 1949,
                'image' => 'images/book/1984.jpg',
                'category_id' => 5,
            ],
        ];

        foreach ($products as $product) {
            Product::create([
                'name' => $product['name'],
                'slug' => Str::slug($product['name']),
                'price' => $product['price'],
                'quantity' => $product['quantity'],
                'author' => $product['author'],
                'publisher' => $product['publisher'],
                'page' => $product['page'],
                'description' => $product['description'],
                'year_of_publication' => $product['year_of_publication'],
                'image' => $product['image'], // Đường dẫn đầy đủ: images/book/...
                'category_id' => $product['category_id'],
            ]);
        }
    }
}
