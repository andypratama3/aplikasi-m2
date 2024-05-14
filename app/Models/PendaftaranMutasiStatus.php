<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Spatie\MediaLibrary\InteractsWithMedia;
use Spatie\MediaLibrary\HasMedia;

class PendaftaranMutasiStatus extends Model implements HasMedia
{
    use InteractsWithMedia;
    
    public $table = 'pendaftaran_mutasi_status';

    public $fillable = [
        'pendaftaran_mutasi_id',
        'approved_by',
        'status_mutasi_id',
        'message'
    ];

    protected $casts = [
        'message' => 'string'
    ];

    public static array $rules = [
        'pendaftaran_mutasi_id' => 'required',
        'approved_by' => 'required',
        'status_mutasi_id' => 'required',
        'created_at' => 'nullable',
        'updated_at' => 'nullable',
        'deleted_at' => 'nullable',
        'message' => 'nullable|string|max:65535'
    ];

    public function statusMutasi(): \Illuminate\Database\Eloquent\Relations\BelongsTo
    {
        return $this->belongsTo(\App\Models\Status::class, 'status_mutasi_id');
    }

    public function approvedBy(): \Illuminate\Database\Eloquent\Relations\BelongsTo
    {
        return $this->belongsTo(\App\Models\User::class, 'approved_by');
    }

    public function pendaftaranMutasi(): \Illuminate\Database\Eloquent\Relations\BelongsTo
    {
        return $this->belongsTo(\App\Models\PendaftaranMutasi::class, 'pendaftaran_mutasi_id');
    }
}
