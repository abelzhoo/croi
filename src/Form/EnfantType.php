<?php

namespace App\Form;

use App\Entity\Commity;
use App\Entity\Enfant;
use App\Entity\Mariage;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\Extension\Core\Type\NumberType;

class EnfantType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('enfant', EntityType::class, [
                'class' => Commity::class,
                'query_builder' => function($enfant){
                    return $this->getSituation($enfant, 'ENFANT');
                },
                'choice_label' => 'nomFamille',
                'multiple'      => true
            ])
            ->add('pere', EntityType::class, [
                'class' => Commity::class,
                'query_builder' => function($pere){
                    return $this->getSituation($pere, 'PERE');
                },
                'choice_label' => 'nomFamille'
            ])
            ->add('mere', EntityType::class, [
                'class' => Commity::class,
                'query_builder' => function($mere){
                    return $this->getSituation($mere, 'MERE');
                },
                'choice_label' => 'nomFamille'
            ])
            ->add('parent', EntityType::class, [
                'class' => Mariage::class,
                'query_builder' => function($parent){
                   return $this->getNameParent($parent);
                },
            ]);
    }

    private function getNameParent($mariage){
        return $mariage
                    ->createQueryBuilder('m');
    }

    private function getSituation($commity, $situationFamiliale){
        
        return $commity
                    ->createQueryBuilder('c')
                    ->where('c.situationFamiliale = :situationFamiliale')
                    ->setParameter('situationFamiliale', $situationFamiliale);
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Enfant::class
        ]);
    }
}
