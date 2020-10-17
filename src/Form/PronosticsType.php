<?php

namespace App\Form;

use App\Entity\Pronostics;
use App\Form\Datatransformer\FrenshToDateTimeTransformer;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\CountryType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Vich\UploaderBundle\Form\Type\VichImageType;

class PronosticsType extends AbstractType
{
    private $transform;
    public function __construct(FrenshToDateTimeTransformer $frenshToDateTimeTransformer)
    {
        $this->transform=$frenshToDateTimeTransformer;
    }

    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('home')
            ->add('away')
            ->add('competition')
            ->add('pays')
            ->add('pronostics')
            ->add('cote')
            ->add('day')
            ->add('time')
            ->add('homeFlagFile',VichImageType::class)
            ->add('awayFlagFile',VichImageType::class)
            ->add('published')
            ->add('category')
            ->add('save',SubmitType::class)
        ;

    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Pronostics::class,
        ]);
    }
}
