<?php

namespace App\Form;

use App\Entity\Tabligh;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\NumberType;

class TablighType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('questionMadressa', ChoiceType::class, [
                'choices' => [
                    "Selectionnez ..." => "",
                    'OUI' => 'oui',
                    'NON' => 'non'
                ],
                'expanded' => false,
            ])
            ->add('classeMadressa', NumberType::class)
            ->add('frequentMadressa', ChoiceType::class, [
                'choices' => [
                    "Selectionnez ..." => "",
                    'OUI' => 'oui',
                    'NON' => 'non'
                ],
                'expanded' => false,
            ])
            ->add('frequentMosquet', ChoiceType::class, [
                'choices' => [
                    "Selectionnez ..." => "",
                    'prière du matin' => 'prière du matin',
                    'prière du midi' => 'prière du midi',
                    'prière du soir' => 'prière du soir',
                    'prière du vendredi' => 'prière du vendredi',
                    'jeudi soir' => 'jeudi soir',
                    'nuit de fêtes' => 'nuit de fêtes',
                    'nuits de deuil' => 'nuits de deuil',
                    'autres' => 'autres'
                ],
                'multiple' => true
            ])
            ->add('freqMosquetAnnee', TextType::class)
            ->add('proposition', TextareaType::class)
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Tabligh::class,
        ]);
    }
}
