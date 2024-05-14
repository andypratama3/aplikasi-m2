<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;
use Spatie\Sluggable\HasSlug;
use Spatie\Sluggable\SlugOptions;

class Person extends Model implements HasMedia
{
    use InteractsWithMedia,HasSlug;
    public $table = 'person';

    public $fillable = [
        'name',
        'date_of_birth',
        'place_of_birth',
        'address',
        'pendidikan_id',
        'slug',
        'foto',
        'jabatan_id',
        'pangkat_golongan_id',
        'bidang_id'
    ];

    protected $casts = [
        'name' => 'string',
        'date_of_birth' => 'date',
        'place_of_birth' => 'string',
        'address' => 'string',
        'slug' => 'string',
        'foto' => 'string'
    ];

    public static array $rules = [
        'name' => 'required|string|max:255',
        'date_of_birth' => 'nullable',
        'place_of_birth' => 'nullable|string|max:255',
        'created_at' => 'nullable',
        'updated_at' => 'nullable',
        'deleted_at' => 'nullable',
        'address' => 'nullable|string|max:255',
        'pendidikan_id' => 'nullable',
        'slug' => 'nullable|string|max:255',
        'foto' => 'nullable|string|max:255',
        'jabatan_id' => 'required',
        'pangkat_golongan_id' => 'required',
        'bidang_id' => 'nullable'
    ];

    public function getSlugOptions() : SlugOptions
    {
        return SlugOptions::create()
            ->generateSlugsFrom('name')
            ->saveSlugsTo('slug');
    }

    public function pangkatGolongan(): \Illuminate\Database\Eloquent\Relations\BelongsTo
    {
        return $this->belongsTo(\App\Models\PangkatGolongan::class, 'pangkat_golongan_id');
    }

    public function jabatan(): \Illuminate\Database\Eloquent\Relations\BelongsTo
    {
        return $this->belongsTo(\App\Models\Jabatan::class, 'jabatan_id');
    }

    public function pendidikan(): \Illuminate\Database\Eloquent\Relations\BelongsTo
    {
        return $this->belongsTo(\App\Models\Pendidikan::class, 'pendidikan_id');
    }

    public function bidang(): \Illuminate\Database\Eloquent\Relations\BelongsTo
    {
        return $this->belongsTo(\App\Models\Bidang::class, 'bidang_id');
    }
}
