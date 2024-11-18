<?php

namespace App\Twig\Components;

use App\Form\RegistrationFormType;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Form\FormInterface;
use Symfony\UX\LiveComponent\Attribute\AsLiveComponent;
use Symfony\UX\LiveComponent\ComponentWithFormTrait;
use Symfony\UX\LiveComponent\DefaultActionTrait;

#[AsLiveComponent]
final class Register extends AbstractController //extends l'abstract controller
{
    use ComponentWithFormTrait;
    use DefaultActionTrait;
    protected function instantiateForm(): FormInterface //instancier instantiateForm
    {
        return $this->createForm(RegistrationFormType::class); //elle nous retourne notre formulaire
    }
}
