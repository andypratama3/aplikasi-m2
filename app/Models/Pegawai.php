<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Pegawai extends Model
{
    public $table = 'pegawai';

    public $fillable = [
        'nip',
        'tanggal_masuk',
        'date_of_birth',
        'place_of_birth',
        'jenis_kelamin',
        'address',
        'user_id',
        'pangkat_id',
        'pangkat_golongan_id',
        'perangkat_daerah_id',
    ];

    protected $casts = [
        'nip' => 'string',
        'tanggal_masuk' => 'date',
        'date_of_birth' => 'date',
        'place_of_birth' => 'string',
        'address' => 'string'
    ];

    public static array $rules = [
        'nip' => 'required|string|max:45|unique:pegawai,nip',
        'tanggal_masuk' => 'nullable',
        'date_of_birth' => 'nullable',
        'place_of_birth' => 'nullable|string|max:255',
        'address' => 'nullable|string|max:255',
        'created_at' => 'nullable',
        'updated_at' => 'nullable',
        'deleted_at' => 'nullable',
        'user_id' => 'required',
        'pangkat_id' => '',
        'pangkat_golongan_id' => '',
        'perangkat_daerah_id' => '',
    ];

    public function user(): \Illuminate\Database\Eloquent\Relations\BelongsTo
    {
        return $this->belongsTo(\App\Models\User::class, 'user_id');
    }

    public function pangkat(): \Illuminate\Database\Eloquent\Relations\BelongsTo
    {
        return $this->belongsTo(\App\Models\Pangkat::class, 'pangkat_id');
    }
    public function pangkatGolongan(): \Illuminate\Database\Eloquent\Relations\BelongsTo
    {
        return $this->belongsTo(\App\Models\PangkatGolongan::class, 'pangkat_golongan_id');
    }

    public function pendaftaranMutasis(): \Illuminate\Database\Eloquent\Relations\HasMany
    {
        return $this->hasMany(\App\Models\PendaftaranMutasi::class, 'pegawai_id');
    }

    public function perangkatDaerah(): \Illuminate\Database\Eloquent\Relations\BelongsTo
    {
        return $this->belongsTo(\App\Models\PerangkatDaerah::class, 'perangkat_daerah_id');
    }

    public function sarans(): \Illuminate\Database\Eloquent\Relations\HasMany
    {
        return $this->hasMany(\App\Models\Saran::class, 'pegawai_id');
    }
}
