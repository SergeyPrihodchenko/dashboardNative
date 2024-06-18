<?php

namespace S\P\Models;

use S\P\Database\Repository;

class Client {

    public function __construct(
        private string $client_mail,
        protected Repository $repo
    )
    {
    }

    public function getClientData($columns = '*'): array
    {
        $data = $this->repo->getDataByClien($this->client_mail, $columns);

        return $data;
    }

    public function totalPrice(int $invoceStatus): array
    {
        $prices = $this->repo->totalPay($this->client_mail, $invoceStatus);
  
        $sumPay = 0;
        $countBills = 0;

        foreach ($prices as $price) {
    
            $sumPay += ($price['invoice_price'] * 100);
            $countBills++;

        }

        return ['countBills' => $countBills, 'bill' => ($sumPay / 100)];
    }

    public static function getAllClients(Repository $repo): array
    {
        $data = $repo->getLayoutClients();

        return $data;
    }
}