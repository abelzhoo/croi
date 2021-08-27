<?php

namespace App\Form;

use App\Entity\Deces;
use App\Entity\Commity;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;

class DecesType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('dateDeces', DateType::class, [
                'widget' => 'single_text',
                'required' => false
            ])
            ->add('dateEnterement', DateType::class, [
                'widget' => 'single_text',
                'required' => false
            ])
            ->add('personne', EntityType::class, [
                'class' => Commity::class,
                'choice_label' => 'nomFamille'
            ]);
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Deces::class
        ]);
    }
}
