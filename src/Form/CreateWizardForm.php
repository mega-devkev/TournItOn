<?php

namespace App\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\DateTimeType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\ButtonType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\FileType;
use Symfony\Component\Form\FormBuilderInterface;
use App\Entity\Tournament;
use Symfony\Component\OptionsResolver\OptionsResolver;

class CreateWizardForm extends AbstractType {

	public function buildForm(FormBuilderInterface $builder, array $options) {
		switch ($options['flow_step']) {
			case 1:
				$builder
                    ->add('name')
                    ->add('location')
                    ->add('startTime', DateTimeType::class, array(
                        'required' => true,
                        'label' => 'Start Date',
                    
                        'translation_domain' => 'AppBundle',
                        'attr' => array(
                            'class' => 'form-control input-inline datetimepicker',
                            'data-provide' => 'datepicker',
                            'data-format' => 'dd-mm-yyyy HH:ii',
                        ),
                    ))
                    ->add('endTime', DateTimeType::class, array(
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
                    ->add('logoURL', FileType::class, array(
                        'required' => false,
                        'label' => 'Upload a Logo',
                        
                    ))
                    ->add('mainSponsor', FileType::class, array(
                        'required' => false,
                        'label' => 'Upload the Logo for the Mainsponsor',
                        
                    ))
                    ->add('secondarySponsor', FileType::class, array(
                        'required' => false,
                        'label' => 'Upload the Logo for other sponsors',

                    ));
				break;
            case 3:
                $builder
                    ->add('PlayerCard', ChoiceType::class, array(
                        'mapped' => false,
                        'choices' => [
                            'test' => 'testValue',
                        ],
                        ))
                    ->add('TextColor', null, array(
                        'mapped' => false,
                    ))
                    ->add('Font',  null, array(
                        'mapped' => false,
                    ))
                    ->add('PrimaryColor',  null, array(
                        'mapped' => false,
                    ))
                    ->add('SecondaryColor',  null, array(
                        'mapped' => false,
                    ))
                    ->add('BackgroundImage', FileType::class, array(
                        'required' => true,
                        'label' => 'Upload a Background Image',
                        'mapped' => false,
                    ));
                break;
            case 4:
                $builder
                    ->add('PlayerOrTeamName', null, array(
                        'mapped' => false,
                    ))
                    ->add('Stats', null, array(
                        'mapped' => false,
                    ))
                    ->add('Add', ButtonType::class);
                break;
		}
	}

	public function getBlockPrefix() {
		return 'createWizard';
	}

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data' => new Tournament(),
        ]);
    }

}