<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Reseller extends Model
{
    protected $fillable = [
        'user_id',
        'nama_lengkap',
        'prodi',
        'whatsapp',
        'foto',
        'bio',
        'instagram',
        'tiktok',
    ];

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function products(): HasMany
    {
        return $this->hasMany(Product::class);
    }
    public function getFotoUrlAttribute(): ?string
    {
        if (! $this->foto) {
            return null;
        }


        if (str_starts_with($this->foto, 'images/')) {
            return asset($this->foto);
        }


        return asset('storage/' . $this->foto);
    }
}
