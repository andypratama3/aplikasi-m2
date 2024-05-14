<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PangkatGolongan extends Model
{
    public $table = 'pangkat_golongan';

    public $fillable = [
        'name',
        'definition'
    ];

    protected $casts = [
        'name' => 'string',
        'definition' => 'string'
    ];

    public static array $rules = [
        'name' => 'required|string|max:255',
        'definition' => 'nullable|string|max:255',
        'created_at' => 'nullable',
        'updated_at' => 'nullable',
        'deleted_at' => 'nullable'
    ];

    public function pegawais(): \Illuminate\Database\Eloquent\Relations\HasMany
    {
        return $this->hasMany(\App\Models\Pegawai::class, 'pangkat_golongan_id');
    }

}
