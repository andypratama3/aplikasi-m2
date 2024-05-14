<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Spatie\Image\Manipulations;
use Spatie\MediaLibrary\MediaCollections\Models\Media;
use Spatie\Sluggable\HasSlug;
use Spatie\Sluggable\SlugOptions;

class PostCategory extends Model
{
    use HasSlug,SoftDeletes;
    public $table = 'post_category';

    public $fillable = [
        'title',
        'description',
        'slug'
    ];

    protected $casts = [
        'title' => 'string',
        'description' => 'string',
        'slug' => 'string'
    ];

    public static array $rules = [
        'title' => 'nullable|string|max:45',
        'description' => 'nullable|string|max:45',
        'created_at' => 'nullable',
        'updated_at' => 'nullable',
        'deleted_at' => 'nullable',
        'slug' => 'nullable|string|max:255'
    ];

    public function getSlugOptions() : SlugOptions
    {
        return SlugOptions::create()
            ->generateSlugsFrom('title')
            ->saveSlugsTo('slug');
    }

    public function posts(): \Illuminate\Database\Eloquent\Relations\HasMany
    {
        return $this->hasMany(\App\Models\Post::class, 'post_category_id');
    }
}
