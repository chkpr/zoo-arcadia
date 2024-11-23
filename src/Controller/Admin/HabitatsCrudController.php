<?php

namespace App\Controller\Admin;

use App\Entity\Habitats;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;
use EasyCorp\Bundle\EasyAdminBundle\Field\IdField;
use EasyCorp\Bundle\EasyAdminBundle\Field\ImageField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextareaField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextEditorField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;
use Vich\UploaderBundle\Form\Type\VichImageType;

class HabitatsCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return Habitats::class;
    }

    
    public function configureFields(string $pageName): iterable
    {
        $mappingsParams = $this->getParameter('vich_uploader.mappings');

        $habitatImagePath = $mappingsParams['habitat']['uri_prefix'];

        yield TextField::new('name', 'Nom');
        yield TexteditorField::new('Description', 'Description');
        yield ImageField::new('imageName', 'Image')->setBasePath($habitatImagePath)->hideOnForm();
        yield TextareaField::new('imageFile')->setFormType(VichImageType::class)->hideOnIndex();

    }
    
}
