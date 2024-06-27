<?php

namespace S\P\Models\Visitors;

use S\P\Database\VisitorsRepository;
use S\P\Models\Model;

abstract class ModelVisitors extends Model {

    protected ?VisitorsRepository $repo = null;

    public function __construct()
    {
        parent::__construct();
    }

    public function ymUid(): array
    {
        $data = $this->repo->ymUid($this->id, ['_ym_uid']);

        return $data;
    }
}