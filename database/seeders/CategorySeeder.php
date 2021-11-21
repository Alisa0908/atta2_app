<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Category;

class CategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Category::create(['name' => '現金']);
        Category::create(['name' => '有価証券類']);
        Category::create(['name' => 'かばん類']);
        Category::create(['name' => '著作品類']);
        Category::create(['name' => '袋 ･ 封筒類']);
        Category::create(['name' => '手帳 ･ 文具類']);
        Category::create(['name' => '財布類']);
        Category::create(['name' => '書類 ･ 紙類']);
        Category::create(['name' => 'カードケース類']);
        Category::create(['name' => '小包 ･ 箱類']);
        Category::create(['name' => 'カメラ類']);
        Category::create(['name' => '衣類 ･ 履物類']);
        Category::create(['name' => '時計類']);
        Category::create(['name' => 'かさ類']);
        Category::create(['name' => 'めがね類']);
        Category::create(['name' => '鍵類']);
        Category::create(['name' => '電気製品類']);
        Category::create(['name' => '生活用品類']);
        Category::create(['name' => '携帯電話類']);
        Category::create(['name' => '医療 ･ 化粧品類']);
        Category::create(['name' => '貴金属類']);
        Category::create(['name' => '食料品類']);
        Category::create(['name' => '趣味 ･ 娯楽用品類']);
        Category::create(['name' => '動植物類']);
        Category::create(['name' => '証明書類']);
        Category::create(['name' => 'その他']);
    }
}
