<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Payment extends Model
{
    use HasFactory;

    protected $fillable = ['rental_id','amount','method','status','proof_image','paid_at'];

    protected function casts(): array
    {
        return ['amount' => 'decimal:2', 'paid_at' => 'datetime'];
    }

    public function rental(): BelongsTo { return $this->belongsTo(Rental::class); }

    public function isPaid(): bool { return $this->status === 'paid'; }

    public function methodLabel(): string
    {
        return match ($this->method) {
            'transfer' => 'Transfer Bank',
            'cash'     => 'Tunai',
            'qris'     => 'QRIS',
            default    => ucfirst($this->method),
        };
    }
}