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

    #[ORM\ManyToOne(targetEntity: ORDERS::class, inversedBy: 'oRDERDETAILS')]
    #[ORM\JoinColumn(nullable: false)]
    private $ORDER_ID;

    #[ORM\ManyToOne(targetEntity: MEALS::class, inversedBy: 'oRDERDETAILS')]
    #[ORM\JoinColumn(nullable: false)]
    private $MEAL_ID;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getORDERID(): ?ORDERS
    {
        return $this->ORDER_ID;
    }

    public function setORDERID(?ORDERS $ORDER_ID): self
    {
        $this->ORDER_ID = $ORDER_ID;

        return $this;
    }

    public function getMEALID(): ?MEALS
    {
        return $this->MEAL_ID;
    }

    public function setMEALID(?MEALS $MEAL_ID): self
    {
        $this->MEAL_ID = $MEAL_ID;

        return $this;
    }
}
