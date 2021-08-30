<?php

namespace App\Form;

use App\Entity\Mariage;
use App\Entity\Commity;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;

class MariageType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('dateMariage', DateType::class, [
                'widget' => 'single_text',
                'required' => false
            ])
            ->add('mari', EntityType::class, [
                'class' => Commity::class,
                'query_builder' => function($mari){
                    return $this->getSituation($mari, 'PERE');
                },
                'choice_label'  => 'nomFamille',
                'required' => true
            ])
            ->add('marie', EntityType::class,[
                'class' => Commity::class,
                'query_builder' => function($marie){
                    return $this->getSituation($marie, 'MERE');
                },
                'required' => true,
                'choice_label'  => 'nomFamille',
            ])
            ->add('nomFamille', TextType::class, [
                'required' => true
            ]);
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
            'data_class' => Mariage::class
        ]);
    }
}