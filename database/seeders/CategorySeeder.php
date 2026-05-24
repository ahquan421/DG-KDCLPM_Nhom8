<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Category;
use Illuminate\Support\Str;

class CategorySeeder extends Seeder
{
    public function run()
    {
        $categories = [
            'Tiểu thuyết',
            'Truyện ngắn',
            'Sách giáo khoa',
            'Sách tham khảo',
            'Sách thiếu nhi',
            'Khoa học - Công nghệ',
            'Kinh tế',
            'Tâm lý - Kỹ năng sống',
            'Văn học nước ngoài',
            'Lịch sử - Địa lý'
        ];

        foreach ($categories as $category) {
            Category::updateOrCreate(
                ['slug' => Str::slug($category)],
                ['name' => $category, 'slug' => Str::slug($category)]
            );
        }
    }
}
