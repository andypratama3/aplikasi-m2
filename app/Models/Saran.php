<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Saran extends Model
{
    public $table = 'saran';

    public $fillable = [
        'pegawai_id',
        'judul',
        'isi'
    ];

    protected $casts = [
        'judul' => 'string',
        'isi' => 'string'
    ];

    public static array $rules = [
        'pegawai_id' => 'required',
        'judul' => 'nullable|string|max:255',
        'isi' => 'nullable|string|max:65535',
        'created_at' => 'nullable',
        'updated_at' => 'nullable',
        'deleted_at' => 'nullable'
    ];

    public function pegawai(): \Illuminate\Database\Eloquent\Relations\BelongsTo
    {
        return $this->belongsTo(\App\Models\Pegawai::class, 'pegawai_id');
    }
}
