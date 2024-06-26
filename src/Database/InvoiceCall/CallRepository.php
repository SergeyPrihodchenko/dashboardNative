<?php

namespace S\P\Database\InvoiceCall;

use S\P\Database\PhoneClientRepository;

class CallRepository extends PhoneClientRepository {

    public function clientDataById($id, $columns): array
    {
        $data = $data = $this->where("client_phone = '{$id}'", $columns);

        return $data;

    }
    public function lazyClientDataById($id, $columns, $page): array
    {
        $data = $data = $this->lazyWhere("client_phone = '{$id}'", $columns, $page);

        return $data;

    }

    public function totalCost($id, int $invoice_status): array
    {
        $data = $this->where("client_phone = '{$id}' AND invoice_status = '{$invoice_status}'", ['invoice_price']);

        return $data;
    }

    public function lazyTotalCost($id, int $invoice_status, int $page): array
    {
        $data = $this->lazyWhere("client_phone = '{$id}' AND invoice_status = '{$invoice_status}'", ['invoice_price'], $page);

        return $data;
    }

    public function ymUid($id, array $columns): array
    {
        throw new \Exception();
    }
    public function distinctClientDataById($id, array $columns): array
    {
        throw new \Exception();
    }
    
    
}