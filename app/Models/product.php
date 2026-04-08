<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Product extends Model
{
    use HasFactory;

    protected $fillable = [
        'category_id','name','slug','description','brand',
        'image','price_per_day','stock','min_age_month','max_age_month','is_available',
    ];

    protected function casts(): array
    {
        return ['price_per_day' => 'decimal:2', 'is_available' => 'boolean'];
    }

    public function category(): BelongsTo { return $this->belongsTo(Category::class); }
    public function rentals(): HasMany    { return $this->hasMany(Rental::class); }

    public function priceFor(int $days): float { return $this->price_per_day * $days; }

    public function ageRangeLabel(): string
    {
        if (!$this->min_age_month && !$this->max_age_month) return 'Semua usia';
        $min = $this->min_age_month ?? 0;
        return $this->max_age_month ? "{$min}–{$this->max_age_month} bulan" : "≥ {$min} bulan";
    }
}