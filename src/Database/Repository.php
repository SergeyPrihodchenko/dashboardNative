<?php

namespace S\P\Database;

abstract class Repository {
    
    protected \PDO $pdo;
    protected const TABLE_NAMEL = 'TABLE_NAMEL';

    public function __construct()
    {
        $this->pdo = Connect::getInstance();
    }

    public function getDataByClien(string $client_mail, $columns = '*', $limit = 5, $page = 1): array
    {
        $table = static::TABLE_NAMEL;

        if(is_array($columns) && count($columns)) {

            $columns = implode(' ,', $columns);

        }

        $offset = ($page - 1) * $limit;
        
        $query = <<<SQL
            SELECT $columns FROM $table WHERE client_mail = :client_mail
            LIMIT :limit OFFSET :offset;
        SQL;

        $stmt = $this->pdo->prepare($query);

        $stmt->bindParam(':limit', $limit, \PDO::PARAM_INT);
        $stmt->bindParam(':offset', $offset, \PDO::PARAM_INT);

        $stmt->bindParam(':client_mail', $client_mail);

        $stmt->execute();

        $data = $stmt->fetchAll(\PDO::FETCH_ASSOC);

        return $data;
    }

    public function getLayoutClients(int $limit = 30, int $page = 1): array
    {
        $table = static::TABLE_NAMEL;

        $query = <<<SQL
            SELECT DISTINCT client_id, client_mail, client_mail_id, client_code FROM $table LIMIT :limit OFFSET :offset;
        SQL;

        $offset = ($page - 1) * $limit;

        $stmt = $this->pdo->prepare($query);

        $stmt->bindParam(':limit', $limit, \PDO::PARAM_INT);
        $stmt->bindParam(':offset', $offset, \PDO::PARAM_INT);

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

    //******************************************************************LAZY */

    public function lazyDownload(int $limit = 30, int $page = 1, $columns = '*')
    {

        if(is_array($columns) && count($columns)) {

            $columns = implode(' ,', $columns);

        }

        $table = static::TABLE_NAMEL;

        $query = <<<SQL
            SELECT * FROM $table LIMIT :limit OFFSET :offset;
        SQL;

        $offset = ($page - 1) * $limit;

        $stmt = $this->pdo->prepare($query);

        $stmt->bindValue(':limit', $limit);
        $stmt->bindValue(':offset', $offset);

        $stmt->execute();

        $data = $stmt->fetchAll(\PDO::FETCH_ASSOC);
    }

}