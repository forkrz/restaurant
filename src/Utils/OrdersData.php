<?php

namespace App\Utils;
use Doctrine\Persistence\ManagerRegistry;
Class OrdersData{

    public function __construct(private ManagerRegistry $doctrine)
    {
    }

    public function getLastOrderId():int{
        $conn = $this->doctrine->getConnection();
        $sql = "SELECT ID FROM orders ORDER BY ID DESC LIMIT 1";
        $stmt = $conn->prepare($sql);
        $resultSet = $stmt->executeQuery();
        $id = $resultSet->fetchOne();
        return $id;
    }

    public function getMealId($name){
        $conn = $this->doctrine->getConnection();
        $sql = "SELECT ID FROM meals WHERE meal_name ={$name}";
        $stmt = $conn->prepare($sql);
        $resultSet = $stmt->executeQuery();
        $id = $resultSet->fetchOne();
        return $id;
    }
}