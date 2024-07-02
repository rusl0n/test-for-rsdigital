<?php

namespace App\Models;

use Illuminate\Database\Eloquent\{Factories\HasFactory, Model, Relations\HasMany};
use Illuminate\Support\Facades\DB;

class Property extends Model
{
    use HasFactory;

    protected $fillable = ['name'];

    public function values(): HasMany
    {
        return $this->hasMany(PropertyValue::class);
    }

    public static function searchPropertiesValue($query): array
    {
        $valueIds = [];
        foreach ($query as $property => $value) {
            $ids = DB::table('property_values')
                ->rightJoin('properties', 'properties.id', '=', 'property_values.property_id')
                ->where('properties.name', '=', $property)
                ->where('property_values.value', '=', $value)
                ->get('property_values.id')
                ->toArray()[0]->id;
            $valueIds[] = $ids;
        }
        return $valueIds;

    }

}
