<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use App\Form\CreateWizardForm;
use App\Form\CreateWizardFlow;


class WizardController extends AbstractController
{
    #[Route('/wizard', name: 'app_wizard')]
    public function index(CreateWizardFlow $flow): Response
    {
        //$formData = new Vehicle(); // Your form data class. Has to be an object, won't work properly with an array.

	//$flow = $this->get('tournItOn.form.flow.createWizard'); // must match the flow's service id
    
	//$flow->bind($formData);

	// form of the current step
	$form = $flow->createForm();
	if ($flow->isValid($form)) {
		$flow->saveCurrentStepData($form);

		if ($flow->nextStep()) {
			// form for the next step
			$form = $flow->createForm();
		} else {
			// flow finished
			$em = $this->getDoctrine()->getManager();
			$em->persist($formData);
			$em->flush();

			$flow->reset(); // remove step data from the session

			return $this->redirectToRoute('home'); // redirect when done
		}
	}

	return $this->render('wizard/index.html.twig', [
		'form' => $form->createView(),
		'flow' => $flow,
	]);
    }
}
