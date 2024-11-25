<?php

namespace App\Controller\Admin;

use App\Entity\Services;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;
use EasyCorp\Bundle\EasyAdminBundle\Field\IdField;
use EasyCorp\Bundle\EasyAdminBundle\Field\ImageField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextareaField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextEditorField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;
use Vich\UploaderBundle\Form\Type\VichImageType;

class ServicesCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return Services::class;
    }

    
    public function configureFields(string $pageName): iterable
    {

        $mappingsParams = $this->getParameter('vich_uploader.mappings');

        $serviceImagePath = $mappingsParams['service']['uri_prefix'];

        yield TextField::new('name', 'Nom');
        yield TextareaField::new('description', 'Description');
        yield TextField::new('OpeningHours', 'Horaires');
        yield ImageField::new('imageName', 'Image')->setBasePath($serviceImagePath)->hideOnForm();
        yield TextareaField::new('imageFile')->setFormType(VichImageType::class)->hideOnIndex();
    }
    
}
