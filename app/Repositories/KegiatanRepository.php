<?php

namespace App\Repositories;

use App\Models\Kegiatan;
use App\Repositories\BaseRepository;

class KegiatanRepository extends BaseRepository
{
    protected $fieldSearchable = [
        'title',
        'content',
        'users_created_id',
        'users_updated_id',
        'slug',
        'schedule_date',
        'schedule_time',
        'tipe_acara',
        'location'
    ];

    public function getFieldsSearchable(): array
    {
        return $this->fieldSearchable;
    }

    public function model(): string
    {
        return Kegiatan::class;
    }
}
