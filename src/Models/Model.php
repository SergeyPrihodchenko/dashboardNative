<?php

namespace S\P\Models;

use S\P\Database\InvoiceCall\CallRepository;
use S\P\Database\InvoiceMail\MailRepository;
use S\P\Database\Visitors\VisitorsRepository;
use S\P\Database\Repository;

abstract class Model {

    protected string $table;
    protected ?string $id = null;
    protected string $type = 'model';
    protected ?Repository $repo = null;

    public function __construct()
    {
        switch ($this->type) {
            case 'site':
                $this->repo = new MailRepository($this->table);
                break;
            
            case 'phone':
                $this->repo =new CallRepository($this->table);
                break;
            case 'visitors':
                $this->repo =new VisitorsRepository($this->table);
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


    public function totalCostByStatus(int $invoceStatus): array
    {

        if($this->id == null) {

            throw new \Exception();

        }


        $prices = $this->repo->totalCost($this->id, $invoceStatus);
        

  
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