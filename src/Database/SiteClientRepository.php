<?php

namespace S\P\Database;

abstract class SiteClientRepository extends Repository {

    abstract public function clientDataById($id, $columns): array;

    abstract public function lazyClientDataById($id, $columns, int $page): array;

    abstract public function lazyTotalCost($id, int $invoice_status, int $page): array;

    abstract public function totalCost($id, int $invoice_status): array;
    
}