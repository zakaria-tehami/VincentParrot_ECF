<?php

namespace App\Controller\Admin;

use App\Entity\Service;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;
use EasyCorp\Bundle\EasyAdminBundle\Field\IdField;
use EasyCorp\Bundle\EasyAdminBundle\Field\ImageField;
use EasyCorp\Bundle\EasyAdminBundle\Field\SlugField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextareaField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextEditorField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;
use EasyCorp\Bundle\EasyAdminBundle\Config\Crud;

class ServiceCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return Service::class;
    }

    
    public function configureFields(string $pageName): iterable
    {
        
        yield TextField::new('name');
        yield SlugField::new('slug')
            ->setTargetFieldName('name');
        yield TextareaField::new('description');

        $mediaDir = $this->getParameter('medias_directory');
        $uploadsDir = $this->getParameter('uploads_directory');

        $imageField = ImageField::new('image', 'Média')
        ->setBasePath($uploadsDir)
        ->setUploadDir($mediaDir)
        ->setUploadedFileNamePattern('[slug]-[uuid].[extension]');

        if(Crud::PAGE_EDIT === $pageName) {
            $imageField->setRequired(false);
        }

        yield $imageField;
        
    }
    
}
