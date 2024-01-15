<?php

namespace App\Form;

use Craue\FormFlowBundle\Form\FormFlow;
use Craue\FormFlowBundle\Form\FormFlowInterface;
use App\Form\CreateWizardForm;

class CreateWizardFlow extends FormFlow {

	protected function loadStepsConfig() {
		return [
			1 => [
				'label' => 'Allgemein',
				'form_type' => CreateWizardForm::class,
			],
			2 => [
				'label' => 'Logo',
				'form_type' => CreateWizardForm::class,
			],
			3 => [
				'label' => 'Individualisierung',
                'form_type' => CreateWizardForm::class,
			],
            4 => [
               'label' => 'Player-Team',
               'form_type' => CreateWizardForm::class, 
            ],
		];
	}
}