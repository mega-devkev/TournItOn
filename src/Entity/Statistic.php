<?php

namespace App\Entity;

use App\Repository\StatisticRepository;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: StatisticRepository::class)]
class Statistic
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(type: Types::DATETIME_MUTABLE, nullable: true)]
    private ?\DateTimeInterface $currentTime = null;

    #[ORM\Column(type: Types::ARRAY, nullable: true)]
    private ?array $statistics = null;

    #[ORM\ManyToOne(inversedBy: 'statisticID')]
    private ?Tournament $tournament = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getCurrentTime(): ?\DateTimeInterface
    {
        return $this->currentTime;
    }

    public function setCurrentTime(?\DateTimeInterface $currentTime): static
    {
        $this->currentTime = $currentTime;

        return $this;
    }

    public function getStatistics(): ?array
    {
        return $this->statistics;
    }

    public function setStatistics(?array $statistics): static
    {
        $this->statistics = $statistics;

        return $this;
    }

    public function getTournament(): ?Tournament
    {
        return $this->tournament;
    }

    public function setTournament(?Tournament $tournament): static
    {
        $this->tournament = $tournament;

        return $this;
    }

}
