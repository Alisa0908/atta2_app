<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Item;
use App\Models\Category;
use App\Models\User;
use Carbon\Carbon;

class ItemSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $users = User::take(5)->get();

        foreach ($users as $user) {
            Item::create([
                'user_id' => $user->id,
                'category_id' => Category::inRandomOrder()->first()->id,
                'feature' => '黒色, ファミマのかさらしきもの',
                'lost_desc' => '盛岡駅前',
                'created_at' => Carbon::yesterday()->toDateString(),
            ]);
            Item::create([
                'user_id' => $user->id,
                'category_id' => Category::inRandomOrder()->first()->id,
                'feature' => '灰色のウォークマン',
                'lost_desc' => '焼走り',
                'created_at' => Carbon::yesterday()->subDays(8)->toDateString(),
            ]);
            Item::create([
                'user_id' => $user->id,
                'category_id' => Category::inRandomOrder()->first()->id,
                'feature' => '片耳のAirpods',
                'lost_desc' => '大更公園',
                'created_at' => Carbon::yesterday()->subDays(5)->toDateString(),
            ]);
            Item::create([
                'user_id' => $user->id,
                'category_id' => Category::inRandomOrder()->first()->id,
                'feature' => 'MacbookPro',
                'lost_desc' => '盛岡駅の待合室',
                'created_at' => Carbon::yesterday()->subDays(3)->toDateString(),
            ]);
        }
    }
}
