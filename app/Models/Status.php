<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Status extends Model
{
    public $table = 'status';

    public $fillable = [
        'nama'
    ];

    protected $casts = [
        'nama' => 'string'
    ];

    public static array $rules = [
        'nama' => 'nullable|string|max:45',
        'created_at' => 'nullable',
        'updated_at' => 'nullable',
        'deleted_at' => 'nullable'
    ];

    public function pendaftaranMutasiStatuses(): \Illuminate\Database\Eloquent\Relations\HasMany
    {
        return $this->hasMany(\App\Models\PendaftaranMutasiStatus::class, 'status_mutasi_id');
    }
}
