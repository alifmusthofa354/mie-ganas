<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class Category extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'slug',
        'description',
        'icon',
        'display_order',
        'is_active',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected function casts(): array
    {
        return [
            'is_active' => 'boolean',
            'display_order' => 'integer',
        ];
    }

    /**
     * Boot the model and attach event listeners.
     */
    protected static function boot(): void
    {
        parent::boot();

        // Sanitize data before saving
        static::saving(function ($category) {
            if ($category->name) {
                $category->name = strip_tags($category->name);
            }
            if ($category->description) {
                $category->description = strip_tags($category->description);
            }
            if ($category->icon) {
                $category->icon = strip_tags($category->icon);
            }
        });

        // Generate slug if it doesn't exist
        static::saving(function ($category) {
            if ($category->name && !$category->slug) {
                $category->slug = Str::slug($category->name);
            }
        });
    }

}