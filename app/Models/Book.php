<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Book extends Model
{
    use HasFactory;

    protected $fillable = [
        'category_id',
        'title',
        'author',
        'publisher',
        'publication_year',
        'description',
        'cover_image_data', 
        'original_cover_name',
        'pdf_file_path',
        'original_pdf_name',
        'pages',
    ];

    protected $casts = [
        'pages' => 'array',
    ];

    // Relasi ke kategori
    public function category(): BelongsTo
    {
        return $this->belongsTo(Category::class);
    }

    // Relasi ke user yang memfavoritkan buku ini
    public function favoritedBy(): BelongsToMany
    {
        return $this->belongsToMany(User::class, 'favorites', 'book_id', 'user_id')->withTimestamps();
    }

    // Relasi ke riwayat download
    public function downloads(): HasMany
    {
        return $this->hasMany(Download::class);
    }

    // Akses URL untuk cover image
    public function getCoverImageUrlAttribute(): string
    {
        return $this->cover_image_data
            ? asset('storage/covers/' . $this->cover_image_data)
            : asset('images/book.png');
    }

    // Akses URL untuk PDF file (optional, jika diperlukan)
    public function getPdfUrlAttribute(): ?string
    {
        return $this->pdf_file_path
            ? asset('storage/pdfs/' . $this->pdf_file_path)
            : null;
    }
}
