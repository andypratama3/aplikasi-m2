<?php

namespace App\Repositories;

use App\Models\Jabatan;
use App\Repositories\BaseRepository;

class JabatanRepository extends BaseRepository
{
    protected $fieldSearchable = [
        'name',
        'definition',
        'order',
        'show_in_header',
        'left',
        'right',
        'parent_id'
    ];

    public function getFieldsSearchable(): array
    {
        return $this->fieldSearchable;
    }

    public function model(): string
    {
        return Jabatan::class;
    }
}
