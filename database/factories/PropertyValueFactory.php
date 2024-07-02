<?php

namespace Database\Factories;

use App\Models\PropertyValue;
use Illuminate\Database\Eloquent\Factories\Factory;

class PropertyValueFactory extends Factory
{
    protected $model = PropertyValue::class;

    public function withProperty($property)
    {
        return $this->state(function (array $attributes) use ($property) {
            $value = match ($property->name) {
                'color' => fake()->colorName(),
                'length', 'weight' => fake()->numberBetween(100, 1000),
                default => fake()->word(),
            };
            return [
                'property_id' => $property->id,
                'value' => $value,
            ];
        });

    }

    public function definition(): array
    {
        return [

        ];
    }
}
