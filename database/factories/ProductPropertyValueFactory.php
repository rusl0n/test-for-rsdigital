<?php

namespace Database\Factories;

use App\Models\{ProductType, PropertyValue};
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\ProductPropertyValue>
 */
class ProductPropertyValueFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $propertyValue = PropertyValue::getRandomValue();
        return [
            'product_type_id' => fake()->numberBetween(1, 250),
            'property_id' => $propertyValue[0]->property_id,
            'value_id' => $propertyValue[0]->id,
        ];
    }
}
