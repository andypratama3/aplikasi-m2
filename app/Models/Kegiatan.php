<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Spatie\Image\Manipulations;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;
use Spatie\MediaLibrary\MediaCollections\Models\Media;
use Spatie\Sluggable\HasSlug;
use Spatie\Sluggable\SlugOptions;

class Kegiatan extends Model implements HasMedia
{
    use InteractsWithMedia,HasSlug;
    public $table = 'kegiatan';

    public $fillable = [
        'title',
        'content',
        'users_created_id',
        'users_updated_id',
        'slug',
        'schedule_date',
        'schedule_time',
        'tipe_acara',
        'location'
    ];

    protected $casts = [
        'title' => 'string',
        'content' => 'string',
        'slug' => 'string',
        'schedule_date' => 'date',
        'tipe_acara' => 'string',
        'location' => 'string'
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
        'schedule_date' => 'required',
        'schedule_time' => 'required',
        'tipe_acara' => 'nullable|string|max:255',
        'location' => 'nullable|string|max:65535'
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
