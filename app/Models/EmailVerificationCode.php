<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class EmailVerificationCode extends Model
{
    public $timestamps = false;

    protected $fillable = [
        'user_id',
        'code',
        'expires_at',
        'created_at',
    ];

    protected function casts(): array
    {
        return [
            'expires_at' => 'datetime',
            'created_at' => 'datetime',
        ];
    }

    /**
     * Get the user that owns the verification code.
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    /**
     * Check if the code has expired.
     */
    public function isExpired(): bool
    {
        return $this->expires_at->isPast();
    }
}
