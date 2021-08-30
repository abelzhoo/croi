<?php

namespace App\Form;

use App\Entity\Education;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\CountryType;
use Symfony\Component\Form\Extension\Core\Type\NumberType;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;

class EducationType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('nomEcole', TextType::class, ['attr' => ['class' => 'span11']])
            ->add('nomUniversite', TextType::class, ['attr' => ['class' => 'span11']])
            ->add('classe', TextType::class, ['attr' => ['class' => 'span11']])
            ->add('carteEtudiant', TextType::class, ['attr' => ['class' => 'span11']])
            ->add('adresseEcole', TextType::class, ['attr' => ['class' => 'span11']])
            ->add('adresseUniversite', TextType::class, ['attr' => ['class' => 'span11']])
            ->add('diplome', TextType::class, ['attr' => ['class' => 'span11']])
            ->add('anneeScolaire', DateType::class, [
                'widget' => 'single_text',
                'required' => false,
                'attr' => ['class' => 'span11']
            ])
            ->add('nomPays', CountryType::class, ['attr' => ['class' => 'span11']])
            ->add('province', TextType::class, ['attr' => ['class' => 'span11']])
            ->add('niveauEtude', TextType::class, ['attr' => ['class' => 'span11']])
            ->add('aideEducation', ChoiceType::class,[
                'choices' => [
                    "Vous avez des aides ?" => "",
                    'OUI' => 'oui',
                    'NON' => 'non'
                ],
                'attr' => ['class' => 'span11']
            ]);
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Education::class
        ]);
    }
}
