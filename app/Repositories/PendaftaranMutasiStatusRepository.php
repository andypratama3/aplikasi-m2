<?php

namespace App\Repositories;

use App\Models\PendaftaranMutasiStatus;
use App\Repositories\BaseRepository;

class PendaftaranMutasiStatusRepository extends BaseRepository
{
    protected $fieldSearchable = [
        'pendaftaran_mutasi_id',
        'approved_by',
        'status_mutasi_id',
        'message'
    ];

    public function getFieldsSearchable(): array
    {
        return $this->fieldSearchable;
    }

    public function model(): string
    {
        return PendaftaranMutasiStatus::class;
    }
}
