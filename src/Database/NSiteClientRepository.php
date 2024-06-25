<?php

namespace S\P\Database;

class NSiteClientRepository extends NRepository {

    public function getDataById($id): array
    {

        $data = $this->where("client_mail = $id");

        if(!$data) {
            
            throw new \Exception();

            return [];

        }

        return $data;

    }

    public function lazyGetDataById($id, int $page): array
    {

        $data = $this->lazyWhere("client_mail = $id", $page);

        if(!$data) {
            
            throw new \Exception();

            return [];

        }

        return $data;

    }

    public function totalCost($id, int $invoice_status): array
    {
        $data = $this->where("client_mail = $id AND invoice_status = $invoice_status", ['invoice_price']);

        return $data;
    }

    public function lazyTotalCost($id, int $invoice_status, int $page): array
    {
        $data = $this->lazyWhere("client_mail = $id AND invoice_status = $invoice_status", ['invoice_price'], $page);

        return $data;
    }
}