<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Pendidikan extends Model
{
    public $table = 'pendidikan';

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

    public function people(): \Illuminate\Database\Eloquent\Relations\HasMany
    {
        return $this->hasMany(\App\Models\Person::class, 'pendidikan_id1');
    }

    public function person1s(): \Illuminate\Database\Eloquent\Relations\HasMany
    {
        return $this->hasMany(\App\Models\Person::class, 'pendidikan_id');
    }
}
