<?php

namespace App\Repositories;

use App\Models\Person;
use App\Repositories\BaseRepository;

class PersonRepository extends BaseRepository
{
    protected $fieldSearchable = [
        'name',
        'date_of_birth',
        'place_of_birth',
        'address',
        'pendidikan_id',
        'slug',
        'foto',
        'jabatan_id',
        'pangkat_golongan_id',
        'pendidikan_id1',
        'bidang_id'
    ];

    public function getFieldsSearchable(): array
    {
        return $this->fieldSearchable;
    }

    public function model(): string
    {
        return Person::class;
    }
}
