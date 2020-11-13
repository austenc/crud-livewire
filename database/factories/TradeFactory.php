<?php

namespace Database\Factories;

use App\Models\Trade;
use Illuminate\Database\Eloquent\Factories\Factory;

class TradeFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Trade::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'symbol' => $this->faker->lexify('????'),
            'size' => $this->faker->numberBetween(10, 1000),
            'entry_price' => $this->faker->numberBetween(10, 10000),
            'entry_at' => $this->faker->dateTimeInInterval('-5 years', '5 years'),
        ];
    }

    public function exited()
    {
        return $this->state(fn (array $attributes) => [
            'exit_price' => $this->faker->numberBetween(10, 10000),
            'exit_at' => $this->faker->dateTimeInInterval('-1 month', '1 month')
        ]);
    }

    public function short()
    {
        return $this->state(fn ($attributes) => ['side' => 'short']);
    }
}
