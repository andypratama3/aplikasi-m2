<?php

namespace App\Repositories;

use App\Models\Pendidikan;
use App\Repositories\BaseRepository;

class PendidikanRepository extends BaseRepository
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
        return Pendidikan::class;
    }
}
