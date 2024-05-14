<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Spatie\Image\Manipulations;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;
use Spatie\MediaLibrary\MediaCollections\Models\Media;
use Spatie\Sluggable\HasSlug;
use Spatie\Sluggable\SlugOptions;

class Galeri extends Model implements HasMedia
{
    use InteractsWithMedia,HasSlug;
//    use NodeTrait;
    public $table = 'galeri';

    public $fillable = [
        'title',
        'content',
        'users_created_id',
        'users_updated_id',
        'slug',
        'event_date'
    ];

    protected $casts = [
        'title' => 'string',
        'content' => 'string',
        'slug' => 'string',
        'event_date' => 'date'
    ];

    public static array $rules = [
        'title' => 'required|string|max:255',
        'content' => 'required|string',
        'created_at' => 'nullable',
        'updated_at' => 'nullable',
        'deleted_at' => 'nullable',
        'users_created_id' => 'required',
        'users_updated_id' => 'required',
        'slug' => 'nullable|string|max:255',
        'event_date' => 'nullable'
    ];

    public function usersUpdated(): \Illuminate\Database\Eloquent\Relations\BelongsTo
    {
        return $this->belongsTo(\App\Models\User::class, 'users_updated_id');
    }

    public function usersCreated(): \Illuminate\Database\Eloquent\Relations\BelongsTo
    {
        return $this->belongsTo(\App\Models\User::class, 'users_created_id');
    }
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
}
