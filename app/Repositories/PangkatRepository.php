<?php

namespace App\Repositories;

use App\Models\Pangkat;
use App\Repositories\BaseRepository;

class PangkatRepository extends BaseRepository
{
    protected $fieldSearchable = [
        'kepangkat_golongan',
        'nama',
        'description'
    ];

    public function getFieldsSearchable(): array
    {
        return $this->fieldSearchable;
    }

    public function model(): string
    {
        return Pangkat::class;
    }
}
