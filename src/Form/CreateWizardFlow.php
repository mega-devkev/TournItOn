<?php

namespace App\Form;

use Craue\FormFlowBundle\Form\FormFlow;
use Craue\FormFlowBundle\Form\FormFlowInterface;
use App\Entity\Setting;

class CreateWizardFlow extends FormFlow {

	/**
	 * {@inheritDoc}
	 */
	protected function loadStepsConfig() {
		$formType = CreateWizardForm::class;

		return [
			[
				'label' => 'Allgemeines',
				'form_type' => $formType,
			],
			[
				'label' => 'Logo',
				'form_type' => $formType,
			],
			[
				'label' => 'Individualisierung',
				'form_type' => $formType,
			],
			[
				'label' => 'Player / Team',
				'form_type' => $formType,
			],
			[
				'label' => 'confirmation',
			],
		];
	}

	public function getFormOptions($step, array $options = []) {
		$options = parent::getFormOptions($step, $options);
		// if($step === 3) {
		// 	$options['data'] = new Setting();
		// }

		return $options;
	}

}