<?php

namespace App\Form;

use App\Entity\Profession;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\MoneyType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\NumberType;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;

class ProfessionType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('domaineActivite', TextType::class, ['attr' => ['class' => 'span11']])
            ->add('salaire', MoneyType::class, ['attr' => ['class' => 'span11']])
            ->add('prime', MoneyType::class, ['attr' => ['class' => 'span11']])
            ->add('profession', ChoiceType::class, [
                "choices" => [
                    "COMMERCE" => "COMMERCE",
                    "IMPORTATEUR / EXPORTATEUR" => "IMPORTATEUR/EXPORTATEUR",
                    "TRADER" => "TRADER",
                    "REVENDEUR" => "REVENDEUR",
                    "PRESTATEUR DE SERVICE" => "PRESTATEUR DE SERVICE"
                ],
                'attr' => ['class' => 'span11'],
                "multiple" => true
            ])
            ->add('locataire', ChoiceType::class, [
                'choices' => [
                    "Selectionnez" => "",
                    'OUI' => 'oui',
                    'NON' => 'non'
                ],
                'expanded' => false,
                'attr' => ['class' => 'span11']
            ])
            ->add('personnel', TextType::class, ['attr' => ['class' => 'span11']])
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Profession::class
        ]);
    }
}
