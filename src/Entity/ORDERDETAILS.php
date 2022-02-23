<?php

namespace App\Entity;

use App\Repository\ORDERDETAILSRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: ORDERDETAILSRepository::class)]
class ORDERDETAILS
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column(type: 'integer')]
    private $id;

    #[ORM\Column(type: 'string', length: 255)]
    private $MEAL_NAME;

    #[ORM\Column(type: 'string', length: 255)]
    private $MEAL_SIZE;

    #[ORM\Column(type: 'integer')]
    private $QUANTITY;

    #[ORM\Column(type: 'decimal', precision: 10, scale: 2)]
    private $PRICE;

    #[ORM\Column(type: 'integer')]
    private $ORDERID;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getMEALNAME(): ?string
    {
        return $this->MEAL_NAME;
    }

    public function setMEALNAME(string $MEAL_NAME): self
    {
        $this->MEAL_NAME = $MEAL_NAME;

        return $this;
    }

    public function getMEALSIZE(): ?string
    {
        return $this->MEAL_SIZE;
    }

    public function setMEALSIZE(string $MEAL_SIZE): self
    {
        $this->MEAL_SIZE = $MEAL_SIZE;

        return $this;
    }

    public function getQUANTITY(): ?int
    {
        return $this->QUANTITY;
    }

    public function setQUANTITY(int $QUANTITY): self
    {
        $this->QUANTITY = $QUANTITY;

        return $this;
    }

    public function getPRICE(): ?string
    {
        return $this->PRICE;
    }

    public function setPRICE(string $PRICE): self
    {
        $this->PRICE = $PRICE;

        return $this;
    }

    public function getORDERID(): ?int
    {
        return $this->ORDERID;
    }

    public function setORDERID(int $ORDERID): self
    {
        $this->ORDERID = $ORDERID;

        return $this;
    }
}
