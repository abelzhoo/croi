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
            ->add('adressePermanente', TextType::class, [
                'attr' => ['class' => 'span11'],
                'required' => false
            ])
            ->add('adresseTemporaire', TextType::class, [
                'attr' => ['class' => 'span11'],
                'required' => false
            ])
            ->add('montantLoyer', NumberType::class, [
                'attr' => ['class' => 'span11'],
                'required' => false
            ])
            ->add('montantSyndic', NumberType::class, [
                'attr' => ['class' => 'span11'],
                'required' => false
            ])
            ->add('nomPays', ChoiceType::class, [
                'choices' => [
                    "Choisissez le pays" => ""
                ],
                'attr' => ['class' => 'span11 pays'],
                'required' => false
            ])
            ->add('province', ChoiceType::class, [
                'choices' => [
                    "Choisissez le province" => ""
                ],
                'attr' => ['class' => 'span11 province'],
                'required' => false
            ])
            ->add('region', ChoiceType::class, [
                'choices' => [
                    "Choisissez la région" => ""
                ],
                'attr' => ['class' => 'span11 region'],
                'required' => false
            ])
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
