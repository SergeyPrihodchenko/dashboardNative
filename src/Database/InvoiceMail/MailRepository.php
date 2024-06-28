<?php

namespace S\P\Database\InvoiceMail;

use S\P\Database\SiteClientRepository;

class MailRepository extends SiteClientRepository {

    public function clientDataById($id, $columns): array
    {
        $data = $data = $this->where(" client_mail = '{$id}' ", $columns);

        return $data;

    }

    public function distinctClientDataById($id, $columns): array
    {
        $data = $data = $this->whereDistinct(" client_mail = '{$id}' ", $columns);

        return $data;

    }
    public function lazyClientDataById($id, $columns, $page): array
    {
        $data = $data = $this->lazyWhere("client_mail = '{$id}'", $columns, $page);

        return $data;

    }

    public function totalCost($id, int $invoice_status): array
    {
        $data = $this->whereDistinct("client_mail = '{$id}' AND invoice_status = '{$invoice_status}'", ['invoice_price','invoice_number']);

        return $data;
    }

    public function lazyTotalCost($id, int $invoice_status, int $page): array
    {
        $data = $this->lazyWhere("client_mail = '{$id}' AND invoice_status = '{$invoice_status}'", ['invoice_price'], $page);

        return $data;
    }

    public function ymUid($id, array $columns): array
    {
        throw new \Exception();
    }
}