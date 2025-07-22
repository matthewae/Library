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
        'cover_image_path',
        'pdf_file_path',
        'original_pdf_name',
        'pages',
    ];

    protected $casts = [
        'pages' => 'array',
    ];

    public function category(): BelongsTo
    {
        return $this->belongsTo(Category::class);
    }

    public function favoritedBy(): BelongsToMany
    {
        return $this->belongsToMany(User::class, 'favorites', 'book_id', 'user_id')->withTimestamps();
    }

    public function downloads(): HasMany
    {
        return $this->hasMany(Download::class);
    }

    public function getCoverImageUrlAttribute(): string
    {
        return asset('storage/' . $this->cover_image_path);
    }
}
