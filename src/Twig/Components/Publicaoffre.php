<?php

namespace App\Twig\Components;

use App\Form\PublicaOffreType;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Form\FormInterface;
use Symfony\UX\LiveComponent\Attribute\AsLiveComponent;
use Symfony\UX\LiveComponent\ComponentWithFormTrait;
use Symfony\UX\LiveComponent\DefaultActionTrait;

#[AsLiveComponent]
final class Publicaoffre extends AbstractController
{
    use ComponentWithFormTrait;
    use DefaultActionTrait;
    protected function instantiateForm(): FormInterface
    {
        return $this->createForm(PublicaOffreType::class);
    }
}
