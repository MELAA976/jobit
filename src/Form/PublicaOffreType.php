<?php

namespace App\Form;

use App\Entity\Category;
use App\Entity\PublicaOffre;
use App\Entity\TypeContrat;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfonycasts\DynamicForms\DependentField;
use Symfonycasts\DynamicForms\DynamicFormBuilder;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;


class PublicaOffreType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        // Créez un DynamicFormBuilder pour gérer les champs dépendants
        $builder = new DynamicFormBuilder($builder);

        // Ajoutez les champs de base du formulaire
        $builder
            ->add('intituler')
            ->add('description')
            ->add('lieu')

            ->add('category', EntityType::class, [
                'class' => Category::class,
                'choice_label' => 'nom',
            ])
            ->add('typeContrat', EntityType::class, [
                'class' => TypeContrat::class,
                'choice_label' => 'nom',
                'multiple' => false,
            ])

            // Ajoutez un champ dépendant basé sur le type de contrat sélectionné
            ->addDependent('duree', 'typeContrat', function (DependentField $field, ?TypeContrat $typeContrat) {
                if ($typeContrat && $typeContrat->getId() === 2) {
                    $field->add(TextType::class, [
                        'label' => 'Durée du Contrat?'
                    ]);
                }
            });
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        // Configurez les options par défaut pour le formulaire
        $resolver->setDefaults([
            'data_class' => PublicaOffre::class,
        ]);
    }
}
