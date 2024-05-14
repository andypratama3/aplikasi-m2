<?php

namespace App\Repositories;

use App\Models\Bidang;
use App\Repositories\BaseRepository;

class BidangRepository extends BaseRepository
{
    protected $fieldSearchable = [
        'name',
        'definition',
        'bidang_id',
        'left',
        'right'
    ];

    public function getFieldsSearchable(): array
    {
        return $this->fieldSearchable;
    }

    public function model(): string
    {
        return Bidang::class;
    }
}
