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

class Page extends Model implements HasMedia
{
    use InteractsWithMedia;
    use SoftDeletes,HasSlug;
    public $table = 'page';

    public $fillable = [
        'judul',
        'isi',
        'slug',
        'show',
        'custom_url',
        'page_category_id',
        'external_url',
        'parent_page_id',
        'left',
        'right',
        'highlight',
        'order',
        'users_id'
    ];

    protected $casts = [
        'judul' => 'string',
        'isi' => 'string',
        'slug' => 'string',
        'show' => 'string',
        'custom_url' => 'string',
        'external_url' => 'string',
        'highlight' => 'boolean'
    ];

    public static array $rules = [
        'judul' => 'nullable|string|max:255',
        'isi' => 'nullable|string|max:65535',
        'created_at' => 'nullable',
        'updated_at' => 'nullable',
        'deleted_at' => 'nullable',
        'slug' => 'nullable|string|max:255',
        'show' => 'nullable|string|max:255',
        'custom_url' => 'nullable|string|max:255',
        'page_category_id' => 'required',
        'external_url' => 'nullable|string|max:255',
        'parent_page_id' => 'nullable',
        'left' => 'nullable',
        'right' => 'nullable',
        'highlight' => 'nullable|boolean',
        'order' => 'nullable',
        'users_id' => 'required'
    ];

    public function getLftName()
    {
        return 'left';
    }
    public function getRgtName()
    {
        return 'right';
    }
    public function getParentIdName()
    {
        return 'bidang_id';
    }

// Specify parent id attribute mutator
    public function setBidangIdAttribute($value)
    {
        $this->setParentIdAttribute($value);
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
    public function getSlugOptions() : SlugOptions
    {
        return SlugOptions::create()
            ->generateSlugsFrom('judul')
            ->saveSlugsTo('slug');
    }

    public function users(): \Illuminate\Database\Eloquent\Relations\BelongsTo
    {
        return $this->belongsTo(\App\Models\User::class, 'users_id');
    }

    public function pageCategory(): \Illuminate\Database\Eloquent\Relations\BelongsTo
    {
        return $this->belongsTo(\App\Models\PageCategory::class, 'page_category_id');
    }
}
