<?php

namespace S\P\Database;

class SateliRepository extends Repository {

    protected const TABLE_NAMEL = 'fluidline_sateli_InvoiceCallList';

    public function getLayoutClients(): array
    {
        $table = static::TABLE_NAMEL;

        $query = <<<SQL
            SELECT DISTINCT client_phone FROM $table;
        SQL;

        $stmt = $this->pdo->prepare($query);

        $stmt->execute();

        $data = $stmt->fetchAll(\PDO::FETCH_ASSOC);

        return $data;
    }

}