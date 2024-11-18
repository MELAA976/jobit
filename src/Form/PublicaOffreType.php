<?php

namespace App\Form;

use App\Entity\Category;
use App\Entity\PublicaOffre;
use App\Entity\TypeContrat;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class PublicaOffreType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('intituler')
            ->add('description')
            /*->add('datePublication', null, [
                'widget' => 'single_text',
            ])*/
            /*->add('dateModification', null, [
                'widget' => 'single_text',
            ])*/
            ->add('lieu')

            ->add('category', EntityType::class, [
                'class' => Category::class,
                'choice_label' => 'nom',
            ])
            /*->add('User', EntityType::class, [
                'class' => User::class,
                'choice_label' => 'id',
            ])*/
            ->add('typeContrat', EntityType::class, [
                'class' => TypeContrat::class,
                'choice_label' => 'nom',
                'multiple' => false,
            ])
            ->add('duree')
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => PublicaOffre::class,
        ]);
    }
}
