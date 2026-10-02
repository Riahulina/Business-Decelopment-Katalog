<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Collaboration extends Model
{
    protected $fillable = [
        'name',
        'description',
        'logo',
        'link',
        'is_active',
    ];

    protected $casts = [
        'is_active' => 'boolean',
    ];
    public function getLogoUrlAttribute(): ?string
    {
        if (! $this->logo) {
            return null;
        }

        if (str_starts_with($this->logo, 'images/')) {
            return asset($this->logo);
        }

        return asset('storage/' . $this->logo);
    }
}
