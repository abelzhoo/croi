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
                'expanded' => false
            ])
            ->add('classeMadressa', NumberType::class)
            ->add('frequentMadressa', ChoiceType::class, [
                'choices' => [
                    "Selectionnez ..." => "",
                    'OUI' => 'oui',
                    'NON' => 'non'
                ],
                'expanded' => false
            ])
            ->add('frequentMosquet', ChoiceType::class, [
                'choices' => [
                    'PRIERE DU MATIN' => 'prière du matin',
                    'PRIERE DU MIDI' => 'prière du midi',
                    'PRIERE DU SOIR' => 'prière du soir',
                    'PRIERE DU JEUDI SOIR' => 'prière du jeudi',
                    'PRIERE DU VENDREDI SOIR' => 'prière du vendredi',
                    'NUITS DES FETES' => 'nuit de fêtes',
                    'NUIT DE DEUIL' => 'nuits de deuil',
                    'AUTRE' => 'autre'
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
