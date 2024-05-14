<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Pangkat extends Model
{
    public $table = 'pangkat';

    public $fillable = [
        'kepangkat_golongan',
        'nama',
        'description'
    ];

    protected $casts = [
        'nama' => 'string',
        'description' => 'string'
    ];

    public static array $rules = [
        'kepangkat_golongan' => 'required',
        'nama' => 'required|string|max:255',
        'created_at' => 'nullable',
        'updated_at' => 'nullable',
        'deleted_at' => 'nullable',
        'description' => 'nullable|string|max:255'
    ];

    public function pegawais(): \Illuminate\Database\Eloquent\Relations\HasMany
    {
        return $this->hasMany(\App\Models\Pegawai::class, 'pangkat_id');
    }
}
