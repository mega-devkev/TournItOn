<?php

namespace App\Entity;

use App\Repository\TeamRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: TeamRepository::class)]
class Team
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $name = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $teamleader = null;

    #[ORM\OneToMany(mappedBy: 'teamID', targetEntity: Player::class)]
    private Collection $teamID;

    public function __construct()
    {
        $this->teamID = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
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

    public function getTeamleader(): ?string
    {
        return $this->teamleader;
    }

    public function setTeamleader(?string $teamleader): static
    {
        $this->teamleader = $teamleader;

        return $this;
    }

    /**
     * @return Collection<int, Player>
     */
    public function getTeamID(): Collection
    {
        return $this->teamID;
    }

    public function addTeamID(Player $teamID): static
    {
        if (!$this->teamID->contains($teamID)) {
            $this->teamID->add($teamID);
            $teamID->setTeamID($this);
        }

        return $this;
    }

    public function removeTeamID(Player $teamID): static
    {
        if ($this->teamID->removeElement($teamID)) {
            // set the owning side to null (unless already changed)
            if ($teamID->getTeamID() === $this) {
                $teamID->setTeamID(null);
            }
        }

        return $this;
    }
}
