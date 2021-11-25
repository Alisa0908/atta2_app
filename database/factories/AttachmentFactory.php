<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\File;
use App\Models\Item;

class AttachmentFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        $width = 100;
        $height = 100;
        $file = $this->faker->image(null, $width, $height);
        $path = Storage::putFile('items', $file);
        File::delete($file);
    
        return [
            'org_name' => basename($file),
            'name' => basename($path),
        ];

    }
}
