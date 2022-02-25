<?php

namespace App\Utils;

use Doctrine\ORM\EntityManagerInterface;
use Doctrine\Persistence\ManagerRegistry;

class ApiData
{
    public function __construct(private ManagerRegistry $doctrine)
    {
    }

    private function priceController(string $size):string{
        if($size == 'small'){
            return 'small_price';
        }elseif($size == 'medium'){
            return 'medium_price';
        }elseif($size == 'large'){
            return 'large_price';
        }
    }

    public function getPrice(array $mealNames,array $sizes,int $i):float
    {
        $mealName = $mealNames[$i];
        $size = $sizes[$i];
            $conn = $this->doctrine->getConnection();
            $sql = "SELECT " . $this->priceController($size) . " FROM meals WHERE meal_name = ". "'$mealName'";
            $stmt = $conn->prepare($sql);
            $resultSet = $stmt->executeQuery();
            $price = $resultSet->fetchOne();
            return $price;
    }

    private function countPricexQty(array $mealNames,array $sizes,array $qtys,int $i):float{
        $qty = $qtys[$i];
        $price = $this->getPrice($mealNames,$sizes,$i);
        return $price * $qty;

    }

    public function countTotalPrice(array $mealNames,array $sizes,array $qtys):float{
        $valueArr = [];

        foreach ($mealNames as $key=>$value) {
           $partPrice = $this->countPricexQty($mealNames,$sizes,$qtys,$key);
           array_push($valueArr,$partPrice);
        }
        return array_sum($valueArr);
    }
}