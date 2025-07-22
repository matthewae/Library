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
        'pdf_file_data',
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
        if ($this->cover_image_data) {
            return 'data:image/jpeg;base64,' . $this->cover_image_data;
        }
        return asset('images/book.png'); // Default image if no cover
    }

    public function setCoverImageDataAttribute($value)
    {
        if ($value && !str_starts_with($value, 'data:image')) {
            $this->attributes['cover_image_data'] = base64_encode($value);
        } else {
            $this->attributes['cover_image_data'] = $value;
        }
    }

    public function setPdfFileDataAttribute($value)
    {
        if ($value && !str_starts_with($value, '%PDF-')) {
            $this->attributes['pdf_file_data'] = base64_encode($value);
        } else {
            $this->attributes['pdf_file_data'] = $value;
        }
    }
}
