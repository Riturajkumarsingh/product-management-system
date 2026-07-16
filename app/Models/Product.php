<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Product extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<string>
     */
    protected $fillable = [
        'name',
        'product_code',
        'category',
        'description',
        'price',
        'quantity',
        'status',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'price'    => 'decimal:2',
        'quantity' => 'integer',
    ];

    /**
     * Get all images belonging to this product.
     */
    public function images(): HasMany
    {
        return $this->hasMany(ProductImage::class);
    }

    /**
     * Get the first/primary image for this product.
     */
    public function primaryImage(): ?ProductImage
    {
        return $this->images()->first();
    }

    /**
     * Get human-readable status label.
     */
    public function getStatusLabelAttribute(): string
    {
        return ucfirst($this->status);
    }

    /**
     * Get Bootstrap badge class for status.
     */
    public function getStatusBadgeAttribute(): string
    {
        return $this->status === 'active' ? 'success' : 'danger';
    }
}
