<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Spatie\Image\Manipulations;
use Spatie\MediaLibrary\MediaCollections\Models\Media;
use Spatie\Sluggable\HasSlug;
use Spatie\Sluggable\SlugOptions;

class Agenda extends Model
{
    use HasSlug,SoftDeletes;
    public $table = 'agenda';

    public $fillable = [
        'title',
        'content',
        'users_created_id',
        'users_updated_id',
        'slug',
        'schedule_date',
        'schedule_time',
        'pelaksana',
        'tipe_acara',
        'partisipasi',
        'location',
        'agenda_category_id'
    ];

    protected $casts = [
        'title' => 'string',
        'content' => 'string',
        'slug' => 'string',
        'schedule_date' => 'date',
        'pelaksana' => 'string',
        'tipe_acara' => 'string',
        'partisipasi' => 'string',
        'location' => 'string'
    ];

    public static array $rules = [
        'title' => 'required|string|max:255',
        'content' => 'required|string',
        'created_at' => 'nullable',
        'updated_at' => 'nullable',
        'deleted_at' => 'nullable',
//        'users_created_id' => 'required',
//        'users_updated_id' => 'required',
        'slug' => 'nullable|string|max:255',
        'schedule_date' => 'required',
        'schedule_time' => 'required',
        'pelaksana' => 'nullable|string|max:255',
        'tipe_acara' => 'nullable|string|max:255',
        'partisipasi' => 'nullable|string|max:65535',
        'location' => 'nullable|string|max:65535',
        'agenda_category_id' => 'required'
    ];
    public function getSlugOptions() : SlugOptions
    {
        return SlugOptions::create()
            ->generateSlugsFrom('title')
            ->saveSlugsTo('slug');
    }

    public function agendaCategory(): \Illuminate\Database\Eloquent\Relations\BelongsTo
    {
        return $this->belongsTo(\App\Models\AgendaCategory::class, 'agenda_category_id');
    }

    public function usersUpdated(): \Illuminate\Database\Eloquent\Relations\BelongsTo
    {
        return $this->belongsTo(\App\Models\User::class, 'users_updated_id');
    }

    public function usersCreated(): \Illuminate\Database\Eloquent\Relations\BelongsTo
    {
        return $this->belongsTo(\App\Models\User::class, 'users_created_id');
    }
}
