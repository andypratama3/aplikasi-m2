<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Spatie\MediaLibrary\InteractsWithMedia;
use Spatie\MediaLibrary\HasMedia;

class SlideSop extends Model implements HasMedia
{
    use InteractsWithMedia;

    public $table = 'slide_sop';

    public $fillable = [
        'halaman',
        'description'
    ];

    protected $casts = [
        'description' => 'string'
    ];

    public static array $rules = [
        'halaman' => 'required',
        'description' => 'nullable|string|max:255',
        'created_at' => 'nullable',
        'updated_at' => 'nullable',
        'deleted_at' => 'nullable'
    ];

}
