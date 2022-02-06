<?php

namespace App\Entity;

use App\Repository\ADMINDATARepository;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Security\Core\User\UserInterface;
#[ORM\Entity(repositoryClass: ADMINDATARepository::class)]
class ADMINDATA
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column(type: 'integer')]
    private $id;

    #[ORM\Column(type: 'string', length: 255)]
    private $LOGIN;

    #[ORM\Column(type: 'string', length: 255)]
    private $PASSWORD;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getLOGIN(): ?string
    {
        return $this->LOGIN;
    }

    public function setLOGIN(string $LOGIN): self
    {
        $this->LOGIN = $LOGIN;

        return $this;
    }

    public function getPASSWORD(): ?string
    {
        return $this->PASSWORD;
    }

    public function setPASSWORD(string $PASSWORD): self
    {
        $this->PASSWORD = $PASSWORD;

        return $this;
    }
}
