<?php

namespace App\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\DateTimeType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\ButtonType;
use Symfony\Component\Form\Extension\Core\Type\FileType;
use Symfony\Component\Form\FormBuilderInterface;
use App\Form\CreateWizardFlow;

class CreateWizardForm extends AbstractType {

	public function buildForm(FormBuilderInterface $builder, array $options) {
        $options['allow_extra_fields'] = true;
        //dd($options);
		switch ($options['flow_step']) {
			case 1:
				$builder
                    ->add('Name')
                    ->add('Location')
                    ->add('StartDate', DateTimeType::class, array(
                        'required' => true,
                        'label' => 'Start Date',
                        'translation_domain' => 'AppBundle',
                        'attr' => array(
                            'class' => 'form-control input-inline datetimepicker',
                            'data-provide' => 'datepicker',
                            'data-format' => 'dd-mm-yyyy HH:ii',
                        ),
                    ))
                    ->add('EndDate', DateTimeType::class, array(
                        'required' => true,
                        'label' => 'End Date',
                        'translation_domain' => 'AppBundle',
                        'attr' => array(
                            'class' => 'form-control input-inline datetimepicker',
                            'data-provide' => 'datepicker',
                            'data-format' => 'dd-mm-yyyy HH:ii',
                        ),
                    ));
				break;
			case 2:
                $builder
                    ->add('Logo', FileType::class, array(
                        'required' => true,
                        'label' => 'Upload a Logo',
                    ))
                    ->add('Mainsponsor', FileType::class, array(
                        'required' => true,
                        'label' => 'Upload the Logo for the Mainsponsor',
                    ))
                    ->add('Sponsors', FileType::class, array(
                        'required' => true,
                        'label' => 'Upload the Logo for other sponsors',
                    ));
				break;
            case 3:
                $builder
                    ->add('PlayerCard', ChoiceType::class, array(
                        'choices' => [
                            'test' => 'testValue',
                        ],
                        ))
                    ->add('TextColor')
                    ->add('Font')
                    ->add('PrimaryColor')
                    ->add('SecondaryColor')
                    ->add('BackgroundImage', FileType::class, array(
                        'required' => true,
                        'label' => 'Upload a Background Image',
                    ));
                break;
            case 4:
                $builder
                    ->add('PlayerOrTeamName')
                    ->add('Stats')
                    ->add('Add', ButtonType::class);
                break;
		}
	}

	public function getBlockPrefix() {
		return 'createWizard';
	}

}