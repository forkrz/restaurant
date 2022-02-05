<?php

namespace App\Entity;

use App\Repository\MEALSRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: MEALSRepository::class)]
class MEALS
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column(type: 'integer')]
    private $id;

    #[ORM\Column(type: 'string', length: 255)]
    private $MEAL_NAME;

    #[ORM\Column(type: 'decimal', precision: 5, scale: 2)]
    private $SMALL_PRICE;

    #[ORM\Column(type: 'decimal', precision: 5, scale: 2)]
    private $MEDIUM_PRICE;

    #[ORM\Column(type: 'decimal', precision: 5, scale: 2)]
    private $LARGE_PRICE;

    #[ORM\OneToMany(mappedBy: 'MEAL_ID', targetEntity: ORDERDETAILS::class)]
    private $oRDERDETAILS;

    public function __construct()
    {
        $this->oRDERDETAILS = new ArrayCollection();
    }

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

    public function getSMALLPRICE(): ?string
    {
        return $this->SMALL_PRICE;
    }

    public function setSMALLPRICE(string $SMALL_PRICE): self
    {
        $this->SMALL_PRICE = $SMALL_PRICE;

        return $this;
    }

    public function getMEDIUMPRICE(): ?string
    {
        return $this->MEDIUM_PRICE;
    }

    public function setMEDIUMPRICE(string $MEDIUM_PRICE): self
    {
        $this->MEDIUM_PRICE = $MEDIUM_PRICE;

        return $this;
    }

    public function getLARGEPRICE(): ?string
    {
        return $this->LARGE_PRICE;
    }

    public function setLARGEPRICE(string $LARGE_PRICE): self
    {
        $this->LARGE_PRICE = $LARGE_PRICE;

        return $this;
    }

    /**
     * @return Collection|ORDERDETAILS[]
     */
    public function getORDERDETAILS(): Collection
    {
        return $this->oRDERDETAILS;
    }

    public function addORDERDETAIL(ORDERDETAILS $oRDERDETAIL): self
    {
        if (!$this->oRDERDETAILS->contains($oRDERDETAIL)) {
            $this->oRDERDETAILS[] = $oRDERDETAIL;
            $oRDERDETAIL->setMEALID($this);
        }

        return $this;
    }

    public function removeORDERDETAIL(ORDERDETAILS $oRDERDETAIL): self
    {
        if ($this->oRDERDETAILS->removeElement($oRDERDETAIL)) {
            // set the owning side to null (unless already changed)
            if ($oRDERDETAIL->getMEALID() === $this) {
                $oRDERDETAIL->setMEALID(null);
            }
        }

        return $this;
    }
}
