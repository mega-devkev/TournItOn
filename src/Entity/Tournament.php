<?php

namespace App\Entity;

use App\Repository\TournamentRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: TournamentRepository::class)]
class Tournament
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(type: Types::DATETIME_MUTABLE, nullable: true)]
    private ?\DateTimeInterface $startTime = null;

    #[ORM\Column(type: Types::DATETIME_MUTABLE, nullable: true)]
    private ?\DateTimeInterface $endTime = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $location = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $name = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $logoURL = null;

    #[ORM\ManyToOne]
    private ?Sponsor $mainSponsor = null;

    #[ORM\Column(type: Types::ARRAY, nullable: true)]
    private ?array $secondarySponsor = null;

    #[ORM\ManyToOne]
    private ?Setting $seetingsID = null;

    #[ORM\OneToMany(mappedBy: 'tournament', targetEntity: Statistic::class)]
    private Collection $statisticID;

    public function __construct()
    {
        $this->statisticID = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getStartTime(): ?\DateTimeInterface
    {
        return $this->startTime;
    }

    public function setStartTime(?\DateTimeInterface $startTime): static
    {
        $this->startTime = $startTime;

        return $this;
    }

    public function getEndTime(): ?\DateTimeInterface
    {
        return $this->endTime;
    }

    public function setEndTime(?\DateTimeInterface $endTime): static
    {
        $this->endTime = $endTime;

        return $this;
    }

    public function getLocation(): ?string
    {
        return $this->location;
    }

    public function setLocation(?string $location): static
    {
        $this->location = $location;

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

    public function getLogoURL(): ?string
    {
        return $this->logoURL;
    }

    public function setLogoURL(?string $logoURL): static
    {
        $this->logoURL = $logoURL;

        return $this;
    }

    public function getMainSponsor(): ?Sponsor
    {
        return $this->mainSponsor;
    }

    public function setMainSponsor(?Sponsor $mainSponsor): static
    {
        $this->mainSponsor = $mainSponsor;

        return $this;
    }

    public function getSecondarySponsor(): ?array
    {
        return $this->secondarySponsor;
    }

    public function setSecondarySponsor(?array $secondarySponsor): static
    {
        $this->secondarySponsor = $secondarySponsor;

        return $this;
    }

    public function getSeetingsID(): ?Setting
    {
        return $this->seetingsID;
    }

    public function setSeetingsID(?Setting $seetingsID): static
    {
        $this->seetingsID = $seetingsID;

        return $this;
    }

    /**
     * @return Collection<int, Statistic>
     */
    public function getStatisticID(): Collection
    {
        return $this->statisticID;
    }

    public function addStatisticID(Statistic $statisticID): static
    {
        if (!$this->statisticID->contains($statisticID)) {
            $this->statisticID->add($statisticID);
            $statisticID->setTournament($this);
        }

        return $this;
    }

    public function removeStatisticID(Statistic $statisticID): static
    {
        if ($this->statisticID->removeElement($statisticID)) {
            // set the owning side to null (unless already changed)
            if ($statisticID->getTournament() === $this) {
                $statisticID->setTournament(null);
            }
        }

        return $this;
    }
}
