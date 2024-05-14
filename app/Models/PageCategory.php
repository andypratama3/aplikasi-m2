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

class PageCategory extends Model implements HasMedia
{
    use InteractsWithMedia;
    use SoftDeletes,HasSlug;
    public $table = 'page_category';

    public $fillable = [
        'name',
        'keterangan',
        'custom_url',
        'parent_page_category_id',
        'slug',
        'external_url',
        'order'
    ];

    protected $casts = [
        'name' => 'string',
        'keterangan' => 'string',
        'custom_url' => 'string',
        'slug' => 'string',
        'external_url' => 'string'
    ];

    public static array $rules = [
        'name' => 'nullable|string|max:255',
        'keterangan' => 'nullable|string',
        'created_at' => 'nullable',
        'updated_at' => 'nullable',
        'deleted_at' => 'nullable',
        'custom_url' => 'nullable|string|max:255',
        'parent_page_category_id' => 'nullable',
        'slug' => 'nullable|string|max:255',
        'external_url' => 'nullable|string|max:255',
        'order' => 'nullable'
    ];

    public function getSlugOptions() : SlugOptions
    {
        return SlugOptions::create()
            ->generateSlugsFrom('name')
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

    public function pages(): \Illuminate\Database\Eloquent\Relations\HasMany
    {
        return $this->hasMany(\App\Models\Page::class, 'page_category_id');
    }
}
