<?php

namespace App\Controller\Admin;

use App\Entity\Vip;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;
use EasyCorp\Bundle\EasyAdminBundle\Field\AssociationField;
use EasyCorp\Bundle\EasyAdminBundle\Field\DateTimeField;
use EasyCorp\Bundle\EasyAdminBundle\Field\IdField;
use EasyCorp\Bundle\EasyAdminBundle\Field\IntegerField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextEditorField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;
use Symfony\Component\Validator\Constraints\Date;

class VipCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return Vip::class;
    }


    public function configureFields(string $pageName): iterable
    {
        return [
            IdField::new('id')->hideOnForm(),
            IntegerField::new('week')->setLabel('hebdomadaire '),
            IntegerField::new('month')->setLabel('mensuelle '),
            IntegerField::new('annuel')->setLabel('annuel '),
            AssociationField::new('user')->setLabel('utilisateur '),
            DateTimeField::new('date')->setLabel('date d\'abonnement ')->setTimezone('Europe/Paris')->setFormat('dd/MM/yy à H:mm'),
        ];
    }

}
