<?php

namespace App\Form;

use App\Entity\Article;

use App\Form\Datatransformer\FrenshToDateTimeTransformer;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use FOS\CKEditorBundle\Form\Type\CKEditorType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Vich\UploaderBundle\Form\Type\VichImageType;

class ArticleType extends AbstractType
{
   private $transform;
    public function __construct(FrenshToDateTimeTransformer $frenshToDateTimeTransformer)
    {
        $this->transform=$frenshToDateTimeTransformer;
    }

    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('titre')
            ->add('contenu', CKEditorType::class, array(
                'config' => array(
                    'uiColor' => '#ffffff',
                    //...
                ),))
            ->add('slug')
            ->add('auteur')
            ->add('imageFile',VichImageType::class)
            ->add('imageAlt')
            ->add('imageTitre')
            ->add('metaDesciption')
            ->add('published')
            ->add('sauvegarder',SubmitType::class)

        ;

    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Article::class,
        ]);
    }
}
