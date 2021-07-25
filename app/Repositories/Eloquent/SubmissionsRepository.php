<?php

namespace App\Repositories\Eloquent;

use App\Models\Submissions;

class SubmissionsRepository extends BaseRepository
{
    public function __construct(Submissions $model)
    {
        parent::__construct($model);
    }

    public function getByUserId($id)
    {
        return $this->model->where('user_id', $id)->where('is_deleted', '0')->first();
    }
}
