<?php

namespace S\P\Models;

use S\P\Database\PhoneClientRepository;
use S\P\Database\Repository;
use S\P\Database\SiteClientRepository;

abstract class Model {

    protected string $table;
    protected ?string $id = null;
    protected string $type = 'model';
    protected ?Repository $repo = null;

    public function __construct()
    {
        switch ($this->type) {
            case 'site':
                $this->repo = new SiteClientRepository($this->table);
                break;
            
            case 'phone':
                $this->repo =new PhoneClientRepository($this->table);
                break;
        }
    }

    public function lazyFind($columns, $page): array
    {
        $data = $this->repo->lazyClientDataById($this->id, $columns, $page);

        return $data;
    }

    public function find($columns): array
    {
        $data = $this->repo->clientDataById($this->id, $columns);

        return $data;
    }

    public function lazyAllUniqClients($columns, $page = 1): array
    {
        $data = $this->repo->lazyAllUniqClients($columns, $page);

        return $data;
    }

    public function allUniqClients($columns = []): array
    {
        $data = $this->repo->allUniqClients($columns);

        return $data;
    }


    public function totalCostByStatus(int $invoceStatus, int $page, bool $lazy = true): array
    {

        if($this->id == null) {

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

        return ['countBills' => $countBills, 'bill' => number_format(($sumPay / 100), 2, '.', '')];
    }

    public function setId(string $value): void
    {
        $this->id = $value;
    }
}