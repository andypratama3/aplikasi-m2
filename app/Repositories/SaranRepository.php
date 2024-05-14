<?php

namespace App\Repositories;

use App\Models\Saran;
use App\Repositories\BaseRepository;

class SaranRepository extends BaseRepository
{
    protected $fieldSearchable = [
        'pegawai_id',
        'judul',
        'isi'
    ];

    public function getFieldsSearchable(): array
    {
        return $this->fieldSearchable;
    }

    public function model(): string
    {
        return Saran::class;
    }
}
