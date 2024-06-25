<?php

namespace S\P\Models;

use S\P\Database\NPhoneClientRepository;
use S\P\Database\NRepository;
use S\P\Database\NSiteClientRepository;

abstract class Model {

    protected string $table;
    protected ?string $id = null;
    protected string $type = 'model';
    protected ?NRepository $repo = null;

    public function __construct()
    {
        switch ($this->type) {
            case 'site':
                $this->repo = new NSiteClientRepository($this->table);
                break;
            
            case 'phone':
                $this->repo =new NPhoneClientRepository($this->table);
                break;
        }
    }

    public function lazyAllUniqClients(): array
    {
        $data = $this->repo->lazyAllUniqClients();

        return $data;
    }

    public function allUniqClients(): array
    {
        $data = $this->repo->allUniqClients();

        return $data;
    }


    public function totalCostByStatus(int $invoceStatus, int $page, bool $lazy = true): array
    {

        if(!$this->id) {

            throw new \Exception();

        }

        if(!$lazy) {
            $prices = $this->repo->totalCost($this->id, $invoceStatus);
        }

        $prices = $this->repo->lazyTotalCost($this->id, $invoceStatus, $page);
  
        $sumPay = 0;
        $countBills = 0;

        foreach ($prices as $price) {
    
            $sumPay += ($price['invoice_price'] * 100);
            $countBills++;

        }

        return ['countBills' => $countBills, 'bill' => ($sumPay / 100)];
    }

    public function setId(string $value): void
    {
        $this->id = $value;
    }
}