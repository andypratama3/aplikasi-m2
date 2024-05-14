<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Kalnoy\Nestedset\NodeTrait;

class Jabatan extends Model
{
    use NodeTrait;
    public $table = 'jabatan';

    public $fillable = [
        'name',
        'definition',
        'order',
        'show_in_header',
        'left',
        'right',
        'parent'
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
        'order' => 'nullable',
        'show_in_header' => 'nullable',
        'left' => 'nullable',
        'right' => 'nullable',
        'parent' => 'nullable'
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
        return 'parent';
    }

    // Specify parent id attribute mutator
    public function setParentIdAttribute($value)
    {
        $this->setParentIdAttribute($value);
    }

    public function people(): \Illuminate\Database\Eloquent\Relations\HasMany
    {
        return $this->hasMany(\App\Models\Person::class, 'jabatan_id');
    }
}
