<?php

namespace App\Entity;

use App\Repository\SettingRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: SettingRepository::class)]
class Setting
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $backgroundURL = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $playerCard = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $textcolor = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $wincolor = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $loosecolor = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getBackgroundURL(): ?string
    {
        return $this->backgroundURL;
    }

    public function setBackgroundURL(?string $backgroundURL): static
    {
        $this->backgroundURL = $backgroundURL;

        return $this;
    }

    public function getPlayerCard(): ?string
    {
        return $this->playerCard;
    }

    public function setPlayerCard(?string $playerCard): static
    {
        $this->playerCard = $playerCard;

        return $this;
    }

    public function getTextcolor(): ?string
    {
        return $this->textcolor;
    }

    public function setTextcolor(?string $textcolor): static
    {
        $this->textcolor = $textcolor;

        return $this;
    }

    public function getWincolor(): ?string
    {
        return $this->wincolor;
    }

    public function setWincolor(?string $wincolor): static
    {
        $this->wincolor = $wincolor;

        return $this;
    }

    public function getLoosecolor(): ?string
    {
        return $this->loosecolor;
    }

    public function setLoosecolor(?string $loosecolor): static
    {
        $this->loosecolor = $loosecolor;

        return $this;
    }
}
