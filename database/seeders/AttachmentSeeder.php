<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Item;

class AttachmentSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $items = Item::all();
        foreach ($items as $item) {
            \App\Models\Attachment::factory()
                ->state(['item_id' => $item->id])
                ->create();
        }
    }
}
