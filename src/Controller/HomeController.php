<?php

namespace App\Controller;

use App\Entity\Tournament;
use App\Repository\TournamentRepository;
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
            $userRoute = ['login', 'login'];

        } else {
            $userRoute = ['My Tournaments', 'tournaments'];
        }

        return $this->render('home/index.html.twig', [
            'route_type' => $userRoute,
            'tournaments' => $tournaments = $tournamentRepository->findAll()
        ]);
    }

    #[Route('/detail/{id}', name: 'app_detail')]
    public function details(TournamentRepository $tournamentRepository, Request $request): Response
    {
        $detailId = $request->attributes->get('id');

        $tournament = $tournamentRepository->findOneBy(['id' => $detailId]);

        return $this->render('home/detail.html.twig', [
            'tournament' => $tournament
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

    #[Route('/tournaments/new', name: 'app_new_tournaments')]
    public function newTournament(Request $request, TournamentRepository $tournamentRepository): Response
    {
        $user = new Tournament();
        $form = $this->createForm(RegistrationFormType::class, $user);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            // encode the plain password
            $user->setPassword(
                $userPasswordHasher->hashPassword(
                    $user,
                    $form->get('password')->getData()
                )
            );

            $entityManager->persist($user);
            $entityManager->flush();
            // do anything else you need here, like send an email
            // TODO: redirect ändern
            return $this->redirectToRoute('app_home');
        }
    }

    private function searchUser()
    {
        return json_decode($this->container->get('serializer')->serialize($this->getuser(), 'json'));
    }
}
