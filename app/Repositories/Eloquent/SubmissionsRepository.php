<?php

namespace App\Repositories\Eloquent;

use App\Models\Submissions;

class SubmissionsRepository extends BaseRepository
{
    public function __construct(Submissions $model)
    {
        parent::__construct($model);
    }
}
