<?php

namespace App\Controller\Admin;

use App\Entity\User;
use EasyCorp\Bundle\EasyAdminBundle\Config\Crud;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;
use EasyCorp\Bundle\EasyAdminBundle\Field\ArrayField;
use EasyCorp\Bundle\EasyAdminBundle\Field\DateField;
use EasyCorp\Bundle\EasyAdminBundle\Field\IdField;
use EasyCorp\Bundle\EasyAdminBundle\Field\IntegerField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;

class UserCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return User::class;
    }

    //fonction pour configurer mon crude dans easy admin
    public function configureCrud(Crud $crud): Crud
    {
        return $crud
            ->setEntityLabelInSingular('Utilisateur') // Pour madifier le titre dans mon admin user
            ->setEntityLabelInPlural('Utilisateur') // Pour madifier le titre cree un utilisateur dans mon admin user
            // ...
        ;
    }

    //gestion des differents elements que les administrateurs pourrait géré
    public function configureFields(string $pageName): iterable
    {
        return [
            IdField::new(propertyName: 'id')->setLabel(label: 'Id')->hideWhenUpdating(),
            TextField::new(propertyName: 'nom')->setLabel(label: 'Nom')->hideWhenUpdating(), //permet d'afficher l'element mais pas de le modifier
            TextField::new(propertyName: 'prenom')->setLabel(label: 'Prenom')->hideWhenUpdating(),
            DateField::new(propertyName: 'date_naissance')->setLabel(label: 'Date de naissance')->hideWhenUpdating(),
            TextField::new(propertyName: 'adresse')->setLabel(label: 'Adresse')->hideWhenUpdating(),
            IntegerField::new(propertyName: 'telephone')->setLabel(label: 'Telephone')->hideWhenUpdating(),
            TextField::new(propertyName: 'email')->setLabel(label: 'Email')->hideWhenUpdating(),
            ArrayField::new(propertyName: 'roles')->setLabel(label: 'Role'),
            TextField::new(propertyName: 'photo')->setLabel(label: 'Photo')->hideWhenUpdating(),
            TextField::new(propertyName: 'token')->setLabel(label: 'Token')->hideWhenUpdating(),
            TextField::new(propertyName: 'logo')->setLabel(label: 'Logo')->hideWhenUpdating(),
            TextField::new(propertyName: 'presentation')->setLabel(label: 'Presentation')->hideWhenUpdating(),
            TextField::new(propertyName: 'site_web')->setLabel(label: 'site web')->hideWhenUpdating(),
            IdField::new(propertyName: 'entreprise_id')->setLabel(label: 'entreprise_id')->hideWhenUpdating(),
        ];
    }
}
