<?php

namespace App\Controller\Admin;

use App\Entity\OpeningDay;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;
use EasyCorp\Bundle\EasyAdminBundle\Field\IdField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextareaField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextEditorField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;

class OpeningDayCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return OpeningDay::class;
    }

    
    public function configureFields(string $pageName): iterable
    {
        
            yield TextareaField::new('dayOfWeek');
            yield TextField::new('startTime');
            yield TextField::new('endTime');
        
    }
    
}
