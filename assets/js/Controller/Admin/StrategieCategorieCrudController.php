<?php


namespace App\Controller\Admin;


use App\Entity\Stractegie;
use App\Entity\StrategieCategorie;
use EasyCorp\Bundle\EasyAdminBundle\Config\Crud;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;
use EasyCorp\Bundle\EasyAdminBundle\Field\AssociationField;
use EasyCorp\Bundle\EasyAdminBundle\Field\DateTimeField;
use EasyCorp\Bundle\EasyAdminBundle\Field\IdField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextEditorField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;
use FOS\CKEditorBundle\Form\Type\CKEditorType;

class StrategieCategorieCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return StrategieCategorie::class;
    }
    public function configureCrud(Crud $crud): Crud
    {
        return $crud
            // the labels used to refer to this entity in titles, buttons, etc.
            ->setEntityLabelInSingular('Home article')
            ->setEntityLabelInPlural('Les articles de la page stractégie ')

            // the Symfony Security permission needed to manage the entity
            // (none by default, so you can manage all instances of the entity)
//            ->setEntityPermission('ROLE_EDITOR')
            ;
    }


    public function configureFields(string $pageName): iterable
    {
        return [
            IdField::new('id')->hideOnForm(),
            TextField::new('categorie'),


        ];
    }

}
