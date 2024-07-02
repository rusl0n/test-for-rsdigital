<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use App\Models\Property;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Support\{Collection, Facades\DB};
use Lcobucci\JWT\Token\Builder;

class Product extends Model
{
    use HasFactory;

    protected $fillable = ['name'];

    public function category(): BelongsTo
    {
        return $this->belongsTo(Category::class);
    }

    public function brand(): BelongsTo
    {
        return $this->belongsTo(Brand::class);
    }

    public function productTypes(): HasMany
    {
        return $this->hasMany(ProductType::class);
    }

    public function getAllProperties(): array
    {
        return Property::all(['name'])->pluck('name')->toArray();
    }

    public function getAllProductTypes()
    {
        return DB::table('product_types')->get();
    }

    public function searchProduct(array $query)
    {
        $ids = Property::searchPropertiesValue($query);
        return DB::table('product_property_values')
            ->select('product_types.*')
            ->whereIn('product_property_values.value_id', $ids)
            ->leftJoin('product_types', 'product_types.id', '=', 'product_property_values.product_type_id')
            ->get();
    }
}
