<?php

namespace App\Controller\Admin;

use App\Entity\Habitats;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;
use EasyCorp\Bundle\EasyAdminBundle\Field\IdField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextareaField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextEditorField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;

class HabitatsCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return Habitats::class;
    }

    
    public function configureFields(string $pageName): iterable
    {
        yield TextField::new('name', 'Nom');
        yield TextareaField::new('Description', 'Description');
    }
    
}
