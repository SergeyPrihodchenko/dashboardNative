<?php

namespace S\P\Database;

abstract class Repository {

    private \PDO $pdo;

    public function __construct(
        private string $table
    )
    {
        $this->pdo = Connect::getInstance();
    }

    protected function all($columns = '*'): array
    {
       
        $table = $this->table;

        if(is_array($columns) && count($columns) > 0) {
            $separator = ' ,';
            if(count($columns) == 1) {
                $separator = ' ';
            }
            $columns = implode($separator, $columns);
        }

        $query = <<<SQL
                SELECT $columns FROM $table;
            SQL;
        
        $stmt = $this->pdo->prepare($query);

        $stmt->execute();

        $data = $stmt->fetchAll(\PDO::FETCH_ASSOC);

        if(!$data) {

            throw new \PDOException();

        }

        return $data;
    }

    protected function lazyAll($columns = '*', int $limit = 50, int $page = 1): array
    {
 
        $table = $this->table;

        if(is_array($columns) && count($columns) > 0) {
            $separator = ' ,';
            if(count($columns) == 1) {
                $separator = ' ';
            }
            $columns = implode($separator, $columns);
        }

        $offset = ($page - 1) * $limit;

        $query = <<<SQL
            SELECT $columns FROM $table LIMIT :limit OFFSET :offset;
        SQL;

        $stmt = $this->pdo->prepare($query);

        $stmt->bindParam(':limit', $limit, \PDO::PARAM_INT);
        $stmt->bindParam(':offset', $offset, \PDO::PARAM_INT);

        $stmt->execute();

        $data = $stmt->fetchAll(\PDO::FETCH_ASSOC);

        return $data;

    }

    protected function where( string $where, $columns = '*'): array
    {

        $table = $this->table;

        if(is_array($columns) && count($columns) > 0) {
            $separator = ' ,';
            if(count($columns) == 1) {
                $separator = ' ';
            }
            $columns = implode($separator, $columns);
        }

        $query = <<<SQL
                SELECT $columns FROM $table where $where;
            SQL;
        
        $stmt = $this->pdo->prepare($query);

        $stmt->execute();

        $data = $stmt->fetchAll(\PDO::FETCH_ASSOC);

        // if(!$data) {

        //     throw new \PDOException();

        // }

        return $data;
    }

    protected function lazyWhere(string $where, $columns, int $page, int $limit = 30): array
    {

        $table = $this->table;

        if(is_array($columns) && count($columns) > 0) {
            $separator = ' ,';
            if(count($columns) == 1) {
                $separator = ' ';
            }
            $columns = implode($separator, $columns);
        }

        $offset = ($page - 1) * $limit;

        $query = <<<SQL
                SELECT $columns FROM $table where $where LIMIT :limit OFFSET :offset;
            SQL;
        
        $stmt = $this->pdo->prepare($query);

        $stmt->bindParam(':limit', $limit, \PDO::PARAM_INT);
        $stmt->bindParam(':offset', $offset, \PDO::PARAM_INT);

        try {

            $stmt->execute();

            $data = $stmt->fetchAll(\PDO::FETCH_ASSOC);

        } catch (\PDOException $e) {

            file_put_contents(__DIR__ . '/db_error_logs.txt',$e->getMessage() . "\n", FILE_APPEND);
            
            return [];

        }

        return $data;
    }

    public function lazyAllUniqClients($columns = '*', int $page, int $limit = 50): array
    {
        $table = $this->table;

        if(is_array($columns) && !empty($columns)) {

            if(count($columns) == 1) {
                $separator = ' ';
            }

            $separator = ' ,';
           
            $columns = implode($separator, $columns);
        }

        if(empty($columns)) {

            $columns = '*';
            
        }

        $query = <<<SQL
            SELECT DISTINCT $columns FROM $table LIMIT :limit OFFSET :offset;
        SQL;

        $offset = ($page - 1) * $limit;

        $stmt = $this->pdo->prepare($query);

        $stmt->bindParam(':limit', $limit, \PDO::PARAM_INT);
        $stmt->bindParam(':offset', $offset, \PDO::PARAM_INT);

        $stmt->execute();

        $data = $stmt->fetchAll(\PDO::FETCH_ASSOC);

        return $data;
    }

    public function allUniqClients($columns = '*'): array
    {

        $table = $this->table;

        if(is_array($columns) && !empty($columns)) {

            if(count($columns) == 1) {
                $separator = ' ';
            }

            $separator = ' ,';
           
            $columns = implode($separator, $columns);
        }

        if(empty($columns)) {

            $columns = '*';

        }

        $query = <<<SQL
            SELECT DISTINCT $columns FROM $table;
        SQL;

        $stmt = $this->pdo->prepare($query);

        $stmt->execute();

        $data = $stmt->fetchAll(\PDO::FETCH_ASSOC);

        return $data;
    }

    abstract public function clientDataById($id, $columns): array;

    abstract public function lazyClientDataById($id, $columns, int $page): array;

    abstract public function lazyTotalCost($id, int $invoice_status, int $page): array;

    abstract public function totalCost($id, int $invoice_status): array;
}