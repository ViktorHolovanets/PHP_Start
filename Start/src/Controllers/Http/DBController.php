<?php

namespace App\Controllers\Http;

use Doctrine\DBAL\Driver\IBMDB2\Result;
use Doctrine\DBAL\Exception;

class DBController
{
    public \Doctrine\DBAL\Connection $db_connection;
    public \Doctrine\DBAL\Query\QueryBuilder $queryBuilder;
    private static ?DBController $instance=null;
    private function __construct(){
        $this->db_connection=\Doctrine\DBAL\DriverManager::getConnection(['dbname' => $_ENV['DB_DATABASE'],
            'user' => $_ENV['DB_USERNAME'],
            'password' => $_ENV['DB_PASSWORD'],
            'host' => $_ENV['DB_HOST'],
            'driver' => 'pdo_mysql']);
        $this->queryBuilder=$this->db_connection->createQueryBuilder();
    }
    public static function getInstance(): DBController{
        if(is_null(self::$instance)){
            self::$instance=new DBController();
        }
        return self::$instance;
    }
    public function Insert_DB_User_Category($table='user',$name_param="Name"): void
    {
        $this->queryBuilder
            ->insert($table)
            ->setValue('Name', '?')
            ->setParameter(0, $name_param);
        try {
            $this->queryBuilder->executeQuery();
        } catch (Exception $e) {
        }

        /*try {
            $this->db_connection
                ->insert('user', array(
                    "Name" => "Name2"
                ));
        } catch (Exception $e) {
        }*/
    }
    public function  Show( \Doctrine\DBAL\Result|null $result):void{
        if(!is_null($result)){
            echo"<table>";
            while (($row = $result->fetchAssociative()) !== false) {
                var_dump($row);
                echo "<tr>";
                foreach ($row as $r)
                {
                    echo "<td>$r</td>";
                }
                echo "</tr>";
            }
            echo"</table>";
        }
    }
    public  function  getAllUser():?\Doctrine\DBAL\Result{
        $this->queryBuilder
            ->select('id', 'name')
            ->from('user');
        try {
            return $this->queryBuilder->executeQuery();
        } catch (Exception $e) {
            return null;
        }
    }
    public  function  getFullInfoCart():?\Doctrine\DBAL\Result{
        return $this->getFullInfo(['u.name as "user_name"', 'pr.name as "product_name"', 'cat.name as "category_name"']);
    }
    public  function  getInfoCartOneUser(int $id=1):?\Doctrine\DBAL\Result{
        return $this->getFullInfo(['u.id','u.name as "user_name"', 'pr.name as "product_name"', 'cat.name as "category_name"'],  $id);
    }
    public  function  getInfoCategoryOneUser(int $id=1):?\Doctrine\DBAL\Result{
        return $this->getFullInfo(['cat.*'],  $id);
    }
    public  function  getInfoUsersOneProduct(int $id=1):?\Doctrine\DBAL\Result{
        return $this->getFullInfo(['u.*'],  $id);
    }
    public  function  getInfoCategoryIsNotInCartForUser(int $id=1):?\Doctrine\DBAL\Result{
        $result=$this->getInfoCategoryOneUser($id);

        $param=array();
        while (($row = $result->fetchAssociative()) !== false){
            $param[]=$row['id'];
        }
        var_dump($param);
       return $this->db_connection->createQueryBuilder()
            ->select( 'name')
            ->from('category', 'c')
            ->where('c.id<>?')
            ->setParameters($param)->executeQuery();

    }
    public  function  getFullInfo(array $arr, ?int $id=null): ?\Doctrine\DBAL\Result
    {

        try {
           $this->queryBuilder
                ->select($arr)
                ->from('cart', 'c')
                ->join('c', 'user', 'u', 'u.id=c.user_id')
                ->join('c', 'product', 'pr', 'pr.id=c.product_id')
                ->join('pr', 'category', 'cat', 'cat.id=pr.category_id');
            if(!is_null($id))
                $this->queryBuilder->where('u.id=?')
                ->setParameter(0, $id);
            return $this->queryBuilder->executeQuery();
        } catch (Exception $e) {
            return null;
        }

    }
}