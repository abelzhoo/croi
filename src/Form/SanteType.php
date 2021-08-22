<?php

namespace App\Form;

use App\Entity\Sante;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\NumberType;
use Symfony\Component\Form\Extension\Core\Type\CollectionType;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;

class SanteType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('groupeSanguin', ChoiceType::class, [
                'choices' => [
                    "Votre groupe sanguin" => "",
                    "O" => "O",
                    "A" => "A",
                    "B" => "B",
                    "AB" => "AB"
                ]
            ])
            ->add('etat', ChoiceType::class, [
                'choices' => [
                    "Votre etat" => "",
                    "BON" => "bon",
                    "MOYEN" => "moyen",
                    "MAUVAIS" => "mauvais"
                ],
                'attr' => ['class' => 'form-control']
            ])
            ->add('maladieChronique', ChoiceType::class, [
                "choices" => [
                    "Vous avez des maladies chroniques ?" => "",
                    "OUI" => 'oui',
                    "NON" => 'non'
                ]
            ])
            ->add('tailles', TextType::class)
            ->add('poids', TextType::class)
            ->add('intervention', TextType::class)
            ->add('paysChirurgie', ChoiceType::class, [
                'choices' => [
                    "Selectionnez pays" => "",
                    "MADAGASCAR" => "madagascar",
                    "ETRANGERS" => "etrangers"
                ]
            ])
            ->add('nomMedicament', TextType::class)
            ->add('maladieRelative', TextType::class)
            ->add('limiteSante', TextType::class)
            ->add('tempsLimite', TextType::class)
            ->add('objetPorte', ChoiceType::class, [
                'choices' => [
                    "Choisir l'objet portez" => "",
                    "LUNETTE" => "lunette",
                    "PROTHESE DENT" => "prothese dent",
                    "AUTRE PROTHESE" => "autre prothese"
                ],
                'multiple' => true
            ])
            ->add('prixIntervention', TextType::class)
            ->add('traitementMedical', TextType::class)
            ->add('frequenceMaladie', TextType::class)
            ->add('dateDebut', DateType::class, [
                'widget' => 'single_text',
                'required' => false
            ])
            ->add('dateFin', DateType::class, [
                'widget' => 'single_text',
                'required' => false
            ])
            ->add('consultMedicin', TextType::class)
            ->add('bilanSanguin', TextType::class)
            ->add('obj', TextType::class)
            ->add('chirurgie', TextType::class);
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Sante::class,
        ]);
    }
}
