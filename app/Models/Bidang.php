<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Kalnoy\Nestedset\NodeTrait;

class Bidang extends Model
{
    use NodeTrait;
    public $table = 'bidang';

    public $fillable = [
        'name',
        'definition',
        'bidang_id',
        'left',
        'right'
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
        'deleted_at' => 'nullable',
//        'bidang_id' => 'required',
        'left' => 'nullable',
        'right' => 'nullable'
    ];

    public function getLftName()
    {
        return 'left';
    }
    public function getRgtName()
    {
        return 'right';
    }
    public function getParentIdName()
    {
        return 'bidang_id';
    }

// Specify parent id attribute mutator
    public function setBidangIdAttribute($value)
    {
        $this->setParentIdAttribute($value);
    }

    public function people(): \Illuminate\Database\Eloquent\Relations\HasMany
    {
        return $this->hasMany(\App\Models\Person::class, 'bidang_id');
    }
}
