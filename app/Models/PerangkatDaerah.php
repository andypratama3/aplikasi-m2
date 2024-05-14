<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PerangkatDaerah extends Model
{
    public $table = 'perangkat_daerah';

    public $fillable = [
        'nama',
        'alamat',
        'kode'
    ];

    protected $casts = [
        'nama' => 'string',
        'alamat' => 'string',
        'kode' => 'string'
    ];

    public static array $rules = [
        'nama' => 'required|string|max:255',
        'alamat' => 'required|string|max:255',
        'kode' => 'nullable|string|max:255'
    ];

    public function pendaftaranMutasis(): \Illuminate\Database\Eloquent\Relations\HasMany
    {
        return $this->hasMany(\App\Models\PendaftaranMutasi::class, 'tujuan_instansi');
    }

    public function pendaftaranMutasi1s(): \Illuminate\Database\Eloquent\Relations\HasMany
    {
        return $this->hasMany(\App\Models\PendaftaranMutasi::class, 'asal_instansi');
    }
}
