<?php

namespace S\P\Database;

abstract class Repository {
    
    protected \PDO $pdo;
    protected const TABLE_NAMEL = 'TABLE_NAMEL';

    public function __construct()
    {
        $this->pdo = Connect::getInstance();
    }

    public function getDataByClien(string $client_mail, $columns = '*'): array
    {
        if(is_array($columns) && count($columns)) {

            $columns = implode(' ,', $columns);

        }

        $table = static::TABLE_NAMEL;
        
        $query = <<<SQL
            SELECT $columns FROM $table WHERE client_mail = :client_mail;
        SQL;

        $stmt = $this->pdo->prepare($query);

        $stmt->bindParam(':client_mail', $client_mail);

        $stmt->execute();

        $data = $stmt->fetchAll(\PDO::FETCH_ASSOC);

        return $data;
    }

    public function getLayoutClients(): array
    {
        $table = static::TABLE_NAMEL;

        $query = <<<SQL
            SELECT DISTINCT client_id, client_mail, client_mail_id, client_code FROM $table;
        SQL;

        $stmt = $this->pdo->prepare($query);

        $stmt->execute();

        $data = $stmt->fetchAll(\PDO::FETCH_ASSOC);

        return $data;
    }

    public function totalPay($client_mail, $invoice_status): array
    {
        $table = static::TABLE_NAMEL;

        $query = <<<SQL
                SELECT 
                invoice_price
                FROM $table
                WHERE client_mail = :client_mail AND invoice_status = :invoice_status;
        SQL;

        $stmt = $this->pdo->prepare($query);

        $stmt->bindValue(':client_mail', $client_mail);
        $stmt->bindValue(':invoice_status', $invoice_status);

        $stmt->execute();

        $data = $stmt->fetchAll(\PDO::FETCH_ASSOC);

        return $data;
    }

}