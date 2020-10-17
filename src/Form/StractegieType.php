<?php

namespace App\Form;

use App\Entity\Stractegie;
use FOS\CKEditorBundle\Config\CKEditorConfiguration;
use FOS\CKEditorBundle\Form\Type\CKEditorType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class StractegieType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('titre')
            ->add('contenu',CKEditorType::class)
            ->add('slug')
            ->add('auteur')

            ->add('category')
            ->add('published')
            ->add('Sauvegarder',SubmitType::class)
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Stractegie::class,
        ]);
    }
}
