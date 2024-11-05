<?php

namespace App\Form;

use App\Entity\Entreprise;
use App\Entity\User;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\CheckboxType;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\FileType;
use Symfony\Component\Validator\Constraints\File;
use Symfony\Component\Form\Extension\Core\Type\PasswordType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Validator\Constraints\IsTrue;
use Symfony\Component\Validator\Constraints\Length;
use Symfony\Component\Validator\Constraints\NotBlank;

class RegistrationFormType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('nom')
            ->add('prenom')
            ->add('date_naissance', DateType::class, [

                'widget' => 'single_text',
                // this is actually the default format for single_text
                'format' => 'yyyy-MM-dd',
                'html5' => true,
                'required' => false
            ])
            ->add('email')
            ->add('adresse')
            ->add('telephone')
            ->add(
                'photo',
                FileType::class,
                [
                    'required' => false,
                    'constraints' => [
                        new File([
                            //'maxSize' => '1024k',
                            'mimeTypes' => [
                                'image/*' //format accepter
                            ],
                            'mimeTypesMessage' => 'telecharger une image valide', //message de non conformiter de type de fichier
                        ])
                    ]

                ],

            )
            ->add(
                'logo',
                FileType::class,
                [
                    'required' => false,
                    'constraints' => [
                        new File([
                            //'maxSize' => '1024k',
                            'mimeTypes' => [
                                'image/*'
                            ],
                            'mimeTypesMessage' => 'telecharger une image valide',
                        ])
                    ]

                ]
            )
            ->add('presentation')
            ->add('site_web')
            ->add('agreeTerms', CheckboxType::class, [
                'mapped' => false,
                'constraints' => [
                    new IsTrue([
                        'message' => 'You should agree to our terms.',
                    ]),
                ],
            ])
            ->add('plainPassword', PasswordType::class, [
                // instead of being set onto the object directly,
                // this is read and encoded in the controller
                'mapped' => false,
                'attr' => ['autocomplete' => 'new-password'],
                'constraints' => [
                    new NotBlank([
                        'message' => 'Please enter a password',
                    ]),
                    new Length([
                        'min' => 6,
                        'minMessage' => 'Your password should be at least {{ limit }} characters',
                        // max length allowed by Symfony for security reasons
                        'max' => 4096,
                    ]),
                ],
            ])
            ->add('entreprise', EntityType::class, [
                'class' => Entreprise::class,
                'choice_label' => 'nom',
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => User::class,
        ]);
    }
}