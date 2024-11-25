<?php

namespace App\Controller\Admin;

use App\Entity\Animals;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;
use EasyCorp\Bundle\EasyAdminBundle\Field\AssociationField;
use EasyCorp\Bundle\EasyAdminBundle\Field\IdField;
use EasyCorp\Bundle\EasyAdminBundle\Field\ImageField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextareaField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextEditorField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;
use Vich\UploaderBundle\Form\Type\VichImageType;

class AnimalsCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return Animals::class;
    }

    
    public function configureFields(string $pageName): iterable
    {

        $mappingsParams = $this->getParameter('vich_uploader.mappings');

        $animalImagePath = $mappingsParams['animal']['uri_prefix'];

        yield TextField::new('name', 'Nom');
        yield TextField::new('Species', 'Espèces');
        yield TextField::new('latin', 'Nom latin');
        yield TextareaField::new('Description', 'Description');
        yield ImageField::new('imageName', 'Image')->setBasePath($animalImagePath)->hideOnForm();
        yield TextareaField::new('imageFile')->setFormType(VichImageType::class)->hideOnIndex();
        yield AssociationField::new('habitat', 'Habitat');
    }
    
}
