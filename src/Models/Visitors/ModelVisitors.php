<?php

namespace S\P\Models\Visitors;

use S\P\Models\Model;

abstract class ModelVisitors extends Model {

    public function __construct()
    {
        parent::__construct();
    }

    public function ymUid(): string
    {
        $data = $this->repo->ymUid($this->id, ['_ym_uid']);

        return $data[0]['_ym_uid'];
    }
}