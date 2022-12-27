<?php

namespace App\Controllers\Http\DbQuery;

use App\Controllers\Http\DBController;
use Doctrine\DBAL\Exception;

class DbQuery_1 extends DBController
{
    public static function Query_1(): ?\Doctrine\DBAL\Result
    {
        try {
          return  parent::getInstance()->queryBuilder->select('COUNT(id)')
                ->from('user')->executeQuery();
        } catch (Exception $e) {
            return null;
        }
    }
    public static function Query_2(int $id=1): ?\Doctrine\DBAL\Result
    {
        $subquery=parent::getInstance()->getFullInfo($id)->getSQL();
        var_dump($subquery);
        try {
            return  parent::getInstance()->db_connection->createQueryBuilder()->select('Count(items.u.name)')
                ->from('%table', 'items', $subquery)->setParameter(0, $id) ->executeQuery();
        } catch (Exception $e) {
            return null;
        }
    }
}