<?php

namespace App\Controller\Admin;

use App\Entity\CarImage;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;
use EasyCorp\Bundle\EasyAdminBundle\Field\IdField;
use EasyCorp\Bundle\EasyAdminBundle\Field\ImageField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextEditorField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;
use EasyCorp\Bundle\EasyAdminBundle\Config\Crud;

class CarImageCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return CarImage::class;
    }

    
    public function configureFields(string $pageName): iterable
    {
        $mediaDir = $this->getParameter('medias_directory');
        $uploadsDir = $this->getParameter('uploads_directory');

        $imageField = ImageField::new('filename', 'Média')
        ->setBasePath($uploadsDir)
        ->setUploadDir($mediaDir)
        ->setUploadedFileNamePattern('[slug]-[uuid].[extension]');

        if(Crud::PAGE_EDIT === $pageName) {
            $imageField->setRequired(false);
        }

        yield $imageField;
    }
    
}
