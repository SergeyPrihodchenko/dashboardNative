<?php

namespace S\P\Database\Visitors;

use S\P\Database\VisitorsRepository as Repository;

class VisitorsRepository extends Repository {

    public function clientDataById($id, $columns): array
    {
        throw new \Exception();
    }
    public function lazyClientDataById($id, $columns, $page): array
    {
        throw new \Exception();
    }

    public function totalCost($id, int $invoice_status): array
    {
        throw new \Exception();
    }

    public function lazyTotalCost($id, int $invoice_status, int $page): array
    {
        throw new \Exception();
    }

    public function ymUid($id, array $columns): array
    {
        $data = $this->whereDistinct("client_id = '{$id}'" ,$columns);

        return $data;
    }
}