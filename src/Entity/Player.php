<?php

namespace App\Entity;

use App\Repository\PlayerRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: PlayerRepository::class)]
class Player
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\ManyToOne(inversedBy: 'teamID')]
    private ?Team $teamID = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $name = null;

    #[ORM\Column(nullable: true)]
    private ?int $playernumber = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getTeamID(): ?Team
    {
        return $this->teamID;
    }

    public function setTeamID(?Team $teamID): static
    {
        $this->teamID = $teamID;

        return $this;
    }

    public function getName(): ?string
    {
        return $this->name;
    }

    public function setName(?string $name): static
    {
        $this->name = $name;

        return $this;
    }

    public function getPlayernumber(): ?int
    {
        return $this->playernumber;
    }

    public function setPlayernumber(?int $playernumber): static
    {
        $this->playernumber = $playernumber;

        return $this;
    }
}
