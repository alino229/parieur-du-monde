<?php

namespace App\Form;

use App\Entity\Vip;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class VipType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('abonnement',ChoiceType::class,[
                'choices'  => [
                    'SEMAINE' => 'SEMAINE',
                    'MOIS'     => 'MOIS',
                    'ANNUEL'    => 'ANNUEL',

                ],
            ])
            ->add('active')
            ->add('user')
            ->add('sauvegarder',SubmitType::class)
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Vip::class,
        ]);
    }
}
