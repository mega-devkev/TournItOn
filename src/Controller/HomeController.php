<?php

namespace App\Controller;

use App\Repository\TournamentRepository;
use App\Repository\UserRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class HomeController extends AbstractController
{

    #[Route('/', name: 'app_home')]
    public function index(TournamentRepository $tournamentRepository, UserRepository $userRepository): Response
    {
        $userAsArray = (array) json_decode($this->container->get('serializer')->serialize($this->getuser(), 'json'));

        if (!$this->getUser()) {
            $userRoute = ['login', 'login'];
            $tournaments = $tournamentRepository->findAll();

        } else {
            $userRoute = ['My Tournaments', 'tournament'];
            $tournaments = $tournamentRepository->findBy(['userId' => $userAsArray['id']]);
        }

        return $this->render('home/index.html.twig', [
            'route_type' => $userRoute,
            'tournaments' => $tournaments
        ]);
    }

}
