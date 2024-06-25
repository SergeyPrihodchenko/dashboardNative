<?php

namespace S\P\Database;

class NRepository {

    public function __construct(
        private \PDO $pdo,
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
        if(strlen($where) < 1) {
            
            throw new \Exception();

            return [];
        }

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

        if(!$data) {

            throw new \PDOException();

        }

        return $data;
    }

    protected function lazyWhere(string $where, $columns = '*', int $page = 1, int $limit = 50): array
    {
        if(strlen($where) < 1) {
            
            throw new \Exception();

            return [];
        }

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

        $stmt->execute();

        $data = $stmt->fetchAll(\PDO::FETCH_ASSOC);

        if(!$data) {

            throw new \PDOException();

        }

        return $data;
    }

    public static function lazyAllUniqClients(\PDO $pdo, string $table, $columns = '*', int $limit = 30, int $page = 1): array
    {
        if(is_array($columns) && count($columns) > 0) {
            $separator = ' ,';
            if(count($columns) == 1) {
                $separator = ' ';
            }
            $columns = implode($separator, $columns);
        }

        $query = <<<SQL
            SELECT DISTINCT $columns FROM $table LIMIT :limit OFFSET :offset;
        SQL;

        $offset = ($page - 1) * $limit;

        $stmt = $pdo->prepare($query);

        $stmt->bindParam(':limit', $limit, \PDO::PARAM_INT);
        $stmt->bindParam(':offset', $offset, \PDO::PARAM_INT);

        $stmt->execute();

        $data = $stmt->fetchAll(\PDO::FETCH_ASSOC);

        return $data;
    }

    public static function allUniqClients(\PDO $pdo, string $table, $columns = '*'): array
    {
        if(is_array($columns) && count($columns) > 0) {
            $separator = ' ,';
            if(count($columns) == 1) {
                $separator = ' ';
            }
            $columns = implode($separator, $columns);
        }

        $query = <<<SQL
            SELECT DISTINCT $columns FROM $table;
        SQL;

        $stmt = $pdo->prepare($query);

        $stmt->execute();

        $data = $stmt->fetchAll(\PDO::FETCH_ASSOC);

        return $data;
    }
}