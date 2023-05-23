<?php

namespace App\Repositories;

use App\Models\Company;
use App\Repositories\BaseRepository;

class CompanyRepository extends BaseRepository
{
    protected $fieldSearchable = [
        'name',
        'description',
        'status',
        'created_by',
        'updated_by',
        'deleted_by'
    ];

    public function getFieldsSearchable(): array
    {
        return $this->fieldSearchable;
    }

    public function model(): string
    {
        return Company::class;
    }

}
