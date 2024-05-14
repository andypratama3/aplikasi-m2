<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Spatie\Sluggable\HasSlug;
use Spatie\Sluggable\SlugOptions;

class AgendaCategory extends Model
{
    use HasSlug,SoftDeletes;
    public $table = 'agenda_category';

    public $fillable = [
        'name',
        'description',
        'slug'
    ];

    protected $casts = [
        'name' => 'string',
        'description' => 'string',
        'slug' => 'string'
    ];

    public static array $rules = [
        'name' => 'nullable|string|max:45',
        'description' => 'nullable|string|max:45',
        'created_at' => 'nullable',
        'updated_at' => 'nullable',
        'deleted_at' => 'nullable',
        'slug' => 'nullable|string|max:255'
    ];

    public function getSlugOptions() : SlugOptions
    {
        return SlugOptions::create()
            ->generateSlugsFrom('name')
            ->saveSlugsTo('slug');
    }

    public function agendas(): \Illuminate\Database\Eloquent\Relations\HasMany
    {
        return $this->hasMany(\App\Models\Agenda::class, 'agenda_category_id');
    }
}
