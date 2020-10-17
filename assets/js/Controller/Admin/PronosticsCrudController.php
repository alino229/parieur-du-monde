<?php

namespace App\Controller\Admin;

use App\Entity\Pronostics;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;
use EasyCorp\Bundle\EasyAdminBundle\Field\AssociationField;
use EasyCorp\Bundle\EasyAdminBundle\Field\BooleanField;
use EasyCorp\Bundle\EasyAdminBundle\Field\DateField;
use EasyCorp\Bundle\EasyAdminBundle\Field\DateTimeField;
use EasyCorp\Bundle\EasyAdminBundle\Field\IdField;
use EasyCorp\Bundle\EasyAdminBundle\Field\ImageField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextEditorField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TimeField;
use Vich\UploaderBundle\Form\Type\VichFileType;

class PronosticsCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return Pronostics::class;
    }


    public function configureFields(string $pageName): iterable
    {
        return [
            IdField::new('id')->hideOnForm(),
            BooleanField::new('published')->setLabel('Publier'),
            TextField::new('home')->setLabel('Domicile'),
            TextField::new('away')->setLabel('Extérieur'),
            TextField::new('competition')->setLabel('Compétition'),
            TextField::new('pays')->hideOnIndex()->setLabel('Pays'),
            TextField::new('pronostics')->setLabel('Pronostics '),
            TextField::new('cote')->setLabel('Cote'),
            TextField::new('resultat')->setLabel('Resultat'),
            BooleanField::new('resultValue')->setLabel('succès /échèc')->hideOnIndex(),
            DateField::new('day')->setLabel('Jour du match'),
            TimeField::new('time')->setLabel('Heure du match')->hideOnIndex(),
            ImageField::new('homeFlagFile')->setLabel('Logo équipe domicile ')->setFormType(VichFileType::class)->hideOnIndex(),
            ImageField::new('awayFlagFile')->setLabel('Logo équipe extérieure')->setFormType(VichFileType::class)->hideOnIndex(),
            DateTimeField::new('addDate')->setLabel('Date actuelle')->hideOnIndex()->setTimezone('Europe/Paris')->setFormat('dd/MM/yy H:mm'),
            AssociationField::new('category')->setLabel('Catégorie ')

        ];
    }

}
