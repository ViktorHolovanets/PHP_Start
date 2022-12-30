<?php

namespace App\Controllers\Http\DbQuery;

use App\Controllers\Http\DBController;
use Doctrine\DBAL\Exception;

class DbQuery_2 extends DBController
{
    public static function Query_1(): ?\Doctrine\DBAL\Result
    {
        try {
            return parent::getInstance()->getFullInfo(['pr.name as "product_name"', 'cat.name as "category_name"','s.name as "sector_name"'])
                ->join('cat','sector', 's', 's.id=cat.sector_id')
                ->groupBy('s.name')
                ->addGroupBy('cat.name')
                ->executeQuery();
        } catch (Exception $e) {
            return null;
        }
    }
    public static function Query_2(int $id_sector): ?\Doctrine\DBAL\Result
    {
        try {
            return parent::getInstance()->getFullInfo(['u.name'])
                ->join('cat','sector', 's', 's.id=cat.sector_id')
                ->groupBy('s.name')
                ->where('s.id=?')
                ->setParameter(0, $id_sector)
                ->executeQuery();
        } catch (Exception $e) {
            return null;
        }
    }
    public static function Query_3(int $id_sector): ?\Doctrine\DBAL\Result
    {
        try {
            return parent::getInstance()->getFullInfo(['COUNT(u.id)'])
                ->join('cat','sector', 's', 's.id=cat.sector_id')
                ->groupBy('s.name')
                ->addGroupBy('cat.name')
                ->executeQuery();
        } catch (Exception $e) {
            return null;
        }
    }
    public static function Query_4(): ?\Doctrine\DBAL\Result
    {
        try {
            return parent::getInstance()->getFullInfo(['u.*'])
                ->groupBy('u.name')
                ->having('(SELECT COUNT(*)FROM category)=COUNT( DISTINCT cat.id)')
                ->executeQuery();
        } catch (Exception $e) {
            return null;
        }
    }
    public static function Query_5(): ?\Doctrine\DBAL\Result
    {
//        SELECT product.Name as name, COUNT(cart.product_id) as count, category_id
//        FROM product
//        JOIN cart On cart.product_id=product.id
//        JOIN category ON category.id=product.category_id
//        GROUP BY  category.id, product.name
//        ORDER By count DESC;
        return null;
    }
    public static function Query_7(): ?\Doctrine\DBAL\Result
    {
        try {
            return  parent::getInstance()->queryBuilder
                ->select('*')
                ->from('user')
                ->where('name IS NULL')
                ->executeQuery();
        } catch (Exception $e) {
            return null;
        }
    }
    public static function Query_8(): ?\Doctrine\DBAL\Result
    {
        try {
            return parent::getInstance()->getFullInfo(['u.*','pr.Price'])
                ->orderBy('pr.Price', 'ASC')
                ->executeQuery();
        } catch (Exception $e) {
            return null;
        }
    }
    public static function Query_9(): ?\Doctrine\DBAL\Result
    {
        try {
            return parent::getInstance()->getFullInfo(['u.*', 'SUM(pr.Price)'])
                ->groupBy('u.id')
                ->orderBy('SUM(pr.Price)', 'ASC')
                ->executeQuery();
        } catch (Exception $e) {
            return null;
        }
    }
    public static function Query_10(): ?\Doctrine\DBAL\Result
    {
        try {
            return parent::getInstance()->getFullInfo(['pr.*', 'COUNT(pr.Price)', 'SUM(pr.Price)'])
                ->groupBy('u.id')
                ->orderBy('pr.id', 'ASC')
                ->executeQuery();
        } catch (Exception $e) {
            return null;
        }
    }
}