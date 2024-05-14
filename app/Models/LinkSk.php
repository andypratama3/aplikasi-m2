<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class LinkSk extends Model
{
    public $table = 'link_sk';

    public $fillable = [
        'link',
        'dari_tanggal',
        'sampai_tanggal'
    ];

    protected $casts = [
        'link' => 'string',
        'dari_tanggal' => 'date',
        'sampai_tanggal' => 'date'
    ];

    public static array $rules = [
        'link' => 'nullable|string|max:255',
        'dari_tanggal' => 'nullable',
        'sampai_tanggal' => 'nullable',
        'created_at' => 'nullable',
        'updated_at' => 'nullable',
        'deleted_at' => 'nullable'
    ];

    
}
