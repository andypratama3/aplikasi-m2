<?php

namespace App\Repositories;

use App\Models\PerangkatDaerah;
use App\Repositories\BaseRepository;

class PerangkatDaerahRepository extends BaseRepository
{
    protected $fieldSearchable = [
        'nama',
        'alamat',
        'jenis_instansi',
        'kode'
    ];

    public function getFieldsSearchable(): array
    {
        return $this->fieldSearchable;
    }

    public function model(): string
    {
        return PerangkatDaerah::class;
    }
}
