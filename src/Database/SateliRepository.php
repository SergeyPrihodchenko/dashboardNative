<?php

namespace S\P\Database;

class SateliRepository extends Repository {

    protected const TABLE_NAMEL = 'fluidline_sateli_InvoiceCallList';

    public function getLayoutClients(int $limit = 30, int $page = 2): array
    {
        $table = static::TABLE_NAMEL;

        $query = <<<SQL
            SELECT DISTINCT client_phone FROM $table LIMIT :limit OFFSET :offset;
        SQL;

        $offset = ($page - 1) * $limit;

        $stmt = $this->pdo->prepare($query);

        $stmt->bindParam(':limit', $limit, \PDO::PARAM_INT);
        $stmt->bindParam(':offset', $offset, \PDO::PARAM_INT);

        $stmt->execute();

        $data = $stmt->fetchAll(\PDO::FETCH_ASSOC);

        return $data;
    }

    public function totalPay($client_phone, $invoice_status): array
    {
        $table = static::TABLE_NAMEL;

        $query = <<<SQL
                SELECT 
                invoice_price
                FROM $table
                WHERE client_phone = :client_phone AND invoice_status = :invoice_status;
        SQL;

        $stmt = $this->pdo->prepare($query);

        $stmt->bindValue(':client_phone', $client_phone);
        $stmt->bindValue(':invoice_status', $invoice_status);

        $stmt->execute();

        $data = $stmt->fetchAll(\PDO::FETCH_ASSOC);

        return $data;
    }

    public function getDataByClien(string $client_phone, $columns = '*', $limit = 30, $page = 1): array
    {
        if(is_array($columns) && count($columns)) {

            $columns = implode(' ,', $columns);

        }

        $table = static::TABLE_NAMEL;
        
        $query = <<<SQL
            SELECT $columns FROM $table WHERE client_phone = :client_phone;
        SQL;

        $stmt = $this->pdo->prepare($query);

        $stmt->bindParam(':client_phone', $client_phone);

        $stmt->execute();

        $data = $stmt->fetchAll(\PDO::FETCH_ASSOC);

        return $data;
    }

}