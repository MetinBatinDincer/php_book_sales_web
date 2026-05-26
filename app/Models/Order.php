<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'total_amount',
        'wallet_used',
        'card_paid',
        'shipping_address',
        'status',
    ];

    protected function casts(): array
    {
        return [
            'total_amount' => 'decimal:2',
            'wallet_used' => 'decimal:2',
            'card_paid' => 'decimal:2',
        ];
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function items()
    {
        return $this->hasMany(OrderItem::class);
    }

    public function canBeCancelledByUser(): bool
    {
        return $this->status === 'pending';
    }

    public function canBeConfirmedByUser(): bool
    {
        return $this->status === 'delivered';
    }
}

