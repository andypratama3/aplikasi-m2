<?php

namespace App\Repositories;

use App\Models\LinkSk;
use App\Repositories\BaseRepository;

class LinkSkRepository extends BaseRepository
{
    protected $fieldSearchable = [
        'link',
        'dari_tanggal',
        'sampai_tanggal'
    ];

    public function getFieldsSearchable(): array
    {
        return $this->fieldSearchable;
    }

    public function model(): string
    {
        return LinkSk::class;
    }
}
