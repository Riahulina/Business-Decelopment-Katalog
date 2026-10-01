<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class News extends Model
{
    protected $fillable = [
        'title',
        'slug',
        'category',
        'excerpt',
        'content',
        'quote',
        'quote_author',
        'cover_image',
        'source',
        'attachment',
        'status',
        'published_at',
    ];

    protected $casts = [
        'published_at' => 'datetime',
    ];

    public function scopePublished($query)
    {
        return $query->where('status', 'published');
    }

    /** URL cover, atau null kalau file belum ada (supaya tampil ikon, bukan gambar rusak) */
    public function getCoverUrlAttribute(): ?string
    {
        return self::resolveUrl($this->cover_image);
    }

    public function getAttachmentUrlAttribute(): ?string
    {
        return self::resolveUrl($this->attachment);
    }

    /** Estimasi waktu baca (menit), 200 kata/menit */
    public function getReadingTimeAttribute(): int
    {
        $words = str_word_count(strip_tags((string) $this->content));

        return max(1, (int) ceil($words / 200));
    }

    /**
     * Isi artikel siap tampil.
     * - Kalau sudah HTML (dari RichEditor Filament) -> dipakai apa adanya.
     * - Kalau teks biasa (seperti data seeder) -> dibungkus <p> per paragraf.
     */
    public function getContentHtmlAttribute(): string
    {
        $content = trim((string) $this->content);

        if ($content !== strip_tags($content)) {
            return $content;
        }

        return collect(preg_split('/\R{2,}/', $content))
            ->filter()
            ->map(fn($p) => '<p>' . nl2br(e(trim($p))) . '</p>')
            ->implode('');
    }

    /** Cari file di public/ (seeder) atau storage/ (upload Filament). */
    public static function resolveUrl(?string $path): ?string
    {
        if (blank($path)) {
            return null;
        }

        if (Str::startsWith($path, ['http://', 'https://'])) {
            return $path;
        }

        $path = ltrim($path, '/');

        if (file_exists(public_path($path))) {
            return asset($path);
        }

        $storagePath = Str::after($path, 'storage/');

        if (Storage::disk('public')->exists($storagePath)) {
            return asset('storage/' . $storagePath);
        }

        return null;
    }
}
