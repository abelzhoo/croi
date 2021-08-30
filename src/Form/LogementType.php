<?php

namespace App\Form;

use App\Entity\Logement;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\CountryType;
use Symfony\Component\Form\Extension\Core\Type\NumberType;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;

class LogementType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('adressePermanente', TextType::class, ['attr' => ['class' => 'span11']])
            ->add('adresseTemporaire', TextType::class, ['attr' => ['class' => 'span11']])
            ->add('nomPays', CountryType::class, ['attr' => ['class' => 'span11']])
            ->add('province', TextType::class, ['attr' => ['class' => 'span11']])
            ->add('montantLoyer', NumberType::class, ['attr' => ['class' => 'span11']])
            ->add('montantSyndic', NumberType::class, ['attr' => ['class' => 'span11']])
            //->add('membre', EntityType::class)
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Logement::class
        ]);
    }
}
