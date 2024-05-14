<?php

namespace App\Repositories;

use App\Models\PendaftaranMutasi;
use App\Repositories\BaseRepository;

class PendaftaranMutasiRepository extends BaseRepository
{
    protected $fieldSearchable = [
        'pegawai_id',
        'tujuan_instansi',
        'asal_instansi',
        'tipe',
        'alasan_mutasi',
        'jabatan_asal',
        'jabatan_tujuan'
    ];

    public function getFieldsSearchable(): array
    {
        return $this->fieldSearchable;
    }

    public function model(): string
    {
        return PendaftaranMutasi::class;
    }
}
