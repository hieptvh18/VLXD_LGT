<?php

namespace Database\Factories;

use App\Enums\NewsStatusEnum;
use App\Models\News;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\News>
 */
class NewsFactory extends Factory
{
    protected $model = News::class;
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'title' => $this->faker->sentence(),
            'slug' => $this->faker->slug(),
            'short_desc' => $this->faker->text(),
            'content' => $this->faker->text(),
            'source' => $this->faker->name, // ghi nguon
            'is_featured' => $this->faker->boolean(),
            'status' => NewsStatusEnum::PUBLISH,
        ];
    }
}
