<?php

namespace App\Controller;

use App\Entity\Setting;
use App\Entity\Tournament;
use App\Repository\PlayerRepository;
use App\Repository\SettingRepository;
use App\Repository\TournamentRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class HomeController extends AbstractController
{

    #[Route('/', name: 'app_home')]
    public function index(TournamentRepository $tournamentRepository): Response
    {

        if (!$this->getUser()) {
            $userRoute = ['login', 'login', '/assets/images/user.png'];

        } else {
            $userRoute = ['My Tournaments', 'tournaments', '/assets/images/mytourns.png'];
        }

        return $this->render('home/index.html.twig', [
            'route_type' => $userRoute,
            'tournaments' => $tournaments = $tournamentRepository->findAll()
        ]);
    }

    #[Route('/detail/{id}', name: 'app_detail')]
    public function details(TournamentRepository $tournamentRepository,SettingRepository $settingRepository, Request $request): Response
    {
        $detailId = $request->attributes->get('id');

        $tournament = $tournamentRepository->findOneBy(['id' => $detailId]);

        $matches = (array) $this->settingAsArray($settingRepository->findOneBy(['id' => 5]));

        return $this->render('home/detail.html.twig', [
            'tournament' => $tournament,
            'players' => $matches,
            'lvl' => (log($matches['playerCard'],2) + 1)
        ]);
    }

    #[Route('/settings/{id}', name: 'app_settings')]
    public function settings(TournamentRepository $tournamentRepository): Response
    {
        $userAsArray = (array) $this->searchUser();
        $tournaments = $tournamentRepository->findBy(['userId' => $userAsArray['id']]);

        return $this->render('home/settings.html.twig', [
            'tournaments' => $tournaments
        ]);
    }
    #[Route('/tournaments', name: 'app_tournaments')]
    public function myTournaments(TournamentRepository $tournamentRepository): Response
    {
        $userAsArray = (array) $this->searchUser();

        $tournaments = $tournamentRepository->findBy(['userId' => $userAsArray['id']]);

        return $this->render('home/myTournaments.html.twig', [
            'route_type' =>['My Tournaments', '#'],
            'tournaments' => $tournaments
        ]);
    }

    private function searchUser()
    {
        return json_decode($this->container->get('serializer')->serialize($this->getuser(), 'json'));
    }

    private function settingAsArray(Setting $setting){
        return json_decode($this->container->get('serializer')->serialize($setting, 'json'));
    }
}
