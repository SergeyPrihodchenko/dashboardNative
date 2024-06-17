<?php

namespace S\P\Models;

use S\P\Database\Repository;

class Client {

    public function __construct(
        private string $clien_id,
        protected Repository $repo
    )
    {
    }

    public function getClientData($columns = '*'): array
    {
        $data = $this->repo->getDataByClien($this->clien_id, $columns);

        return $data;
    }

    public function fullPayPrice(array $columns = []): float
    {
        $data = $this->repo->getDataByClien($this->clien_id, $columns);

        $sumPay = 0;

        foreach ($data as $elem) {
            
            if($elem['invoice_status'] == 2) {
                $sumPay += ($elem['invoice_price'] * 100);
             }
        }

        return ($sumPay / 100);

    }

    public static function getAllClients(Repository $repo): array
    {
        $data = $repo->getLayoutClients();

        return $data;
    }
}