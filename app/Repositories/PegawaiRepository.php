<?php

namespace App\Repositories;

use App\Models\Pegawai;
use App\Repositories\BaseRepository;

class PegawaiRepository extends BaseRepository
{
    protected $fieldSearchable = [
        'nip',
        'tanggal_masuk',
        'date_of_birth',
        'place_of_birth',
        'address',
        'user_id',
        'pangkat_id'
    ];

    public function getFieldsSearchable(): array
    {
        return $this->fieldSearchable;
    }

    public function model(): string
    {
        return Pegawai::class;
    }
}
