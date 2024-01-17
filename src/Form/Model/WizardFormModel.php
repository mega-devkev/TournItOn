<?php

namespace App\Form\Model;
use App\Entity\Sponsor;

class WizardFormModel
{
    public ?\DateTimeInterface $startTime = null;
    public ?\DateTimeInterface $endTime = null;
    public ?string $location = null;
    public ?string $name = null;
    public ?string $logoURL = null;
    public ?string $mainSponsor = null;
    public ?string $secondarySponsor = null;

    public ?string $sponsorName = null;
    public ?string $url = null;

    public ?string $backgroundURL = null;
    public ?string $playerCard = null;
    public ?string $textcolor = null;
    public ?string $wincolor = null;
    public ?string $loosecolor = null;

    public ?string $playerOrTeamName = null;
    public ?array $statistics = [];
    



}
