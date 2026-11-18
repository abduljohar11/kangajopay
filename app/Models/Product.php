<?php

namespace App\Models;

use App\Enums\ProductType;
use Illuminate\Database\Eloquent\Attributes\Fillable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Override;

#[Fillable(['name', 'description', 'type', 'is_hidden', 'is_active'])]
class Product extends Model
{
    #[Override]
    protected function casts(): array
    {
        return [
            'type' => ProductType::class,
            'is_hidden' => 'boolean',
            'is_active' => 'boolean',
        ];
    }

    public function category(): BelongsTo
    {
        return $this->belongsTo(Category::class, 'category_id');
    }
    public function mappings(): HasMany
    {
        return $this->hasMany(Mapping::class);
    }
}
