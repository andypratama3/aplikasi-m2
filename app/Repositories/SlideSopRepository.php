<?php

namespace App\Repositories;

use App\Models\SlideSop;
use App\Repositories\BaseRepository;

class SlideSopRepository extends BaseRepository
{
    protected $fieldSearchable = [
        'halaman',
        'description'
    ];

    public function getFieldsSearchable(): array
    {
        return $this->fieldSearchable;
    }

    public function model(): string
    {
        return SlideSop::class;
    }
}
