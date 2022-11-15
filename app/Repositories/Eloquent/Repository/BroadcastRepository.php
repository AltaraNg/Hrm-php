<?php

namespace App\Repositories\Eloquent\Repository;
use App\Models\Broadcast;
class BroadcastRepository extends BaseRepository
{
    public function __construct(Broadcast $model)
    {
        parent::__construct($model);
    }
}

