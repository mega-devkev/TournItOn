<?php

namespace App\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\DateTimeType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\FormBuilderInterface;
use App\Form\CreateWizardFlow;

class CreateWizardForm extends AbstractType {

	public function buildForm(FormBuilderInterface $builder, array $options) {
        $options['flow_step'] = 1;
		switch ($options['flow_step']) {
			case 1:
				$builder
                    ->add('Name')
                    ->add('Location')
                    ->add('Start-Date', DateTimeType::class, array(
                        'required' => true,
                        'label' => 'form.label.datetime',
                        'translation_domain' => 'AppBundle',
                        'attr' => array(
                            'class' => 'form-control input-inline datetimepicker',
                            'data-provide' => 'datepicker',
                            'data-format' => 'dd-mm-yyyy HH:ii',
                        ),
                    ))
                    ->add('End-Date', DateTimeType::class, array(
                        'required' => true,
                        'label' => 'form.label.datetime',
                        'translation_domain' => 'AppBundle',
                        'attr' => array(
                            'class' => 'form-control input-inline datetimepicker',
                            'data-provide' => 'datepicker',
                            'data-format' => 'dd-mm-yyyy HH:ii',
                        ),
                    ))
                    ->add('submit', SubmitType::class);
				break;
			case 2:
				break;
            case 3:
                break;
            case 4:
                break;
		}
	}

	public function getBlockPrefix() {
		return 'createWizard';
	}

}