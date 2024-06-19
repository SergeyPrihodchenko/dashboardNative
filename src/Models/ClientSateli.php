<?php

namespace S\P\Models;

use S\P\Database\Repository;

class ClientSateli extends Client {

    public function __construct(
        private string $client_phone,
        protected Repository $repo
    )
    {
        
    }

    public function getClientData($columns = '*'): array
    {
        $data = $this->repo->getDataByClien($this->client_phone, $columns);

        return $data;
    }

    public function totalPrice(int $invoceStatus): array
    {
        $prices = $this->repo->totalPay($this->client_phone, $invoceStatus);
  
        $sumPay = 0;
        $countBills = 0;

        foreach ($prices as $price) {
    
            $sumPay += ($price['invoice_price'] * 100);
            $countBills++;

        }

        return ['countBills' => $countBills, 'bill' => ($sumPay / 100)];
    }

}