<?php


namespace App\Controller\Admin;

use App\Entity\Stractegie;
use EasyCorp\Bundle\EasyAdminBundle\Config\Crud;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;
use EasyCorp\Bundle\EasyAdminBundle\Field\AssociationField;
use EasyCorp\Bundle\EasyAdminBundle\Field\DateTimeField;
use EasyCorp\Bundle\EasyAdminBundle\Field\IdField;
use EasyCorp\Bundle\EasyAdminBundle\Field\ImageField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextEditorField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;
use FOS\CKEditorBundle\Form\Type\CKEditorType;
use Vich\UploaderBundle\Form\Type\VichFileType;

class StrategieCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return Stractegie::class;
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
            AssociationField::new('category')->hideOnIndex()->onlyOnForms(),
            TextField::new('titre'),
            TextEditorField::new('contenu')->setFormType(CKEditorType::class),
            TextField::new('slug'),
            TextField::new('auteur'),
            DateTimeField::new('created_at')->setTimezone('Europe/Paris')->setFormat('dd/MM/yy H:mm'),

        ];
    }

}
