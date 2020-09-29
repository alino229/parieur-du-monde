<?php

namespace App\Form;

use App\Entity\Forum;
use App\Entity\ForumMessage;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class ForumMessageType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('subject')
            ->add('body')
            ->add('forum',EntityType::class, [
                'class'=>Forum::class,
                'choice_label'=>'nom'
     ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => ForumMessage::class,
        ]);
    }
}
