<?php

namespace App\Form;

use App\Entity\Social;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;

class SocialType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('aideNourriture', ChoiceType::class,[
                'choices' => [
                    "Selectionnez" => "",
                    'OUI' => 'oui',
                    'NON' => 'non'
                ],
                'expanded' => false
            ])
            ->add('aideEducation', ChoiceType::class, [
                'choices' => [
                    "Selectionnez" => "",
                    'OUI' => 'oui',
                    'NON' => 'non'
                ],
                'expanded' => false
            ])
            ->add('aideSocial', ChoiceType::class, [
                'choices' => [
                    "Selectionnez" => "",
                    'OUI' => 'oui',
                    'NON' => 'non'
                ],
                'expanded' => false
            ])
            ->add('aideSante', ChoiceType::class, [
                'choices' => [
                    "Selectionnez" => "",
                    'OUI' => 'oui',
                    'NON' => 'non'
                ],
                'expanded' => false
            ])
            ->add('aideTravail', ChoiceType::class,[
                'choices' => [
                    "Selectionnez" => "",
                    'OUI' => 'oui',
                    'NON' => 'non'
                ],
                'expanded' => false
            ])
            //->add('membre', EntityType::class)
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Social::class
        ]);
    }
}
