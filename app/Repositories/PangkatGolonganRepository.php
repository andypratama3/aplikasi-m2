<?php

namespace App\Repositories;

use App\Models\PangkatGolongan;
use App\Repositories\BaseRepository;

class PangkatGolonganRepository extends BaseRepository
{
    protected $fieldSearchable = [
        'name',
        'definition'
    ];

    public function getFieldsSearchable(): array
    {
        return $this->fieldSearchable;
    }

    public function model(): string
    {
        return PangkatGolongan::class;
    }
}
