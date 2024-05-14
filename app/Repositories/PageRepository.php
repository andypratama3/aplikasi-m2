<?php

namespace App\Repositories;

use App\Models\Page;
use App\Repositories\BaseRepository;

class PageRepository extends BaseRepository
{
    protected $fieldSearchable = [
        'judul',
        'isi',
        'slug',
        'show',
        'custom_url',
        'page_category_id',
        'external_url',
        'parent_page_id',
        'left',
        'right',
        'highlight',
        'order',
        'users_id'
    ];

    public function getFieldsSearchable(): array
    {
        return $this->fieldSearchable;
    }

    public function model(): string
    {
        return Page::class;
    }
}
