<?php

namespace App\Entity;

use App\Repository\ORDERSRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: ORDERSRepository::class)]
class ORDERS
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column(type: 'integer')]
    private $id;

    #[ORM\Column(type: 'date')]
    private $DATE_OF_ORDER;

    #[ORM\Column(type: 'decimal', precision: 10, scale: 2)]
    private $TOTAL_COST;

    #[ORM\OneToMany(mappedBy: 'ORDER_ID', targetEntity: ORDERDETAILS::class)]
    private $oRDERDETAILS;

    public function __construct()
    {
        $this->oRDERDETAILS = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getDATEOFORDER(): ?\DateTimeInterface
    {
        return $this->DATE_OF_ORDER;
    }

    public function setDATEOFORDER(\DateTimeInterface $DATE_OF_ORDER): self
    {
        $this->DATE_OF_ORDER = $DATE_OF_ORDER;

        return $this;
    }

    public function getTOTALCOST(): ?string
    {
        return $this->TOTAL_COST;
    }

    public function setTOTALCOST(string $TOTAL_COST): self
    {
        $this->TOTAL_COST = $TOTAL_COST;

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
            $oRDERDETAIL->setORDERID($this);
        }

        return $this;
    }

    public function removeORDERDETAIL(ORDERDETAILS $oRDERDETAIL): self
    {
        if ($this->oRDERDETAILS->removeElement($oRDERDETAIL)) {
            // set the owning side to null (unless already changed)
            if ($oRDERDETAIL->getORDERID() === $this) {
                $oRDERDETAIL->setORDERID(null);
            }
        }

        return $this;
    }
}
