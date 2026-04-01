<?php

namespace App\Controller\Admin;

use App\Entity\VetVisit;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;
use EasyCorp\Bundle\EasyAdminBundle\Field\AssociationField;
use EasyCorp\Bundle\EasyAdminBundle\Field\DateField;
use EasyCorp\Bundle\EasyAdminBundle\Field\IdField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextareaField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextEditorField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TimeField;

class VetVisitCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return VetVisit::class;
    }

    
    public function configureFields(string $pageName): iterable
    {
        yield AssociationField::new('animal', 'Animal');
        yield DateField::new('date', 'Date');
        yield TimeField::new('time', 'Heure');
        yield TextField::new('health', 'Etat de santé');
        yield TextField::new('food', 'Nourriture');
        yield TextField::new('quantity', 'Ration');
        yield TextareaField::new('details', 'Détails');
    }
    
}
