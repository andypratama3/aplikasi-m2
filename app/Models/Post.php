<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Spatie\Image\Manipulations;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;
use Spatie\MediaLibrary\MediaCollections\Models\Media;
use Spatie\Sluggable\HasSlug;
use Spatie\Sluggable\SlugOptions;

class Post extends Model implements HasMedia
{
    use InteractsWithMedia;
    use SoftDeletes,HasSlug;
    public $table = 'post';

    public $fillable = [
        'title',
        'content',
        'slug',
        'post_category_id',
        'image_caption',
        'highlight',
        'users_id'
    ];

    protected $casts = [
        'title' => 'string',
        'content' => 'string',
        'slug' => 'string',
        'image_caption' => 'string',
        'highlight' => 'boolean'
    ];

    public static array $rules = [
        'title' => 'nullable|string|max:255',
        'content' => 'nullable|string|max:65535',
        'slug' => 'nullable|string|max:255',
        'created_at' => 'nullable',
        'updated_at' => 'nullable',
        'deleted_at' => 'nullable',
        'post_category_id' => 'required',
        'image_caption' => 'nullable|string|max:255',
        'highlight' => 'nullable|boolean',
        'users_id' => 'required'
    ];

    public function getSlugOptions() : SlugOptions
    {
        return SlugOptions::create()
            ->generateSlugsFrom('title')
            ->saveSlugsTo('slug');
    }

    public function registerMediaConversions(Media $media = null): void
    {
        $this
            ->addMediaConversion('preview')
            ->fit(Manipulations::FIT_CROP, 300, 300)
            ->nonQueued();

        $this->addMediaConversion('thumb')
            ->width(368)
            ->height(232)
            ->sharpen(10);

        $this->addMediaConversion('cover')
            ->width(2400)
            ->height(1800);
    }

    public function users(): \Illuminate\Database\Eloquent\Relations\BelongsTo
    {
        return $this->belongsTo(\App\Models\User::class, 'users_id');
    }

    public function postCategory(): \Illuminate\Database\Eloquent\Relations\BelongsTo
    {
        return $this->belongsTo(\App\Models\PostCategory::class, 'post_category_id');
    }
}
