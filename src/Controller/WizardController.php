<?php

namespace App\Controller;

use Craue\FormFlowBundle\Form\FormFlowInterface;
use Craue\FormFlowBundle\Util\FormFlowUtil;
use App\Entity\Tournament;
use App\Entity\Setting;
use App\Entity\Sponsor;
use App\Entity\Player;
use App\Entity\Team;
use App\Entity\Statistic;
use Symfony\Component\HttpFoundation\File\UploadedFile;
use App\Form\Model\WizardFormModel;
use App\Form\CreateWizardFlow;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Twig\Environment;

class WizardController extends AbstractController {

	/**
	 * @var FormFlowUtil
	 */
	private $formFlowUtil;

	/**
	 * @var Environment
	 */
	private $twig;
	
	private $arrStepsInfos = [];

	public function __construct(FormFlowUtil $formFlowUtil, Environment $twig) {
		$this->formFlowUtil = $formFlowUtil;
		$this->twig = $twig;
	}

	#[Route('/wizard', name: 'app_wizard')]
	public function createWizard(Request $request, CreateWizardFlow $flow, EntityManagerInterface $entityManager) {
		$iStep = intval($request->request->get($flow->getFormStepKey(), 1));
		return $this->processFlow($request, $flow,
				'wizard/index.html.twig', $entityManager, $iStep);
	}

	protected function processFlow(Request $request, FormFlowInterface $flow, $template, $entityManager, $iStep) {
		$formData = new WizardFormModel();
		$flow->bind($formData);
		// $this->arrStepsInfos[$flow->getCurrentStepNumber()] = $request->request->all('createWizard');
		
		#dd(['test' => $_SESSION]);
		

		$form = $submittedForm = $flow->createForm();
		if ($flow->isValid($submittedForm)) {
			$flow->saveCurrentStepData($submittedForm);

			if ($flow->nextStep()) {
				// create form for next step
				$form = $flow->createForm();
			} else {
				// flow finished
				// ...

				$tournament = new Tournament();
				$setting = new Setting();
				$sponsor = new Sponsor();
				$team = new Team();
				$player = new Player();
				$statistic = new Statistic();


				$sponsor->setUrl($flow->getFormData()->mainSponsor);

			
				$tournament->setStartTime($flow->getFormData()->startTime);
				$tournament->setEndTime($flow->getFormData()->endTime);
				$tournament->setLocation($flow->getFormData()->location);
				$tournament->setName($flow->getFormData()->name);					$tournament->setLogoURL($flow->getFormData()->logoURL);
				$tournament->setMainSponsor($sponsor);
				$tournament->setSecondarySponsor([$flow->getFormData()->secondarySponsor]);
						
				$setting->setPlayerCard($flow->getFormData()->playerCard);
				$setting->setTextcolor($flow->getFormData()->textcolor);
				$setting->setWincolor($flow->getFormData()->wincolor);
				$setting->setLoosecolor($flow->getFormData()->loosecolor);
				$setting->setBackgroundURL($flow->getFormData()->backgroundURL);

				$player->setTeamID($team);
				$player->setName($flow->getFormData()->playerOrTeamName);

				// todo: Prüfung ob Player oder Team toggled ist
				// $team->setName($flow->getFormData()->playerOrTeamName);


				// todo: statistic fehlt noch
				



				
				$entityManager->persist($sponsor);
				$entityManager->flush();

				 $entityManager->persist($tournament);
				 $entityManager->flush();
				 
				 $entityManager->persist($setting);
				 $entityManager->flush();

				 $entityManager->persist($team);
				 $entityManager->flush();

				 $entityManager->persist($player);
				 $entityManager->flush();

				$flow->reset();

				return $this->redirectToRoute('app_home');
			}
		}

		if ($flow->redirectAfterSubmit($submittedForm)) {
			$params = $this->formFlowUtil->addRouteParameters(array_merge($request->query->all(),
					$request->attributes->get('_route_params')), $flow);

			return $this->redirectToRoute($request->attributes->get('_route'), $params);
		}

		return new Response($this->twig->render($template, [
			'form' => $form->createView(),
			'flow' => $flow,
			'formData' => $formData,
		]));
	}

}