<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use App\Models\{Brand, Category, Product, ProductPropertyValue, ProductType, PropertyValue};
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class DatabaseSeeder extends Seeder
{
    protected array $properties = [
        'color',
        'material',
        'weight',
        'length',
        'type'
    ];

    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        Brand::factory(10)->create();

        Category::factory()->count(5)->make()->each(function ($category) {
            $category->save();
            Product::factory()->count(10)->make()->each(function ($product) use ($category) {
                $product->category()->associate($category);
                $product->save();
                ProductType::factory()->count(5)->make()->each(function ($productType) use ($product) {
                    $productType->product()->associate($product);
                    $productType->save();
                });
            });
        });

        foreach ($this->properties as $property) {
            DB::table('properties')->insert(['name' => $property]);
        }

        DB::table('properties')->get()->each(function ($property) {
            PropertyValue::factory()->count(10)->withProperty($property)->create();
        });

        ProductPropertyValue::factory(400)->create();
    }

}
