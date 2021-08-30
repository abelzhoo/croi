<?php

namespace App\Form;

use App\Entity\Sport;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;

class SportType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('pratiqueSport', ChoiceType::class, [
                'choices' => [
                    "Selectionnez ..." => "",
                    'OUI' => 'oui',
                    'NON' => 'non'
                ],
                'expanded' => false,
                'attr' => ['class' => 'span11']
            ])
            ->add('nomSport', TextType::class, ['attr' => ['class' => 'span11']])
            ->add('frequenceSport', TextType::class, ['attr' => ['class' => 'span11']])
            ->add('pratiqueLoisir', ChoiceType::class, [
                'choices' => [
                    "Selectionnez ..." => "",
                    'OUI' => 'oui',
                    'NON' => 'non'
                ],
                'expanded' => false,
                'attr' => ['class' => 'span11']
            ])
            ->add('nomLoisir', TextType::class, ['attr' => ['class' => 'span11']])
            //->add('membre', EntityType::class)
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Sport::class,
        ]);
    }
}
