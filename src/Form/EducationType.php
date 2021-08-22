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
            ->add('nomEcole', TextType::class)
            ->add('nomUniversite', TextType::class)
            ->add('classe', TextType::class)
            ->add('carteEtudiant', TextType::class)
            ->add('adresseEcole', TextType::class)
            ->add('adresseUniversite', TextType::class)
            ->add('diplome', TextType::class)
            ->add('anneeScolaire', DateType::class, [
                'widget' => 'single_text',
                'required' => false
            ])
            ->add('nomPays', CountryType::class)
            ->add('province', TextType::class)
            ->add('niveauEtude', TextType::class)
            ->add('aideEducation', ChoiceType::class,[
                'choices' => [
                    "Vous avez des aides ?" => "",
                    'OUI' => 'oui',
                    'NON' => 'non'
                ]
                ]);
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Education::class
        ]);
    }
}
