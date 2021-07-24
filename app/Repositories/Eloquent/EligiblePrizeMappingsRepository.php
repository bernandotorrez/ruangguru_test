<?php

namespace App\Repositories\Eloquent;

use App\Models\EligiblePrizeMappings;

class EligiblePrizeMappingsRepository extends BaseRepository
{
    public function __construct(EligiblePrizeMappings $model)
    {
        parent::__construct($model);
    }
}
