<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasOne;

class Rental extends Model
{
    use HasFactory;

    protected $fillable = [
        'code','user_id','product_id','start_date','end_date',
        'duration_days','total_price','deposit','delivery_address',
        'status','notes','admin_notes','handled_by',
    ];

    protected function casts(): array
    {
        return ['start_date' => 'date', 'end_date' => 'date', 'total_price' => 'decimal:2', 'deposit' => 'decimal:2'];
    }

    const STATUS_PENDING   = 'pending';
    const STATUS_CONFIRMED = 'confirmed';
    const STATUS_DELIVERED = 'delivered';
    const STATUS_ACTIVE    = 'active';
    const STATUS_RETURNED  = 'returned';
    const STATUS_CANCELLED = 'cancelled';

    public function user(): BelongsTo    { return $this->belongsTo(User::class); }
    public function product(): BelongsTo { return $this->belongsTo(Product::class); }
    public function handler(): BelongsTo { return $this->belongsTo(User::class, 'handled_by'); }
    public function payment(): HasOne    { return $this->hasOne(Payment::class); }

    public function statusLabel(): string
    {
        return match ($this->status) {
            self::STATUS_PENDING   => 'Menunggu Konfirmasi',
            self::STATUS_CONFIRMED => 'Dikonfirmasi',
            self::STATUS_DELIVERED => 'Sudah Diantar',
            self::STATUS_ACTIVE    => 'Sedang Disewa',
            self::STATUS_RETURNED  => 'Sudah Dikembalikan',
            self::STATUS_CANCELLED => 'Dibatalkan',
            default                => ucfirst($this->status),
        };
    }

    public function statusColor(): string
    {
        return match ($this->status) {
            self::STATUS_PENDING   => 'yellow',
            self::STATUS_CONFIRMED => 'blue',
            self::STATUS_DELIVERED => 'indigo',
            self::STATUS_ACTIVE    => 'green',
            self::STATUS_RETURNED  => 'gray',
            self::STATUS_CANCELLED => 'red',
            default                => 'gray',
        };
    }

    public function isPending(): bool   { return $this->status === self::STATUS_PENDING; }
    public function isActive(): bool    { return $this->status === self::STATUS_ACTIVE; }
    public function isReturned(): bool  { return $this->status === self::STATUS_RETURNED; }
    public function isCancelled(): bool { return $this->status === self::STATUS_CANCELLED; }

    public static function generateCode(): string
    {
        $year  = now()->format('Y');
        $count = self::whereYear('created_at', $year)->count() + 1;
        return 'RENT-' . $year . str_pad($count, 4, '0', STR_PAD_LEFT);
    }
}