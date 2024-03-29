<?php

namespace App\Controller\Admin;

use App\Entity\Car;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;
use EasyCorp\Bundle\EasyAdminBundle\Field\AssociationField;
use EasyCorp\Bundle\EasyAdminBundle\Field\IdField;
use EasyCorp\Bundle\EasyAdminBundle\Field\SlugField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextEditorField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;

class CarCrudController extends AbstractCrudController
{

    
    public static function getEntityFqcn(): string
    {
        return Car::class;
    }


    
    public function configureFields(string $pageName): iterable
    {
        
            yield TextField::new('name');
            yield SlugField::new('slug')
                ->setTargetFieldName('name');
            yield TextEditorField::new('caracteristics');
            yield TextField::new('price');
            yield TextField::new('year');
            yield TextField::new('kilometer');
            yield TextField::new('energy');
            yield AssociationField::new('user');
            yield AssociationField::new('carImage');
        
    }
}
