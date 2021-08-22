<?php

namespace App\Form;

use App\Entity\Commity;
use App\Form\SanteType;
use App\Form\SocialType;
use App\Form\TablighType;
use App\Form\EducationType;
use App\Form\LogementType;
use App\Form\SportType;

use App\Form\ProfessionType;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\CollectionType;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\Extension\Core\Type\FileType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Vich\UploaderBundle\Form\Type\VichImageType;

class CommityType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('nomFamille', TextType::class)
            ->add('prenomFamille', TextType::class)
            ->add('sexe', ChoiceType::class, [
                "choices" => [
                    "Selectionnez ..." => "",
                    "MASCULIN" => "masculin",
                    "FEMININ" => "feminin"
                ]
            ])
            ->add('dateNaissance', DateType::class, [
                'widget' => 'single_text',
                'required' => false
            ])
            ->add('lieuNaissance', TextType::class)
            ->add('nationalite', TextType::class)
            ->add('documentVoyage', ChoiceType::class, [
                "choices" => [
                    "Selectionnez ..." => "",
                    "Passeport officier" => "passeportOfficier",
                    "Passeport diplômatique" => "passeportDiplomatique"
                ],
                'expanded' => false,
            ])
            ->add('numeroPassport', TextType::class)
            ->add('numeroCin', TextType::class)
            ->add('situationMarital', TextType::class)
            ->add('numeroPhone', TextType::class)
            ->add('adresseEmail', TextType::class)
            ->add('situationFamiliale', ChoiceType::class, [
                "choices" => [
                    "Selectionnez ..." => "",
                    "PERE" => "pere",
                    "MERE" => "mere",
                    "ENFANT" => "enfant",
                ]
            ])
            ->add('imageFile', VichImageType::class)
            ->add('sante', SanteType::class)
            ->add('social' , SocialType::class)
            ->add('tabligh', TablighType::class)
            ->add('possession', CollectionType::class, [
                'entry_type' => LogementType::class,
                'entry_options' =>  ['label' => false],
                'allow_add' => true,
                'allow_delete' => true,

            ])
            ->add('etudiant', CollectionType::class, [
                'entry_type' => EducationType::class,
                'entry_options' =>  ['label' => false],
                'allow_add' => true,
                'allow_delete' => true,
            ])
            ->add('sport', CollectionType::class, [
                'entry_type' => SportType::class,
                'entry_options' =>  ['label' => false],
                'allow_add' => true,
                'allow_delete' => true
            ])
            ->add('profession', CollectionType::class, [
                'entry_type' => ProfessionType::class,
                'entry_options' =>  ['label' => false],
                'allow_add' => true,
                'allow_delete' => true
            ])
            ->add('save', SubmitType::class, ['label' => 'Ajouter Commité', 'attr' => ['class' => 'btn btn-success']]);
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Commity::class,
        ]);
    }
}
