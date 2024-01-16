<?php

namespace App\Controller;

use Craue\FormFlowBundle\Form\FormFlowInterface;
use Craue\FormFlowBundle\Util\FormFlowUtil;
use App\Entity\Tournament;
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

	public function __construct(FormFlowUtil $formFlowUtil, Environment $twig) {
		$this->formFlowUtil = $formFlowUtil;
		$this->twig = $twig;
	}

	#[Route('/wizard', name: 'app_wizard')]
	public function createWizard(Request $request, CreateWizardFlow $flow, EntityManagerInterface $entityManager) {
		return $this->processFlow($request, new Tournament(), $flow,
				'wizard/index.html.twig', $entityManager);
	}

	protected function processFlow(Request $request, $formData, FormFlowInterface $flow, $template, $entityManager) {
		$flow->bind($formData);

		$form = $submittedForm = $flow->createForm();
		if ($flow->isValid($submittedForm)) {
			$flow->saveCurrentStepData($submittedForm);

			if ($flow->nextStep()) {
				// create form for next step
				$form = $flow->createForm();
			} else {
				// flow finished
				// ...
				$entityManager->persist($flow->getFormData());
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