<?php

namespace S\P\Database;

abstract class VisitorsRepository extends Repository {

    abstract public function ymUid($id, array $columns): array;
}