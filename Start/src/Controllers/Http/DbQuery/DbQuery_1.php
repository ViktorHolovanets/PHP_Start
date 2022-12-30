<?php

namespace App\Controllers\Http\DbQuery;

use App\Controllers\Http\DBController;
use Doctrine\DBAL\Exception;

class DbQuery_1 extends DBController
{
    public static function Query_1(): ?\Doctrine\DBAL\Result
    {
        try {
          return  parent::getInstance()->queryBuilder
              ->select('COUNT(id)')
              ->from('user')->executeQuery();
        } catch (Exception $e) {
            return null;
        }
    }
    public static function Query_2(int $id=1): ?\Doctrine\DBAL\Result
    {
        try {
            return parent::getInstance()->getFullInfo(['COUNT(pr.id)'], $id)->executeQuery();
        } catch (Exception $e) {
            return null;
        }
    }
    public static function Query_3(): ?\Doctrine\DBAL\Result
    {
        try {
            return parent::getInstance()->getFullInfo(['SUM(pr.price)'])->executeQuery();
        } catch (Exception $e) {
            return null;
        }
    }
    public static function Query_4(): ?\Doctrine\DBAL\Result
    {
        try {
            return parent::getInstance()->getFullInfo(['AVG(pr.price)'])
                ->executeQuery();
        } catch (Exception $e) {
            return null;
        }
    }
    public static function Query_5($id=1): ?\Doctrine\DBAL\Result
    {
        try {
            return parent::getInstance()->getFullInfo(['pr.name', 'Count(pr.name)'], $id)
                ->groupBy('pr.name')
                ->executeQuery();
        } catch (Exception $e) {
            return null;
        }
    }
    public static function Query_6(): ?\Doctrine\DBAL\Result
    {
        try {
            return parent::getInstance()->getFullInfo(['pr.name', 'Count(pr.name)', 'pr.price'])
                ->groupBy('pr.name')
                ->addOrderBy('pr.price', 'DESC')
                ->setMaxResults(3)
                ->executeQuery();
        } catch (Exception $e) {
            return null;
        }
    }
    public static function Query_7(): ?\Doctrine\DBAL\Result
    {
        try {
            return parent::getInstance()->getFullInfo(['pr.name', 'Count(pr.name)'])
                ->groupBy('pr.name')
                ->addOrderBy('Count(pr.name)', 'DESC')
                ->executeQuery();
        } catch (Exception $e) {
            return null;
        }
    }
    public static function Query_8(): ?\Doctrine\DBAL\Result
    {
        parent::getInstance()->queryBuilder->select('*')
            ->from('user', 'u')
            ->where('u.id NOT IN(select user_id from cart)');
        try {
            return parent::getInstance()->queryBuilder->executeQuery();
        } catch (Exception $e) {
            return null;
        }
    }
    public static function Query_9(): ?\Doctrine\DBAL\Result
    {
        try {
            return parent::getInstance()->getFullInfo(['u.id', 'u.name','pr.name as "product_name"', 'COUNT(pr.id)'])
                ->groupBy('u.name')
                ->addGroupBy('pr.name')
                ->addOrderBy('Count(pr.name)', 'DESC')
                ->setMaxResults(1)
                ->executeQuery();
        } catch (Exception $e) {
            return null;
        }
    }
    public static function Query_10(): ?\Doctrine\DBAL\Result
    {
        try {
            try {
                return parent::getInstance()->getFullInfo(['SUM(pr.price)'])
                    ->where('pr.price IN(select MIN(price) from product)')
                    ->executeQuery();
            } catch (Exception $e) {
                return null;
            }
        } catch (Exception $e) {
            return null;
        }
    }
}