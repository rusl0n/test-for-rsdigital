<?php

namespace App\Models;

use Illuminate\Database\Eloquent\{Factories\HasFactory, Model, Relations\BelongsTo};
use Illuminate\Support\Facades\DB;

class PropertyValue extends Model
{
    use HasFactory;

    protected $fillable = ['value', 'property_id'];

    public function property(): BelongsTo
    {
        return $this->belongsTo(Property::class);
    }

    public static function getRandomValue(): \Illuminate\Support\Collection
    {
        return DB::table('property_values')->orderByRaw('RAND()')->take(1)->get();
    }
}
